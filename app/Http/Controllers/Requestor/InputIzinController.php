<?php

namespace App\Http\Controllers\Requestor;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\AttachmentDataIzin;
use App\Models\DataIzinLogs;
use App\Models\DataPerizinan;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\MasterKelas;
use App\Models\MasterWalikelas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;


class InputIzinController extends Controller
{
    public function input_izin()
    {
        return view('user.input_izin.index');
    }

    public function getDataIzin(Request $request)
    {
        if ($request->ajax())
        {
        $user_id= auth()->id();
        $iz = DataPerizinan::where('created_by', $user_id)->orderBy('created_at','asc')->where('deleted_at',null);
        $data = $iz->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('kode_izin',function ($data){
                $kode_izin = substr($data->kode_izin, 0, 1);
                $detail = route('getDetailIzinData',$data->id);
                $kode_fix = "<span id='canhover' class='badge bg-dark' onclick='getDetailIzinData(`"."$detail"."`)' style='cursor:pointer;font-size: 15px;'>".$data->kode_izin."</span>";

                return $kode_fix;
            })
            ->addColumn('created_at', function ($data) {
                $date = date('d-m-Y H:i',strtotime($data->created_at));

                return $date;
            })
            ->addColumn('waktu_izin', function ($data) {
                $date_izin = date('d-m-Y',strtotime($data->waktu_izin));

                return $date_izin;
            })
            ->addColumn('status_izin', function ($data) {
                if($data->status_izin == 'sakit'){
                    $is_status = "<span class='badge bg-secondary'>".strtoupper($data->status_izin)."</span>";
                }elseif($data->status_izin == 'izin'){
                    $is_status = "<span class='badge bg-warning'>".strtoupper($data->status_izin)."</span>";
                }
                  return $is_status;
            })
            ->addColumn('status_dokumen', function ($data) {
                if($data->status_dokumen == 'APPROVAL WALIKELAS'){
                    $is_status = "<span class='badge bg-teal'>".strtoupper($data->status_dokumen)."</span>";
                }elseif($data->status_dokumen == 'APPROVAL BK'){
                    $is_status = "<span class='badge bg-pink'>".strtoupper($data->status_dokumen)."</span>";
                }elseif($data->status_dokumen == 'APPROVED'){
                    $is_status = "<span class='badge bg-succes'>".strtoupper($data->status_dokumen)."</span>";
                }elseif($data->status_dokumen == 'REJECTED'){
                    $is_status = "<span class='badge bg-danger'>".strtoupper($data->status_dokumen)."</span>";
                }
                  return $is_status;
            })
            ->addColumn('action',function ($data){
                return view('user.input_izin._action', [
                    'model' => $data,
                    'detail' => route('getDetailIzinData',$data->id),
                    'delete' => route('deleteIzin',$data->id),
                    'status' => $data->status_dokumen
                ]);
            })
            ->rawColumns([
                'kode_izin',
                'created_at',
                'waktu_izin',
                'status_izin',
                'status_dokumen',
                'action'
            ])
            ->make(true);
        }
    }

    public function showAddIzinModal()
    {
        $user = User::find(auth()->id());
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        $id_kelas = $user->kelas_id;
    
        $kelas = MasterKelas::where('id', $id_kelas)->value('kelas');
    
        $walikelas = MasterWalikelas::where('id_kelas', $id_kelas)->first();
    
        if (!$walikelas) {
            return response()->json(['error' => 'Walikelas not found for the class'], 404);
        }
    
        $walikelas_name = User::where('id', $walikelas->id_walikelas)->value('name');
    
        $data = [
            'id_kelas' => $id_kelas,
            'kelas' => $kelas,
            'id_walikelas' => $walikelas->id_walikelas,
            'walikelas_name' => $walikelas_name,
        ];
    
        return response()->json($data);
    }

    public function storeCreateIzin(Request $request)
    {
        // dd($request);
        try {
            if ($request->hasFile('attachment')) {
                $validator = Validator::make(
                    [
                        'attachment' => strtolower($request->attachment->getClientOriginalExtension()),
                    ],
                    [
                        'attachment' => 'required|in:pdf,doc,docx,png,jpg,jpeg',
                    ]
                );

                if ($validator->fails()) {
                    $data_response = [
                        'status' => 404,
                        'output' => 'Failed! allowable extension is .pdf, .doc, .docx, .jpg, .png, .jpeg'
                    ];
                    return response()->json(['data' => $data_response]);
                }
            }

            // Initialize the ticket variable
            $ticket = null;

            if ($request->status_izin == 'sakit') {
                // Generate a new code izin sakit
                $lastticket = DataPerizinan::whereMonth('created_at', Carbon::now()->format('m'))
                            ->whereRaw("lower(kode_izin) LIKE ?", ["%SD%"])
                            ->count();

                $ticket = 'SD' . Carbon::now()->format('ym') . str_pad($lastticket + 1, 5, '0', STR_PAD_LEFT);
            } elseif ($request->status_izin == 'izin') {
                // Generate a new code izin izin
                $lastticket = DataPerizinan::whereMonth('created_at', Carbon::now()->format('m'))
                            ->whereRaw("lower(kode_izin) LIKE ?", ["%SI%"])
                            ->count();

                $ticket = 'SI' . Carbon::now()->format('ym') . str_pad($lastticket + 1, 5, '0', STR_PAD_LEFT);
            }

            // Ensure ticket is defined
            if ($ticket === null) {
                $data_response = [
                    'status' => 400,
                    'output' => 'Invalid status izin'
                ];
                return response()->json(['data' => $data_response]);
            }

            $tokenizer = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 36);

            DB::beginTransaction();
            $store = DataPerizinan::create([
                'kode_izin' => $ticket,
                'id_kelas' => $request->id_kelas,
                'id_wali_kelas' => $request->id_walikelas,
                'waktu_izin' => $request->tgl_izin,
                'status_izin' => $request->status_izin,
                'description' => $request->description,
                'status_dokumen' => 'APPROVAL WALIKELAS',
                'is_active' => 1,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'id_siswa' => auth()->user()->id, 
                'approval_walikelas' => $tokenizer,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $ticket_id = DataPerizinan::latest('id')->first();
            $datenow = Carbon::now()->format('Y-m-d-');

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $filename = $datenow . $ticket . '-' . Carbon::now()->format('is') . '.' . $file->getClientOriginalExtension();
                $filepath = $file->storeAs('public/attachment/', $filename);

                $file = AttachmentDataIzin::firstOrCreate([
                    'ticket_id' => $ticket_id->id,
                    'name' => $filename,
                    'is_active' => 1,
                    'created_by' => $ticket_id->created_by,
                    'updated_by' => $ticket_id->updated_by,
                ]);
            }

            $logs = DataIzinLogs::firstOrCreate([
                'ticket_id' => $ticket_id->id,
                'status' => $ticket_id->status_dokumen,
                'is_active' => $ticket_id->is_active,
                'description' => 'NEW ABSENT TICKET',
                'created_by' => $ticket_id->created_by,
                'updated_by' => $ticket_id->updated_by,
            ]);

            DB::commit();
            $data_response = [
                'status' => 200,
                'value' => $logs,
                'output' => 'Success!!'
            ];

        } catch (\Throwable $th) {
            DB::rollBack();
            $message = $th->getMessage();
            $data_response = [
                'status' => 500,
                'output' => $message
            ];
        }

        return response()->json(['data' => $data_response]);
    }

    public function getDetailIzinData($id)
    {
        $ticket = DB::table('data_perizinan')
                    ->join('master_kelas', 'data_perizinan.id_kelas', '=', 'master_kelas.id')
                    ->join('users', 'data_perizinan.id_wali_kelas', '=', 'users.id')
                    ->where('data_perizinan.id', $id)
                    ->select(
                        'data_perizinan.*',
                        'master_kelas.kelas as kelas_name',
                        'users.name as wali_kelas_name'
                    )
                    ->first();
        $ticketlog = DataIzinLogs::where('ticket_id', $id)
            ->select('status', 'description', 'created_by', 'created_at')        
            ->latest('id')->get();
        $attachment = AttachmentDataIzin::where('ticket_id', $id)->first();

        $attachment_url = $attachment ? asset('storage/attachment/' . $attachment->name) : null;

        $data_response = [
            'status' => 200,
            'ticket' => $ticket,
            'ticketlog' => $ticketlog,
            'attachment' => $attachment_url
        ];

        return response()->json(['data' => $data_response]);
    }

    public function deleteIzin($id)
    {
        try {
            // Find the DataPerizinan record
            $izin = DataPerizinan::findOrFail($id);

            // Soft delete by updating columns
            $izin->update([
                'is_active' => 0,
                'deleted_at' => Carbon::now()
            ]);

            // Handle attachments if exists
            $attachment = AttachmentDataIzin::where('ticket_id', $izin->id)->first();
            if ($attachment) {
                Storage::delete('public/attachment/' . $attachment->name);
                $attachment->delete();
            }

            // Response data for success
            $data_response = [
                'status' => 200,
                'output' => 'Delete Ticket Success!'
            ];

        } catch (\Exception $th) {
            // Handle any exceptions
            $message = $th->getMessage();

            $data_response = [
                'status' => 500,
                'output' => $message
            ];
        }

        // Return JSON response
        return response()->json(['data' => $data_response]);
    }
}

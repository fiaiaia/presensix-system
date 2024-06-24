<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AllData;
use App\Models\Device;
use App\Models\MasterKelas;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Yajra\Datatables\Datatables;

class EnrollUserController extends Controller
{
    public function enroll_user() 
    {
        return view('user.enroll_user.user.index');
    }

    public function enroll_device() 
    {
        return view('user.enroll_user.device.index_device');
    }

    // Enroll Device
    public function getDataDevice(Request $request)
    {
        $data = Device::orderBy('device_date','asc')->where('deleted_at',null)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('de_mode',function ($data){
                if($data->device_mode == 0){
                    $is_active = "<span class='badge bg-success text-success bg-opacity-20'>Enrollment</span>";
                   }else{
                    $is_active = "<span class='badge bg-primary text-primary bg-opacity-20'>Attandance</span>";
                   }
                return $is_active;
            })
            ->addColumn('is_active',function ($data){
                if($data->is_active == 1){
                    $is_active = "<span class='badge bg-success text-success bg-opacity-20'>Active</span>";
                   }else{
                    $is_active = "<span class='badge bg-danger text-danger bg-opacity-20'>Non-Active</span>";
                   }
                return $is_active;
            })
            ->addColumn('action',function ($data){
                return view('user.enroll_user.device._action_device', [
                        'model' => $data,
                        'edit_device' => route('editDevice',$data->id),
                        'delete_device' => route('deleteDevice',$data->id),
                ]);
                return '#';
            })
            ->rawColumns(['de_mode','is_active','action'])
            ->make(true);
    }

    public function storeDevice(Request $request)
    {
        {
            // dd($request->all());
    
            try {
                $cekdevice = Device::where('device_name', 'like', $request->de_name.'%')
                                    ->where('device_kelas','like', $request->de_kelas)
                                    ->first();
    
                if(!$cekdevice){
                    DB::beginTransaction();
                    $tokenizer = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 5);
                    $store = Device::firstorcreate(
                        [
                            'device_name' => $request->de_name,
                            'device_kelas' => $request->de_kelas,
                            'device_uid' => $tokenizer,
                            'device_date' => Carbon::now(),
                            'device_mode' => '0',
                            'is_active' => '1',
                            'created_by' => auth()->user()->id,
                            'updated_by'=> auth()->user()->id,
                        ],
                        [
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    );
    
                    $data_response = [
                        'status' => 200,
                        'value' => $store,
                        'output' => 'Success!!'
                    ];
                }else{
                    $data_response = [
                        'status' => 404,
                        'output' => 'Looks like the Device already exists!'
                    ]; 
                }
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                $message = $th->getMessage();
    
                $data_response = [
                    'status' => 500,
                    'output' => $message
                ];
            }
    
            return response()->json(['data'=>$data_response]);
        }
    }

    public function editDevice($id)
    {
        $data = Device::whereId($id)->first();

        $data_response = [
            'status' => 200,
            'output' => $data
        ];
        return response()->json(['data'=>$data_response]);
    }

    public function storeEditDevice(Request $request)
    {
        
        // dd($request);
        try {
            DB::beginTransaction();
                $update = Device::whereId($request->device_id)->update(
                    [
                        'device_name' => $request->edt_de_name,
                        'device_kelas' => $request->edt_de_kelas,
                        'device_mode' => $request->de_mode,
                        'is_active' => $request->is_active,
                        'updated_by'=> auth()->user()->id,
                    ],
                    [
                        'updated_at' => Carbon::now(),
                    ]
                );

                $data_response = [
                    'status' => 200,
                    'value' => $update,
                    'output' => 'Success!!'
                ];
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $message = $th->getMessage();

            $data_response = [
                'status' => 500,
                'output' => $message
            ];
        }

        return response()->json(['data'=>$data_response]);
    }

    public function deleteDevice($id)
    {
        try {
            DB::beginTransaction();
  
            $delete = Device::whereId($id)->update([
               'deleted_at' => Carbon::now(),
               'is_active' => '0',
            ]);
  
            $data_response = [
               'status' => 200,
               'output' => 'Delete Device Success!'
            ];
  
            DB::commit();
            }catch (\Throwable $th) {
                DB::rollBack();
                $message = $th->getMessage();
  
                $data_response = [
                    'status' => 500,
                    'output' => $message
                ];
            }
            return response()->json(['data'=>$data_response]);
    }

    // Enroll User
    public function getDataEnroll(Request $request) 
    {
        $data = AllData::orderBy('created_at','asc')->where('deleted_at',null)->get();
        // dd($data);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('class',function ($data){
                if($data->class == null){
                    $class = "<span>-</span>";
                   }else{
                    $class = $data->class;
                   }
                return $class;
            })
            ->addColumn('sidik_jari', function ($data) {
                if ($data->add_fingerid == "0") {
                    $sidik_jari = "<span class='badge bg-success text-success bg-opacity-20'>Added</span>";
                    return $sidik_jari;
                } elseif ($data->add_fingerid === null) {
                    return "<span> - </span>";
                } else {
                    return view('user.enroll_user.user._action_finger', [
                        'model' => $data,
                        'tambah' => route('add_finger', $data->id)
                    ]);
                }
            })            
            ->addColumn('status',function ($data){
                if($data->status == "aktif"){
                    $status = "<span class='badge bg-success text-success bg-opacity-20'>Active</span>";
                   }else{
                    $status = "<span class='badge bg-danger text-danger bg-opacity-20'>Non-Active</span>";
                   }
                return $status;
            })
            ->addColumn('action',function ($data){
                return view('user.enroll_user.user._action', [
                        'model' => $data,
                        'edit_data' => route('editData',$data->id),
                        'delete_data' => route('deleteData',$data->id),
                ]);
                return '#';
            })
            ->rawColumns(['class','sidik_jari','status','action'])
            ->make(true);
    }

    public function editData($id)
    {

    }

    public function deleteData($id)
    {

    }

    public function selectGetKelas(Request $request)
    {
        $data = Device::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower(trim($request->search));
            $data->where('device_kelas', 'like', "%$search%");
        }

        $kelas = $data->get(['id', 'device_kelas']);

        return response()->json($kelas);
    }

    public function getFingerID()
    {
        $maxId = AllData::max('fingerprint_id');
        
        return response()->json(['max_id' => $maxId]);
    }

    public function add_finger($id)
    {
        $data = AllData::whereId($id)->first();

        $data_response = [
            'status' => 200,
            'output' => $data
        ];
        return response()->json(['data'=>$data_response]);
    }

    public function storeNewStudents(Request $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
    
            $cekUser = AllData::where('credential_number', $request->nisn)
                                ->orWhere('fingerprint_id', $request->id_finger_auto_hidden)
                                ->first();
                                
            $dataKelas = Device::whereId($request->kelas_id)->first();
    
            if (!$dataKelas || is_null($dataKelas->device_uid)) {
                return response()->json(['error' => 'Device UID tidak ditemukan atau tidak valid'], 400);
            }
    
            $fix_no_siswa = "+62" . $request->no_telp_siswa;
            $fix_no_ortu = "+62" . $request->no_telp_ortu;
    
            if (!$cekUser) {
                $dataToInsert = [
                    'credential_number' => $request->nisn,
                    'name' => $request->nama_lengkap,
                    'class' => $dataKelas->device_kelas,
                    'position' => $request->position,
                    'birthdate' => $request->tanggal_lahir,
                    'status' => "aktif",
                    'no_telp' => $fix_no_siswa,
                    'nama_ortu_siswa' => $request->nama_ortu,
                    'no_telp_ortu' => $fix_no_ortu,
                    'device_id' => $request->kelas_id,
                    'device_uid' => $dataKelas->device_uid,
                    'fingerprint_id' => $request->id_finger_auto_hidden,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'add_fingerid'=> '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
    
                // dd($dataToInsert);
    
                $store = AllData::create($dataToInsert);
    
                DB::commit();
                $data_response = [
                    'status' => 200,
                    'value' => $store,
                    'output' => 'Success!!'
                ];
            } else {
                $data_response = [
                    'status' => 404,
                    'output' => 'NISN Sudah Terdaftar Silahkan Cek Kembali!'
                ];
            }
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

    public function storeNewTendik(Request $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
    
            $cekUser = AllData::where('credential_number', $request->nip)
                                ->first();
                                
            $fix_no_tendik = "+62" . $request->no_telp_tendik;
    
            if (!$cekUser) {
                $dataToInsert = [
                    'credential_number' => $request->nip,
                    'name' => $request->nama_lengkap,
                    'position' => $request->position,
                    'birthdate' => $request->tanggal_lahir,
                    'status' => "aktif",
                    'no_telp' => $fix_no_tendik,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'device_uid' => '0',
                    'add_fingerid' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
    
                // dd($dataToInsert);
    
                $store = AllData::create($dataToInsert);
    
                DB::commit();
                $data_response = [
                    'status' => 200,
                    'value' => $store,
                    'output' => 'Success!!'
                ];
            } else {
                $data_response = [
                    'status' => 404,
                    'output' => 'NIP Sudah Terdaftar Silahkan Cek Kembali!'
                ];
            }
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
    
}

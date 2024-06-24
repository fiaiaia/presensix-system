<?php
namespace App\Http\Controllers;
use App\Models\DataPerizinan;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
class MonitoringPerizinanController extends Controller
{
    public function monitoring_perizinan_walikelas()
    {
        return view('user.monitoring_perizinan.walikelas.index');
    }
    public function getDataMonitoringPerizinan(Request $request)
    {
        if ($request->ajax())
        {
            $idWalikelas = auth()->id();
            $iz = DataPerizinan::where('id_wali_kelas', $idWalikelas)->orderBy('created_at','asc')->where('deleted_at',null)->with('createdByUser');;  
            $data = $iz->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_izin', function ($data) {
                    return $data->kode_izin ? $data->kode_izin : '-';
                })
                ->addColumn('created_by', function ($data) {
                    return $data->createdByUser ? $data->createdByUser->name : '-';
                })
                ->addColumn('status_izin', function ($data) {
                    return $data->waktu_izin ? $data->waktu_izin : '-';
                })
                ->addColumn('status_dokumen', function ($data) {
                    return $data->status_dokumen ? $data->status_dokumen : '-';
                })
                ->addColumn('action',function ($data){
                    return view('user.enroll_user.device._action_device', [
                            'model' => $data,
                            'edit_device' => route('editDevice',$data->id),
                            'delete_device' => route('deleteDevice',$data->id),
                    ]);
                    return '#';
                })
                ->rawColumns([
                    'kode_izin',
                    'created_by',
                    'status_izin',
                    'status_dokumen',
                    'action'
                ])
                ->make(true);
        }   
    }
}
<?php
namespace App\Http\Controllers;
use App\Models\MonitoringPresensi;
use App\Models\UserLog;
use App\Models\MasterWalikelas;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
class MonitoringPresensiController extends Controller
{
    public function monitoring_presensi_walikelas()
    {
        return view('user.monitoring_presensi.walikelas.index');
    }
    public function getDataMonitoringPresensi(Request $request)
    {
        $userId = auth()->id();

        // Cari kelas yang diajarkan oleh wali kelas yang sedang login
        $waliKelas = MasterWalikelas::where('id_walikelas', $userId)->first();

        if (!$waliKelas) {
            return response()->json(['error' => 'Anda bukan wali kelas dari kelas manapun'], 403);
        }

        // Cari semua siswa yang ada di kelas tersebut
        $students = User::where('kelas_id', $waliKelas->id_kelas)->pluck('id');

        // Lakukan query presensi berdasarkan siswa yang ditemukan
        $query = UserLog::whereIn('user_id', $students);
        $dmonth = $request->dmonth;
        $dyear = $request->dyear;
        $type = $request->type;

        // Filter berdasarkan dyear (wajib)
        $query->whereYear('checkindate', $dyear);

        // Filter berdasarkan dmonth (jika bukan full)
        if ($dmonth != 'full') {
            $query->whereMonth('checkindate', $dmonth);
        }

        // Filter berdasarkan type (remark) jika type bukan 'ALL'
        if ($type !== 'ALL') {
            $query->where('remark', $type);
        }
        $data = $query->orderBy('created_at', 'asc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('checkindate', function ($data) {
                $checkindate = \Carbon\Carbon::parse($data->checkindate)->translatedFormat('l, j F Y');
                return $checkindate;
            })                      
            ->addColumn('device_kelas', function ($data) {
                if ($data->device_kelas == null) {
                    $device_kelas = '<span> - </span>';
                } else {
                    $device_kelas = "<span class='badge bg-warning'>$data->device_kelas</span>";
                }
                
                return $device_kelas;
            })
            ->addColumn('timein', function ($data) {
                if ($data->timein == null) {
                    $timein = '<span> - </span>';
                } else {
                    $timein = $data->timein;
                }
                
                return $timein;
            })
            ->addColumn('timeout', function ($data) {
                if ($data->timeout == null) {
                    $timeout = '<span> - </span>';
                } else {
                    $timeout = $data->timeout;
                }
                
                return $timeout;
            })
            ->addColumn('remark', function ($data) {
                $remark = "";
            
                // Use the remark column value to determine the badge
                switch (strtoupper($data->remark)) {
                    case "ON_TIME":
                        $remark = "<span class='badge bg-success text-success bg-opacity-20'>ON TIME</span>";
                        break;
                    case "LATE":
                        $remark = "<span class='badge bg-warning text-warning bg-opacity-20'>LATE</span>";
                        break;
                    case "OVERTIME":
                        $remark = "<span class='badge bg-info text-info bg-opacity-20'>OVERTIME</span>";
                        break;
                    case "ABSENT":
                        $remark = "<span class='badge bg-danger text-danger bg-opacity-20'>ABSENT</span>";
                        break;
                }
            
                return $remark;
            })            
            ->rawColumns(['checkindate','remark','device_kelas','timein','timeout'])
            ->make(true);
    }
}
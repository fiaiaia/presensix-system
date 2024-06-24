<?php

namespace App\Http\Controllers\Requestor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\DataPerizinan;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MonitoringDiriController extends Controller
{
    public function monitoring_presensi_diri()
    {
        return view('user.monitoring_diri.index');
    }

    public function getDataMonitor(Request $request)
    {
        // dd($request);
        $userId = auth()->id();
        $query = UserLog::where('user_id', $userId);
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
        // dd($data);

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

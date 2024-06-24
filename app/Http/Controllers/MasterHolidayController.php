<?php

namespace App\Http\Controllers;
use App\Models\MasterHoliday;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

class MasterHolidayController extends Controller
{
    public function masterHoliday()
    {
        return view('user.md-umum.master-holiday.index');
    }

    public function getDataHoliday(Request $request)
    {
        $data = MasterHoliday::orderBy('created_at', 'asc')->whereNull('deleted_at')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('date', function ($data) {
                return $data->date ? $data->date : '-';
            })
            ->addColumn('is_active',function ($data){
                if($data->is_active == 1){
                    $is_active = "<span class='badge bg-success text-success bg-opacity-20'>Active</span>";
                   }else{
                    $is_active = "<span class='badge bg-danger text-danger bg-opacity-20'>Non-Active</span>";
                   }
                return $is_active;
            })
            ->addColumn('description', function ($data) {
                return $data->description ? $data->description : '-';
            })
            ->rawColumns(['date','is_active','description'])
            ->make(true);
    }
}

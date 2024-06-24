<?php

namespace App\Http\Controllers;
use App\Models\MasterWalikelas;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

class MasterDataWalikelasController extends Controller
{
    public function masterWalikelas()
    {
        return view('user.md-umum.master-walikelas.index');
    }

    public function getDataWalikelas(Request $request)
    {
        $data = MasterWalikelas::orderBy('created_at', 'asc')->whereNull('deleted_at')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('id_walikelas', function ($data) {
                return $data->id_walikelas ? $data->id_walikelas : '-';
            })
            ->addColumn('id_kelas', function ($data) {
                return $data->id_kelas ? $data->id_kelas : '-';
            })
            ->addColumn('is_active',function ($data){
                if($data->is_active == 1){
                    $is_active = "<span class='badge bg-success text-success bg-opacity-20'>Active</span>";
                   }else{
                    $is_active = "<span class='badge bg-danger text-danger bg-opacity-20'>Non-Active</span>";
                   }
                return $is_active;
            })
            ->rawColumns(['id_walikelas','id_kelas','is_active'])
            ->make(true);
    }
}

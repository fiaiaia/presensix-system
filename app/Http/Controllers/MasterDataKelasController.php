<?php

namespace App\Http\Controllers;
use App\Models\MasterKelas;
use Yajra\Datatables\Datatables;


use Illuminate\Http\Request;

class MasterDataKelasController extends Controller
{
    public function masterKelas()
    {
        return view('user.md-umum.master-kelas.index');
    }

    public function getDataKelas(Request $request)
    {
        $data = MasterKelas::orderBy('created_at', 'asc')->whereNull('deleted_at')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('kelas', function ($data) {
                return $data->kelas ? $data->kelas : '-';
            })
            ->addColumn('tahun_ajar', function ($data) {
                return $data->tahun_ajar ? $data->tahun_ajar : '-';
            })
            ->rawColumns(['kelas','tahun_ajar'])
            ->make(true);
    }
}

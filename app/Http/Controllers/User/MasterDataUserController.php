<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MasterKelas;
use Yajra\Datatables\Datatables;

class MasterDataUserController extends Controller
{
    public function useraccount()
    {
        return view('user.md-umum.user-account.index');
    }

    public function getDataUser(Request $request)
    {
        $data = User::with('userRoles')->orderBy('created_at', 'asc')->whereNull('deleted_at')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('roles', function ($data) {
                $role = [];
                if ($data->userRoles) {
                    foreach ($data->userRoles as $roleItem) {
                        $roleName = ucwords($roleItem->name);
                        $isi = "<span class='badge bg-dark text-reset rounded-pill bg-opacity-20 mb-1'> " . $roleName . " </span>";
                        array_push($role, $isi);
                    }
                }
                return implode("<br>", $role);
            })
            ->addColumn('kelas', function ($data) {
                $kelas = MasterKelas::find($data->kelas_id);
                if ($kelas) {
                    $kelas_name = "<span class='badge bg-dark text-reset rounded-pill bg-opacity-20 mb-1'> " . $kelas->kelas . " </span>"; 
                    $tahun_ajar = "<span class='badge bg-dark text-reset rounded-pill bg-opacity-20 mb-1'> " . $kelas->tahun_ajar . " </span>";
                    return $kelas_name . "<br>" . $tahun_ajar;
                }
                return '-'; 
            })
            ->addColumn('position', function ($data) {
                return $data->position ? $data->position : '-';
            })
            ->addColumn('jenis_kelamin', function ($data) {
                return $data->jenis_kelamin ? $data->jenis_kelamin : '-';
            })
            ->addColumn('no_telp', function ($data) {
                return $data->no_telp ? $data->no_telp : '-';
            })
            ->addColumn('nama_ortu_siswa', function ($data) {
                return $data->nama_ortu_siswa ? $data->nama_ortu_siswa : '-';
            })
            ->addColumn('no_telp_ortu', function ($data) {
                return $data->no_telp_ortu ? $data->no_telp_ortu : '-';
            })
            ->rawColumns(['roles','kelas','position','jenis_kelamin','no_telp','nama_ortu_siswa','no_telp_ortu'])
            ->make(true);
    }

}

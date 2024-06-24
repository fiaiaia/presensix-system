<?php

namespace Database\Seeders;

use App\Models\MasterKelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_kelas')->insert([
        	'kelas'=>'X MIPA 1',
        	'tahun_ajar'=>'2024',
        	'created_at'=>Carbon::now(),
        ]);

        DB::table('master_kelas')->insert([
        	'kelas'=>'X MIPA 2',
        	'tahun_ajar'=>'2024',
        	'created_at'=>Carbon::now(),
        ]);

        DB::table('master_kelas')->insert([
        	'kelas'=>'X MIPA 3',
        	'tahun_ajar'=>'2024',
        	'created_at'=>Carbon::now(),
        ]);

        DB::table('master_kelas')->insert([
        	'kelas'=>'X MIPA 4',
        	'tahun_ajar'=>'2024',
        	'created_at'=>Carbon::now(),
        ]);

        DB::table('master_kelas')->insert([
        	'kelas'=>'X IPS 1',
        	'tahun_ajar'=>'2024',
        	'created_at'=>Carbon::now(),
        ]);

        DB::table('master_kelas')->insert([
        	'kelas'=>'X IPS 1',
        	'tahun_ajar'=>'2024',
        	'created_at'=>Carbon::now(),
        ]);
    }
}

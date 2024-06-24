@extends('layouts.app')

@section('dashboard','active')
@section('judulmenu','Dashboard')

@section('styles')
<style>
    .px-5 {
        padding-left: 30px;
        padding-right: 30px;
    }
    .db-widgets {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .bg-comman {
        background-color: #fff;
        border: 0;
        border-radius: 10px;
        box-shadow: 0 0 31px 3px rgba(44, 50, 63, 0.02);
        height: 100%;
    }
    .db-info h3 {
        font-size: 22px;
        font-weight: 600;
        color: #000;
        margin-bottom: 0;
    }
    .card {
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .card-title {
        font-weight: bold;
        color: rgb(3, 3, 3);
    }
    .card-chart .card-body {
        padding: 8px;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <span class="h5">DASHBOARD SUPER ADMIN</span>
    </div>
    <div class="card-body">
        <div class="panel-body tab-pane active" id="ss">
            <div class="row form-group">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="text-center w-100">

                        <!-- row pertama  -->
                        <div class="row">
                            <!-- bagian total user -->
                            <div class="col-xl-3 col-sm-6 col-12 d-flex mb-4">
                                <div class="card bg-comman w-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="db-widgets d-flex justify-content-between align-items-center w-100">
                                            <div class="db-info">
                                                <h3>{{ \App\Models\AllData::count() }}</h3>
                                                <h6>
                                                    <span class="card-title">Total User</span>
                                                </h6>
                                            </div>
                                            <div class="db-icon">
                                                <i class="ph-users-three" style="font-size: 5em; color: #F58646; opacity: 25%;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- bagian total device -->
                            <div class="col-xl-3 col-sm-6 col-12 d-flex mb-4">
                                <div class="card bg-comman w-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="db-widgets d-flex justify-content-between align-items-center w-100">
                                            <div class="db-info">
                                                <h3>{{ \App\Models\Device::count() }}</h3>
                                                <h6>
                                                    <span class="card-title">Total Device</span>
                                                </h6>
                                            </div>
                                            <div class="db-icon">
                                                <i class="ph-desktop-tower" style="font-size: 5em; color: #F58646; opacity: 25%;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- bagian total kelas -->
                            <div class="col-xl-3 col-sm-6 col-12 d-flex mb-4">
                                <div class="card bg-comman w-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="db-widgets d-flex justify-content-between align-items-center w-100">
                                            <div class="db-info">
                                                <h3>{{ \App\Models\MasterKelas::count() }}</h3>
                                                <h6>
                                                    <span class="card-title">Total Kelas</span>
                                                </h6>
                                            </div>
                                            <div class="db-icon">
                                                <i class="ph-buildings" style="font-size: 5em; color: #F58646; opacity: 25%;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- bagian total perizinan -->
                            <div class="col-xl-3 col-sm-6 col-12 d-flex mb-4">
                                <div class="card bg-comman w-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="db-widgets d-flex justify-content-between align-items-center w-100">
                                            <div class="db-info">
                                                <h3>{{ \App\Models\DataPerizinan::count() }}</h3>
                                                <h6>
                                                    <span class="card-title">Total Perizinan</span>
                                                </h6>
                                            </div>
                                            <div class="db-icon">
                                                <i class="ph-folder-user" style="font-size: 5em; color: #F58646; opacity: 25%;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- row kedua  -->
                        <div class="row">
                            <!-- bagian total siswa -->
                            <div class="col-xl-3 col-sm-6 col-12 d-flex mb-4">
                                <div class="card bg-comman w-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="db-widgets d-flex justify-content-between align-items-center w-100">
                                            <div class="db-info">
                                                <h3>{{ \App\Models\AllData::where('position', 'siswa')->count() }}</h3>
                                                <h6>
                                                    <span class="card-title">Total Siswa</span>
                                                </h6>
                                            </div>
                                            <div class="db-icon">
                                                <i class="ph-student" style="font-size: 5em; color: #F58646; opacity: 25%;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- bagian total wali kelas -->
                            <div class="col-xl-3 col-sm-6 col-12 d-flex mb-4">
                                <div class="card bg-comman w-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="db-widgets d-flex justify-content-between align-items-center w-100">
                                            <div class="db-info">
                                                <h3>{{ \App\Models\AllData::where('position', 'walikelas')->count() }}</h3>
                                                <h6>
                                                    <span class="card-title">Total Walikelas</span>
                                                </h6>
                                            </div>
                                            <div class="db-icon">
                                                <i class="ph-user-circle-plus" style="font-size: 5em; color: #F58646; opacity: 25%;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- bagian total guru bk -->
                            <div class="col-xl-3 col-sm-6 col-12 d-flex mb-4">
                                <div class="card bg-comman w-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="db-widgets d-flex justify-content-between align-items-center w-100">
                                            <div class="db-info">
                                                <h3>{{ \App\Models\AllData::where('position', 'guru-bk')->count() }}</h3>
                                                <h6>
                                                    <span class="card-title">Total <br>Guru BK</span>
                                                </h6>
                                            </div>
                                            <div class="db-icon">
                                                <i class="ph-user-rectangle" style="font-size: 5em; color: #F58646; opacity: 25%;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- bagian total kesiswaan -->
                            <div class="col-xl-3 col-sm-6 col-12 d-flex mb-4">
                                <div class="card bg-comman w-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="db-widgets d-flex justify-content-between align-items-center w-100">
                                            <div class="db-info">
                                                <h3>{{ \App\Models\AllData::where('position', 'kesiswaan')->count() }}</h3>
                                                <h6>
                                                    <span class="card-title">Total Kesiswaan</span>
                                                </h6>
                                            </div>
                                            <div class="db-icon">
                                                <i class="ph-address-book" style="font-size: 4em; color: #F58646; opacity: 25%;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- row ketiga -->
                        <div class="row">
                            <!-- Chart User -->
                            <div class="col-md-6">
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h5 class="m-0">Jenis Kelamin Siswa</h5>
                                    </div>
                                    <div class="card-body">
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var ctx = document.getElementById('genderChart').getContext('2d');
                                                var genderChart = new Chart(ctx, {
                                                    type: 'doughnut',
                                                    data: {
                                                        labels: ['Perempuan', 'Laki-Laki'],
                                                        datasets: [{
                                                            label: 'Total Siswa',
                                                            data: [
                                                                {{ \App\Models\AllData::where('position','siswa')->where('jenis_kelamin', 'perempuan')->count() }},
                                                                {{ \App\Models\AllData::where('position','siswa')->where('jenis_kelamin', 'laki-laki')->count() }}  
                                                            ],
                                                            backgroundColor: [
                                                                'rgba(255, 191, 120, 1)',
                                                                'rgba(255, 162, 127, 1)'  
                                                            ],
                                                            borderColor: [
                                                                'rgba(220, 95, 0, 1)', 
                                                                'rgba(190, 49, 68, 1)',  
                                                            ],
                                                            borderWidth: 2,
                                                            hoverOffset: 4
                                                        }]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        plugins: {
                                                            legend: {
                                                                position: 'top',
                                                            },
                                                            tooltip: {
                                                                enabled: true,
                                                                mode: 'point'
                                                            }
                                                        },
                                                        animation: {
                                                            animateScale: true,
                                                            animateRotate: true
                                                        },
                                                        aspectRatio: 2 // Menambahkan aspect ratio untuk lebih memperkecil ukuran chart
                                                    }
                                                });
                                            });
                                        </script>
                                        <canvas id="genderChart"></canvas>
                                        <div class="text-center mt-3">
                                            <div>Total Siswa Perempuan: {{ \App\Models\AllData::where('position','siswa')->where('jenis_kelamin', 'perempuan')->count() }}</div>
                                            <div>Total Siswa Laki-Laki: {{ \App\Models\AllData::where('position','siswa')->where('jenis_kelamin', 'laki-laki')->count() }}</div>
                                        </div>
                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Enroll Device dan Enroll User -->
                            <div class="col-md-6">
                                <div class="row">
                                    <!-- Enroll Device -->
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="m-0">Enroll Device</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">Admin dapat menambahkan device baru disini.</p>
                                            </div>
                                            <div class="db-icon" 
                                            style="padding: 8px; background-color: #F58646; color: #fff; display: inline-block; text-decoration: none; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; transition: background-color 0.3s;"
                                            onmouseover="this.style.backgroundColor='#FFC700';" onmouseout="this.style.backgroundColor='#F58646';">
                                                <a href="/md-enroll-device/device" style="color: #fff; text-align: left;">Ke Enroll Device</a>
                                                <i class="ph-arrow-circle-right" style="font-size: 1.5em; color: #fff;"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Enroll User -->
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="m-0">Enroll User</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">Admin dapat menambahkan user baru disini.</p>
                                            </div>
                                            <div class="db-icon" 
                                            style="padding: 8px; background-color: #F58646; color: #fff; display: inline-block; text-decoration: none; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; transition: background-color 0.3s;"
                                            onmouseover="this.style.backgroundColor='#FFC700';" onmouseout="this.style.backgroundColor='#F58646';">
                                                <a href="/md-enroll-usr" style="color: #fff; text-align: left;">Ke Enroll User</a>
                                                <i class="ph-arrow-circle-right" style="font-size: 1.5em; color: #fff;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


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
        <span class="h5">DASHBOARD SISWA</span>
    </div>
    <div class="card-body">
        <div class="panel-body tab-pane active" id="ss">
            <div class="row form-group">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="text-center w-100">

                        <!-- row pertama -->
                        <div class="row">
                            <!-- bagian total user -->
                            <div class="col-xl-6 col-sm-12 mb-4">
                                <div class="card bg-comman w-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="db-widgets d-flex justify-content-between align-items-center w-100">
                                            <div class="db-info">
                                                <h3>{{ \App\Models\UserLog::where('credential_number', Auth::user()->credential_number)->count() }}</h3>
                                                <h6>
                                                    <span class="card-title">Riwayat Presensi</span>
                                                </h6>
                                            </div>
                                            <div class="db-icon">
                                                <i class="ph-fingerprint" style="font-size: 5em; color: #F58646; opacity: 25%;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- bagian total perizinan -->
                            <div class="col-xl-6 col-sm-12 mb-4">
                                <div class="card bg-comman w-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="db-widgets d-flex justify-content-between align-items-center w-100">
                                            <div class="db-info">
                                                <h3>{{ \App\Models\DataPerizinan::where('created_by', Auth::user()->id)->count() }}</h3>
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
                        
                        <!-- row kedua -->
                        <div class="row">
                            <!-- Chart User -->
                            <div class="col-md-6">
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h5 class="m-0">Riwayat Kehadiran Bulanan</h5>
                                    </div>
                                    <div class="card-body">
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var ctx = document.getElementById('attendanceChart').getContext('2d');
                                                var attendanceChart = new Chart(ctx, {
                                                    type: 'doughnut',
                                                    data: {
                                                        labels: ['On Time', 'Late', 'Overtime', 'Absent'],
                                                        datasets: [{
                                                            label: 'Status Kehadiran',
                                                            data: [
                                                                {{ \App\Models\UserLog::where('credential_number', Auth::user()->credential_number)->where('remark', 'on_time')->count() }},
                                                                {{ \App\Models\UserLog::where('credential_number', Auth::user()->credential_number)->where('remark', 'late')->count() }},
                                                                {{ \App\Models\UserLog::where('credential_number', Auth::user()->credential_number)->where('remark', 'overtime')->count() }},
                                                                {{ \App\Models\UserLog::where('credential_number', Auth::user()->credential_number)->where('remark', 'absent')->count() }}
                                                            ],
                                                            backgroundColor: [
                                                                'rgba(252, 220, 148, 1)',
                                                                'rgba(255, 191, 120, 1)',
                                                                'rgba(255, 162, 127, 1)', 
                                                                'rgba(232, 141, 103, 1)'
                                                            ],
                                                            borderColor: [
                                                                'rgba(239, 156, 102, 1)',
                                                                'rgba(220, 95, 0, 1)', 
                                                                'rgba(190, 49, 68, 1)', 
                                                                'rgba(135, 35, 65, 1)'
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
                                                        aspectRatio: 2 
                                                    }
                                                });
                                            });
                                        </script>
                                        <canvas id="attendanceChart"></canvas>
                                        <div class="text-center mt-3">
                                            <div>Total On Time: {{ \App\Models\UserLog::where('credential_number', Auth::user()->credential_number)->where('remark', 'on_time')->count() }}</div>
                                            <div>Total Late: {{ \App\Models\UserLog::where('credential_number', Auth::user()->credential_number)->where('remark', 'late')->count() }}</div>
                                            <div>Total Overtime: {{ \App\Models\UserLog::where('credential_number', Auth::user()->credential_number)->where('remark', 'overtime')->count() }}</div>
                                            <div>Total Absent: {{ \App\Models\UserLog::where('credential_number', Auth::user()->credential_number)->where('remark', 'absent')->count() }}</div>
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
                                                <h5 class="m-0">Input Perizinan</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">Siswa dapat menambahkan perizinan baru disini.</p>
                                            </div>
                                            <div class="db-icon" 
                                            style="padding: 8px; background-color: #F58646; color: #fff; display: inline-block; text-decoration: none; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; transition: background-color 0.3s;"
                                            onmouseover="this.style.backgroundColor='#FFC700';" onmouseout="this.style.backgroundColor='#F58646';">
                                                <a href="/add-izin" style="color: #fff; text-align: left;">Ke Input Perizinan</a>
                                                <i class="fas ph-arrow-circle-right" style="font-size: 1.5em; color: #fff;"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Enroll User -->
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="m-0"> Self Monitoring Presensi</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">Siswa dapat melihat riwayat presensi disini.</p>
                                            </div>
                                            <div class="db-icon" 
                                            style="padding: 8px; background-color: #F58646; color: #fff; display: inline-block; text-decoration: none; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; transition: background-color 0.3s;"
                                            onmouseover="this.style.backgroundColor='#FFC700';" onmouseout="this.style.backgroundColor='#F58646';">
                                                <a href="/monitoring-diri" style="color: #fff; text-align: left;">Ke Monitoring Presensi</a>
                                                <i class="fas ph-arrow-circle-right" style="font-size: 1.5em; color: #fff;"></i>
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


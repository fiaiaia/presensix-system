<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\MainController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\EnrollUserController;
use App\Http\Controllers\Requestor\InputIzinController;
use App\Http\Controllers\Requestor\MonitoringDiriController;
use App\Http\Controllers\User\MasterDataUserController;
use App\Http\Controllers\MasterDataWalikelasController;
use App\Http\Controllers\MasterDataKelasController;
use App\Http\Controllers\MasterHolidayController;
use App\Http\Controllers\MonitoringPresensiController;
use App\Http\Controllers\MonitoringPerizinanController;
use App\Http\Controllers\MonitoringPresensiAllController;
use App\Http\Controllers\MonitoringPerizinanAllController;
use Illuminate\Support\Facades\Route;

// Default redirect route
Route::redirect('/', '/login');

// Auth routes
Route::middleware('auth')->group(function () {
    
    // Main Dashboard Routes
    Route::get('/home', [MainController::class, 'home'])->name('home');
    Route::get('/dashboard-maintain', [DashboardController::class, 'dashboardMaintain'])->name('dashboardMaintain');
    Route::get('/dashboard', [DashboardController::class, 'superAdminDashboard'])->name('superAdminDashboard');
    Route::get('/dashboard-siswa', [DashboardController::class, 'siswaDashboard'])->name('siswaDashboard');
    Route::get('/dashboard-walikelas', [DashboardController::class, 'walikelasDashboard'])->name('walikelasDashboard');
    Route::get('/dashboard-guru-bk', [DashboardController::class, 'guruBkDashboard'])->name('guruBkDashboard');
    Route::get('/dashboard-kesiswaan', [DashboardController::class, 'kesiswaanDashboard'])->name('kesiswaanDashboard');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'changeProfile'])->name('changeProfile');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    
    // Input Email Route
    Route::post('/input-email', [MainController::class, 'inputEmail'])->name('inputEmail');
    
    // Super Admin Routes
    Route::prefix('/md-enroll-usr')->middleware(['role:super-admin'])->group(function () {
        Route::get('', [EnrollUserController::class, 'enroll_user'])->name('enroll_user');
        Route::get('/get-data-enroll', [EnrollUserController::class, 'getDataEnroll'])->name('getDataEnroll');
        Route::get('/edit-data-usr/{id}', [EnrollUserController::class, 'editData'])->name('editData');
        Route::get('/delete-data-usr/{id}', [EnrollUserController::class, 'deleteData'])->name('deleteData');
        Route::get('/get-kelas-master', [EnrollUserController::class, 'selectGetKelas'])->name('selectGetKelas');
        Route::get('/get-fingerprint-id', [EnrollUserController::class, 'getFingerID'])->name('getFingerID');
        Route::get('/cek-fingerprint', [EnrollUserController::class, 'checkFingerprint'])->name('checkFingerprint');
        Route::get('/add-finger/{id}', [EnrollUserController::class, 'add_finger'])->name('add_finger');
        Route::post('/store-user-students', [EnrollUserController::class, 'storeNewStudents'])->name('storeNewStudents');
        Route::post('/store-user-tendik', [EnrollUserController::class, 'storeNewTendik'])->name('storeNewTendik');
    });
    
    Route::prefix('/md-enroll-device')->middleware(['role:super-admin'])->group(function () {
        Route::get('/device', [EnrollUserController::class, 'enroll_device'])->name('enroll_device');
        Route::get('/get-data-device', [EnrollUserController::class, 'getDataDevice'])->name('getDataDevice');
        Route::get('/edit-device/{id}', [EnrollUserController::class, 'editDevice'])->name('editDevice');
        Route::get('/delete-device/{id}', [EnrollUserController::class, 'deleteDevice'])->name('deleteDevice');
        Route::post('/store-device', [EnrollUserController::class, 'storeDevice'])->name('storeDevice');
        Route::post('/store-edit-device', [EnrollUserController::class, 'storeEditDevice'])->name('storeEditDevice');
    });
    
    Route::prefix('/md-user')->middleware(['role:super-admin'])->group(function () {
        Route::get('/', [MasterDataUserController::class, 'useraccount'])->name('useraccount');
        Route::get('/get-data-user', [MasterDataUserController::class, 'getDataUser'])->name('getDataUser');
    });
    
    Route::prefix('/md-walikelas')->middleware(['role:super-admin'])->group(function () {
        Route::get('/', [MasterDataWalikelasController::class, 'masterWalikelas'])->name('masterWalikelas');
        Route::get('/get-data-walikelas', [MasterDataWalikelasController::class, 'getDataWalikelas'])->name('getDataWalikelas');
    });
    
    Route::prefix('/md-kelas')->middleware(['role:super-admin'])->group(function () {
        Route::get('/', [MasterDataKelasController::class, 'masterKelas'])->name('masterKelas');
        Route::get('/get-data-kelas', [MasterDataKelasController::class, 'getDataKelas'])->name('getDataKelas');
    });
    
    Route::prefix('/md-holiday')->middleware(['role:super-admin'])->group(function () {
        Route::get('/', [MasterHolidayController::class, 'masterHoliday'])->name('masterHoliday');
        Route::get('/get-data-holiday', [MasterHolidayController::class, 'getDataHoliday'])->name('getDataHoliday');
    });
    
    // Siswa Routes
    Route::prefix('/add-izin')->middleware(['permission:add-permission'])->group(function () {
        Route::get('', [InputIzinController::class, 'input_izin'])->name('input_izin');
        Route::get('/get-data-izin', [InputIzinController::class, 'getDataIzin'])->name('getDataIzin');
        Route::get('/get-value-field', [InputIzinController::class, 'showAddIzinModal'])->name('showAddIzinModal');
        Route::post('/store-izin', [InputIzinController::class, 'storeCreateIzin'])->name('storeCreateIzin');
        Route::get('/getdetail-izin/{id}', [InputIzinController::class, 'getDetailIzinData'])->name('getDetailIzinData');
        Route::delete('/delete-izin/{id}', [InputIzinController::class, 'deleteIzin'])->name('deleteIzin');
    });
    
    Route::prefix('/monitoring-diri')->middleware(['permission:add-permission'])->group(function () {
        Route::get('', [MonitoringDiriController::class, 'monitoring_presensi_diri'])->name('monitoring_presensi_diri');
        Route::get('/get-data-log', [MonitoringDiriController::class, 'getDataMonitor'])->name('getDataMonitor');
    });
    
    // Role-based Monitoring Routes
    Route::middleware(['role:walikelas'])->group(function () {
        Route::prefix('/monitoring-presensi-walikelas')->group(function () {
            Route::get('', [MonitoringPresensiController::class, 'monitoring_presensi_walikelas'])->name('monitoring_presensi_walikelas');
            Route::get('/get-data-log', [MonitoringPresensiController::class, 'getDataMonitoringPresensi'])->name('getDataMonitoringPresensi');
        });
        
        Route::prefix('/monitoring-perizinan-walikelas')->group(function () {
            Route::get('', [MonitoringPerizinanController::class, 'monitoring_perizinan_walikelas'])->name('monitoring_perizinan_walikelas');
            Route::get('/get-data-log', [MonitoringPerizinanController::class, 'getDataMonitoringPerizinan'])->name('getDataMonitoringPerizinan');
        });
    });
    
    Route::middleware(['role:guru-bk'])->group(function () {
        Route::prefix('/monitoring-presensi-guru-bk')->group(function () {
            Route::get('', [MonitoringPresensiAllController::class, 'monitoring_presensi_guru_bk'])->name('monitoring_presensi_guru_bk');
            Route::get('/get-data-log', [MonitoringPresensiAllController::class, 'getDataMonitoringPresensiAll'])->name('getDataMonitoringPresensiAll');
        });
        
        Route::prefix('/monitoring-perizinan-guru-bk')->group(function () {
            Route::get('', [MonitoringPerizinanAllController::class, 'monitoring_perizinan_guru_bk'])->name('monitoring_perizinan_guru_bk');
            Route::get('/get-data-log', [MonitoringPerizinanAllController::class, 'getDataMonitoringPerizinanAll'])->name('getDataMonitoringPerizinanAll');
        });
    });
    
    Route::middleware(['role:kesiswaan'])->group(function () {
        Route::prefix('/monitoring-presensi-kesiswaan')->group(function () {
            Route::get('', [MonitoringPresensiAllController::class, 'monitoring_presensi_kesiswaan'])->name('monitoring_presensi_kesiswaan');
            Route::get('/get-data-log', [MonitoringPresensiAllController::class, 'getDataMonitoringPresensiAll'])->name('getDataMonitoringPresensiAll');
        });
    });
});

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
<li class="nav-item">
    @auth
        @if (auth()->user()->hasRole('super-admin'))
            <a href="{{ route('superAdminDashboard') }}" class="nav-link @yield('superAdminDashboard')">
                <i class="ph-house"></i>
                <span>Dashboard</span>
            </a>
        @elseif (auth()->user()->hasRole('siswa'))
            <a href="{{ route('siswaDashboard') }}" class="nav-link @yield('siswaDashboard')">
                <i class="ph-house"></i>
                <span>Dashboard</span>
            </a>
        @elseif (auth()->user()->hasRole('walikelas'))
            <a href="{{ route('walikelasDashboard') }}" class="nav-link @yield('walikelasDashboard')">
                <i class="ph-house"></i>
                <span>Dashboard</span>
            </a>
        @elseif (auth()->user()->hasRole('guru-bk'))
            <a href="{{ route('guruBkDashboard') }}" class="nav-link @yield('guruBkDashboard')">
                <i class="ph-house"></i>
                <span>Dashboard</span>
            </a>
        @elseif (auth()->user()->hasRole('kesiswaan'))
            <a href="{{ route('kesiswaanDashboard') }}" class="nav-link @yield('kesiswaanDashboard')">
                <i class="ph-house"></i>
                <span>Dashboard</span>
            </a>
        @else
            <a href="{{ route('dashboardMaintain') }}" class="nav-link @yield('dashboardMaintain')">
                <i class="ph-house"></i>
                <span>Dashboard</span>
            </a>
        @endif
    @else
        <a href="{{ route('dashboardMaintain') }}" class="nav-link @yield('dashboardMaintain')">
            <i class="ph-house"></i>
            <span>Dashboard</span>
        </a>
    @endauth
</li>

{{-- Siswa --}}
@can('add-permission')
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">MENU SISWA</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a href="{{ route('input_izin') }}" class="nav-link @yield('input_izin')">
        <i class="ph-download-simple"></i>
        <span>
            Input Perizinan
        </span>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('monitoring_presensi_diri') }}" class="nav-link @yield('monitoring_diri')">
        <i class="ph-calendar"></i>
        <span>
            Self Monitoring Presensi
        </span>
    </a>
</li>
@endcan


{{-- Menu untuk Walikelas --}}
@can('student-monitoring-absent-guru')
    @auth
        @if (auth()->user()->hasRole('walikelas'))
            <li class="nav-item-header">
                <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">MENU WALIKELAS</div>
                <i class="ph-dots-three sidebar-resize-show"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('monitoring_perizinan_walikelas') }}" class="nav-link @yield('monitoring_perizinan_walikelas')">
                    <i class="ph-notepad"></i>
                    <span>Monitoring Perizinan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('monitoring_presensi_walikelas') }}" class="nav-link @yield('monitoring_presensi_walikelas')">
                    <i class="ph-files"></i>
                    <span>Monitoring Presensi</span>
                </a>
            </li>
        @endif
    @endauth
@endcan

{{-- Menu untuk Guru BK --}}
@can('student-monitoring-absent-guru')
    @auth
        @if (auth()->user()->hasRole('guru-bk'))
            <li class="nav-item-header">
                <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">MENU GURU BK</div>
                <i class="ph-dots-three sidebar-resize-show"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('monitoring_perizinan_guru_bk') }}" class="nav-link @yield('monitoring_perizinan_guru_bk')">
                    <i class="ph-notepad"></i>
                    <span>Monitoring Perizinan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('monitoring_presensi_guru_bk') }}" class="nav-link @yield('monitoring_presensi_guru_bk')">
                    <i class="ph-files"></i>
                    <span>Monitoring Presensi</span>
                </a>
            </li>
        @endif
    @endauth
@endcan


{{-- Kesiswaan --}}
@can('student-monitoring-absent-kesiswaan')
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">MENU KESISWAAN</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a href="{{ route('monitoring_presensi_kesiswaan') }}" class="nav-link @yield('monitoring_presensi_kesiswaan')">
        <i class="ph-files"></i>
        <span>
            Monitoring Presensi
        </span>
    </a>
</li>
@endcan


{{-- Menu Super Admin --}}
@can('read-user')
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">MASTER USER</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a href="{{ route('enroll_device') }}" class="nav-link @yield('enroll_device')">
        <i class="ph-desktop-tower"></i>
        <span>
            Enroll Device
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('enroll_user') }}" class="nav-link @yield('enroll_user')">
        <i class="ph-identification-card"></i>
        <span>
            Enroll New User
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('useraccount') }}" class="nav-link @yield('useracount')">
        <i class="ph-users-three"></i>
        <span>
            User Account
        </span>
    </a>
</li>
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">OTHER</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a href="{{ route('masterWalikelas') }}" class="nav-link @yield('masterWalikelas')">
        <i class="ph-user-circle-plus"></i>
        <span>
            Master Walikelas
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('masterKelas') }}" class="nav-link @yield('masterKelas')">
        <i class="ph-buildings"></i>
        <span>
            Master Kelas
        </span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('masterHoliday') }}" class="nav-link @yield('masterHoliday')">
        <i class="ph-calendar"></i>
        <span>
            Master Holidays
        </span>
    </a>
</li>
@endcan
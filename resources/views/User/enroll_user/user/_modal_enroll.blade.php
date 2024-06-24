{{-- Pilihan New User --}}
<div id="modal_choice_user" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white d-flex justify-content-between">
                <h6 class="modal-title">Pilih Tipe User Baru</h6>
                <button type="button" id="btn-close-doc" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-3">
                        <div class="card text-center p-4">
                            <i class="fas fa-user-graduate fa-3x mb-3 text-dark"></i>
                            <h5 class="card-title">Siswa</h5>
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal_add_siswa">Daftar</a>                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card text-center p-4">
                            <i class="fas fa-chalkboard-teacher fa-3x mb-3 text-dark"></i>
                            <h5 class="card-title">Tenaga Pendidik</h5>
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal_add_tendik">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal New User as Siswa --}}
<div id="modal_add_siswa" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header text-white bg-warning">
                <h6 class="modal-title">Tambah User Siswa</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-add-user-siswa" method="post">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="position" id="position" value="siswa">
                     <div class="row">
                        <div class="col-lg-6 col-12 pall">
                            <div class=" border-round">
                                <div class="form-group mb-3">
                                    <label><span class="text-danger">*</span>NISN:</label>
                                    <input type="number" class="form-control" name="nisn" id="nisn" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label><span class="text-danger">*</span>Nama Lengkap:</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label><span class="text-danger">*</span> Kelas:</label>
                                    <select class="form-control form-select" id="select_kelas" name="kelas_id" required>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <label><span class="text-danger">*</span>Tanggal Lahir :</label>
                                        </div>
                                        <a class="fw-semibold text-warning" data-bs-toggle="collapse">
                                            <small>Ex : 27062003</small>
                                        </a>
                                    </div>
                                    <input type="number" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="ddmmyyyy" required>        
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 pall">
                            <div class=" border-round">
                                <div class="form-group mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <label><span class="text-danger">*</span>No.Telp Siswa:</label>
                                        </div>
                                        <a class="fw-semibold text-warning" data-bs-toggle="collapse">
                                            <small><i class="ph ph-notepad"></i> Support WhatsApp</small>
                                        </a>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">+62</span>
                                        </div> 
                                        <input id="no_telp_siswa" name="no_telp_siswa" type="number" placeholder="8123456789" required onkeyup="validateInput()" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label><span class="text-danger">*</span>Nama Orang Tua / Wali:</label>
                                    <input type="text" class="form-control" name="nama_ortu" id="nama_ortu" required>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <label><span class="text-danger">*</span>No.Telp Orang Tua / Wali:</label>
                                        </div>
                                        <a class="fw-semibold text-warning" data-bs-toggle="collapse">
                                            <small><i class="ph ph-notepad"></i> Support WhatsApp</small>
                                        </a>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">+62</span>
                                        </div> 
                                        <input id="no_telp_ortu" name="no_telp_ortu" type="number" placeholder="8123456789" required onkeyup="validateInput()" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-12 pall">
                                        <div class="form-group mb-3">
                                            <label class="mb-2"><span class="text-danger">*</span> Jenis Kelamin:</label>
                                            <div style="display: flex; align-items: center; gap: 15px;">
                                                <div class="radio">
                                                    <label><input class="form-check-input" type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" required> Perempuan</label>
                                                </div>
                                                <div class="radio" style="margin-left: 25px;">
                                                    <label><input class="form-check-input" type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-Laki" required> Laki-Laki</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 pall">
                                        <div class="form-group mb-3">
                                            <label><span class="text-danger">*</span>ID Fingerprint:</label>
                                            <input type="text" class="form-control" name="id_finger_auto" id="id_finger_auto" readonly disabled required>
                                            <input type="hidden" name="id_finger_auto_hidden" id="id_finger_auto_hidden">
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                     </div>
                </div>
                <div class="modal-footer">
                   <div class="form-group">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                   </div>
                   <div class="form-group">
                        <button type="submit" name="save" value="open" class="btn btn-primary" id="save-open">Save</button>
                   </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Sidik Jari -->
<div id="modal_add_fingerprint" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white d-flex justify-content-between">
                <h6 class="modal-title">Tambah Sidik Jari</h6>
                <button type="button" id="close_button_fg" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ url('assetImg/orange-fingerprint.gif') }}" alt="Scanning" class="img-fluid">
                <p>Mulai Memindai Sidik Jari...</p>
              </div>
        </div>
    </div>
</div>

{{-- Modal New User as Tenaga Didik --}}
<div id="modal_add_tendik" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header text-white bg-warning">
                <h6 class="modal-title">Tambah User Tenaga Didik</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-add-user-tendik" method="post">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{-- <input type="hidden" name="position" id="position" value="guru"> --}}
                    <div class="pall border-round">
                        <div class="form-group mb-3">
                            <label><span class="text-danger">*</span>NIP:</label>
                            <input type="number" class="form-control" name="nip" id="nip" required>
                        </div>
                        <div class="form-group mb-3">
                            <label><span class="text-danger">*</span>Nama Lengkap:</label>
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                        </div>
                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <label><span class="text-danger">*</span>Tanggal Lahir :</label>
                                </div>
                                <a class="fw-semibold text-warning" data-bs-toggle="collapse">
                                    <small>Ex : 27062003</small>
                                </a>
                            </div>
                            <input type="number" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="ddmmyyyy" required>
                        </div>
                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <label><span class="text-danger">*</span>No.Telp :</label>
                                </div>
                                <a class="fw-semibold text-warning" data-bs-toggle="collapse">
                                    <small><i class="ph ph-notepad"></i> Support WhatsApp</small>
                                </a>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input id="no_telp_tendik" name="no_telp_tendik" type="number" placeholder="8123456789" required onkeyup="validateInput()" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-2"><span class="text-danger">*</span> Posisi:</label>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div class="radio">
                                    <label><input class="form-check-input" type="radio" id="walikelas" name="position" value="walikelas" required> Walikelas</label>
                                </div>
                                <div class="radio">
                                    <label><input class="form-check-input" type="radio" id="guru-bk" name="position" value="guru-bk" required> Guru BK</label>
                                </div>
                                <div class="radio">
                                    <label><input class="form-check-input" type="radio" id="kesiswaan" name="position" value="kesiswaan" required> Kesiswaan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-2"><span class="text-danger">*</span> Jenis Kelamin:</label>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div class="radio">
                                    <label><input class="form-check-input" type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" required> Perempuan</label>
                                </div>
                                <div class="radio">
                                    <label><input class="form-check-input" type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-Laki" required> Laki-Laki</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="save" value="open" class="btn btn-primary" id="save-open">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

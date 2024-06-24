{{-- Modal Input Perizinan --}}
<div id="modal_add_izin" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header text-white bg-warning">
                <h6 class="modal-title">Tambah Perizinan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-add-izin" method="post">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_kelas" id="id_kelas">
                    <input type="hidden" name="id_walikelas" id="id_walikelas">
                    <div class="pall border-round">
                        <div class="form-group mb-3">
                            <label><span class="text-danger">*</span>Kelas:</label>
                            <input type="text" class="form-control" name="kelas" id="kelas" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label><span class="text-danger">*</span>Walikelas:</label>
                            <input type="text" class="form-control" name="walikelas" id="walikelas" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label><span class="text-danger">*</span>Waktu:</label>
                            <input type="date" class="form-control" name="tgl_izin" id="tgl_izin" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-2"><span class="text-danger">*</span> Keterangan Izin:</label>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div class="radio">
                                    <label><input class="form-check-input" type="radio" id="sakit" name="status_izin" value="sakit" required> Sakit</label>
                                </div>
                                <div class="radio">
                                    <label><input class="form-check-input" type="radio" id="izin" name="status_izin" value="izin" required> Izin</label>
                                </div>                                
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label><span class="text-danger">*</span> Deskripsi:</label>
                            <textarea class="form-control" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' rows="4" placeholder="Jelaskan dengan rinci alasan izin" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Lampiran :<br> <small><i>Ukuran maksimal: 500KB (jpg, png, pdf, docx)</small></i></label>
                            <input type="file" class="form-control" name="attachment" id="file_attachment" placeholder="masukkan bukti izin">
                            <span id="output1" class="text-success" style="font-size: 12px;"></span>
                            <span id="output2" class="text-danger" style="font-size: 12px;"></span>
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

{{-- Modal Detail Surat Izin --}}
<div id="modal_detail_izin" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header text-white bg-warning">
                <h6 class="modal-title">Detail Surat Izin</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="pall border-round">
                    <div class="form-group mb-3">
                        <label><span class="text-danger">*</span>Kelas:</label>
                        <input type="text" class="form-control" id="detail_kelas" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label><span class="text-danger">*</span>Walikelas:</label>
                        <input type="text" class="form-control" id="detail_walikelas" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label><span class="text-danger">*</span>Waktu:</label>
                        <input type="text" class="form-control" id="detail_tgl_izin" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2"><span class="text-danger">*</span> Keterangan Izin:</label>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div class="radio">
                                <label><input class="form-check-input" type="radio" id="detail_sakit" name="detail_status_izin" value="sakit" disabled> Sakit</label>
                            </div>
                            <div class="radio">
                                <label><input class="form-check-input" type="radio" id="detail_izin" name="detail_status_izin" value="izin" disabled> Izin</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label><span class="text-danger">*</span> Deskripsi:</label>
                        <textarea class="form-control" id="detail_description" rows="4" disabled></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Lampiran:</label>
                        <div id="detail_attachment">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

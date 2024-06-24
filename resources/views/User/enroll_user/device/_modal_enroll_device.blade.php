{{-- Input Form Checklist --}}
<div id="modal_add_device" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white d-flex justify-content-between bg-warning">
                <h6 class="modal-title">Tambah Device Finggerprint</h6>
                <button type="button" id="btn-close-doc" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="row card">
                    <form action="#" id="form-add-device" method="get">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label><span class="text-danger">*</span>Nama Device:</label>
                                <input type="text" class="form-control" name="de_name" id="de_name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label><span class="text-danger">*</span>Kelas Device:</label>
                                <input type="text" class="form-control" name="de_kelas" id="de_kelas" placeholder="X-MIPA-1" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Device --}}
<div id="modal_edit_device" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white d-flex justify-content-between bg-warning">
                <h6 class="modal-title">Edit Device Finggerprint</h6>
                <button type="button" id="btn-close-doc" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="row card">
                    <form action="#" id="form-edit-device" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="edt_de_id" name="device_id">
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label><span class="text-danger">*</span>Nama Device:</label>
                                <input type="text" class="form-control" name="edt_de_name" id="edt_de_name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label><span class="text-danger">*</span>Kelas Device:</label>
                                <input type="text" class="form-control" name="edt_de_kelas" id="edt_de_kelas" placeholder="X-MIPA-1" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2"><span class="text-danger">*</span> Mode Device:</label>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div class="radio">
                                        <label><input class="form-check-input" type="radio" id="edt_de_mode0" name="de_mode" value="0"> Enrollment</label>
                                    </div>
                                    <div class="radio">
                                        <label><input class="form-check-input" type="radio" id="edt_de_mode1" name="de_mode" value="1"> Attendance</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2"><span class="text-danger">*</span> Mode Device:</label>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div class="radio">
                                        <label><input class="form-check-input" type="radio" id="edt_de_active0" name="is_active" value="0"> Non-Active</label>
                                    </div>
                                    <div class="radio">
                                        <label><input class="form-check-input" type="radio" id="edt_de_active1" name="is_active" value="1"> Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
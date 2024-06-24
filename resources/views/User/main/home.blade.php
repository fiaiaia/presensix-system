@extends('layouts.app')
{{-- @section('dashboard','active') --}}
@section('judulmenu','Home')
@section('content')
<div class="card">
    <div class="card-header">
        <span class="h5">HOME</span>
    </div>
    <div class="card-body">
        <div class="panel-body tab-pane active" id="ss">
            <div class="row form-group">
                <div class="col-lg-12" style="display: flex; justify-content: center;">
                    <div class="text-center">
                        <br><br>
                        <h3>Selamat Datang di <b
                                class="text-warning fw-bold bg-light p-1 rounded shadow"><i class="text-nowrap">PRESENSIX SYSTEM</i></b>
                            <br>
                            <i><span class="randomteks"></span></i>
                            </h3>
                        <br>
                        {{-- {{ App\Helper\ChatNotif::chatnotif() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Start Modal Email Check --}}
@if(!auth()->user()->email)

<div id="modal_add_email" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-white bg-warning">
                <h6 class="modal-title">Add Email</h6>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <form action="#" id="form-add-email" method="get">
                <div class="modal-body">
                    <div class="text-center">
                        <label for="" class="mb-2 label label-block label-warning">Harap masukkan email aktif Anda!</label><br>
                        <label for="" style="background-color: #dbc50062;" class="alert p-0"><small class="text-dark"><i class="ph-info"></i> Contoh admin@gmail.com</small></label>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
                    <button class="btn btn-primary">Save Email</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load', function () {
        $('#modal_add_email').modal('show');
    });
</script>

@endif
{{-- End Modal Email Check --}}
@endsection

@section('js')

{{-- Create --}}
<script>
    $('#form-add-email').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        console.log(form.serialize());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: "{{ route('inputEmail') }}",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            async: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $.blockUI({
                    message: '<i class="ph-spinner spinner"></i><br><span>Processing...</span>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
            },
            success: function (response) {
                var notif = response.data;
                console.log(notif.value);
                if (notif.status == '200') {
                    alert(notif.status, notif.output);
                    $.unblockUI();
                    $('#modal_add_email').modal('hide');
                } else {
                    $.unblockUI();
                    alert(notif.status, notif.output);
                }
            },
            error: function (response) {
                var notif = response.data;
                alert(notif.status, notif.output);
                $('#modal_add_email').modal('hide');
                $.unblockUI();
            }
        });
    });
</script>

<script>
    class TextScramble {
  constructor(el) {
    this.el = el;
    this.chars = "XOXOXOXOXOXOXOXOXOXOXOXO";
    this.update = this.update.bind(this);
  }
  setText(newText) {
    const oldText = this.el.innerText;
    const length = Math.max(oldText.length, newText.length);
    const promise = new Promise((resolve) => (this.resolve = resolve));
    this.queue = [];
    for (let i = 0; i < length; i++) {
      const from = oldText[i] || "";
      const to = newText[i] || "";
      const start = Math.floor(Math.random() * 40);
      const end = start + Math.floor(Math.random() * 40);
      this.queue.push({
        from,
        to,
        start,
        end
      });
    }
    cancelAnimationFrame(this.frameRequest);
    this.frame = 0;
    this.update();
    return promise;
  }
  update() {
    let output = "";
    let complete = 0;
    for (let i = 0, n = this.queue.length; i < n; i++) {
      let { from, to, start, end, char } = this.queue[i];
      if (this.frame >= end) {
        complete++;
        output += to;
      } else if (this.frame >= start) {
        if (!char || Math.random() < 0.28) {
          char = this.randomChar();
          this.queue[i].char = char;
        }
        output += `<span class="dud">${char}</span>`;
      } else {
        output += from;
      }
    }
    this.el.innerHTML = output;
    if (complete === this.queue.length) {
      this.resolve();
    } else {
      this.frameRequest = requestAnimationFrame(this.update);
      this.frame++;
    }
  }
  randomChar() {
    return this.chars[Math.floor(Math.random() * this.chars.length)];
  }
}

// ——————————————————————————————————————————————————
// Пример :3
// ——————————————————————————————————————————————————

const phrases = [
  "",
  "Presensi",
  "Surat Izin",
  "Dashboard Pantau",
  "Report Kehadiran",
  "Digitalisasi Presensi",
];

const el = document.querySelector(".randomteks");
const fx = new TextScramble(el);

let counter = 0;
const next = () => {
  if(counter == 0){
    fx.setText(phrases[counter]).then(() => {
      setTimeout(next, 50000);
    });
  }else{
    fx.setText(phrases[counter]).then(() => {
      setTimeout(next, 5000);
    });
  }
  counter = (counter + 1) % phrases.length;
};

next();
</script>
@endsection
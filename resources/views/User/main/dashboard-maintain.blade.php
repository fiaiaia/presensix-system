@extends('layouts.app')
@section('dashboardMaintain','active')
@section('judulmenu','MAINTENANCE PAGE')
@section('content')
<div class="card">
    <div class="card-header">
        <span class="h5">MAINTENANCE PAGE</span>
    </div>
    <div class="card-body">
        <div class="panel-body tab-pane active" id="ss">
            <div class="row form-group">
                <div class="col-lg-12" style="display: flex; justify-content: center;">
                    <div class="text-center" style="padding: 0px 90px">
                        <img src="{{ url('assetImg/under_construction.gif') }}" onContextMenu="return false;" style="pointer-events: none;" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
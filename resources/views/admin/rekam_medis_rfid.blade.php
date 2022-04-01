

@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@section('header')
    Silahkan Scan Kartu Rekam Medis Pasien !
@endsection 

@section('content')
<div class="section-body">
    <div class="card">
    <div class="card-body text-center">
        <img src="{{ asset('assets/img/image_rfid.jpg') }}" width="600" height="600" alt="">
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script>
    $(document).ready(function(){
        //realtime get data from file rfid.blade.php
        setInterval(function() {
            $.ajax({
            async: false,
            cache: false,
            url: `create/rfid/get_rfid`, 
            type: "GET",
            dataType:"text",
            success: function(data) { 
                location.href = "create/rfid";
            }
        });

		}, 2000);

    });
</script>
@endpush






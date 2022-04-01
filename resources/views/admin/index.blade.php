@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@section('header')
    Dashboard 
@endsection 

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-user-injured"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Pasien Hari Ini</h4>
          </div>
          <div class="card-body">
            {{ $pasien_today }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-user-injured"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Pasien Minggu Ini</h4>
          </div>
          <div class="card-body">
            {{ $pasien_week }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-user-injured"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Pasien Bulan Ini</h4>
          </div>
          <div class="card-body">
            {{ $pasien_month }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-notes-medical"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Rekam Medis Hari Ini</h4>
          </div>
          <div class="card-body">
            {{ $rekam_today }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-notes-medical"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Rekam Medis Minggu Ini</h4>
          </div>
          <div class="card-body">
            {{ $rekam_week }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-notes-medical"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Rekam Medis Bulan Ini</h4>
          </div>
          <div class="card-body">
            {{ $rekam_month }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

 
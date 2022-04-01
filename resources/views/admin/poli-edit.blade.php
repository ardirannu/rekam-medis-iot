@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@section('header')
    Edit Poliklinik
@endsection 

@section('content')
<div class="section-body">
    <div class="card">
    <div class="card-body">
    <form action="{{ route('poliklinik.update', $poli->id )}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="row">
        <div class="col-md-12"> 
          <input type="hidden" name="id" value="{{ $poli->id}}" id="id_update">
          <div class="form-group">
            <label>Nama Poliklinik 
              @error('nama') <b @error('nama') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
            </label>
            <input type="text" name="nama" value="{{ $poli->nama}}" class="form-control">
          </div> 
          <div class="form-group">
            <label>Gedung 
              @error('gedung') <b @error('gedung') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
            </label>
            <input type="text" name="gedung" value="{{ $poli->gedung}}" class="form-control">
          </div>
            <button type="button" class="btn btn-warning"><a class="text-white" style="text-decoration: none" href="{{ route('poliklinik.index')}}">Kembali</a></button>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection




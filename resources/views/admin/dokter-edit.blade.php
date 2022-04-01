@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@section('header')
    Edit Dokter
@endsection 

@section('content')
<div class="section-body">
    <div class="card">
    <div class="card-body">
    <form action="{{ route('dokter.update', $dokter->id )}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="row">
        <div class="col-md-12"> 
          <input type="hidden" name="id" value="{{ $dokter->id}}" id="id_update">
          <div class="form-group">
            <label>Nama Dokter 
              @error('nama') <b @error('nama') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
            </label>
            <input type="text" name="nama" value="{{ $dokter->nama}}" class="form-control">
          </div> 
          <div class="form-group">
            <label>Spesialis 
              @error('spesialis') <b @error('spesialis') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
            </label>
            <input type="text" name="spesialis" value="{{ $dokter->spesialis}}" class="form-control">
          </div>
          <div class="form-group">
            <label>Email 
              @error('email') <b @error('email') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
            </label>
            <input type="text" name="email" value="{{ $dokter->email}}" class="form-control">
          </div>  
          <div class="form-group">
              <label>No. Handphone 
                @error('no_hp') <b @error('no_hp') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
              </label>
              <input type="number" name="no_hp" value="{{ $dokter->no_hp}}" class="form-control">
          </div> 
          <div class="form-group">
            <label>Alamat 
              @error('alamat') <b @error('alamat') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
            </label>
            <input type="text" name="alamat" value="{{ $dokter->alamat}}" class="form-control">
          </div>
            <button type="button" class="btn btn-warning"><a class="text-white" style="text-decoration: none" href="{{ route('dokter.index')}}">Kembali</a></button>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection




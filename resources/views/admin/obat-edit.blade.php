@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@section('header')
    Edit Obat
@endsection 

@section('content')
<div class="section-body">
    <div class="card">
    <div class="card-body">
    <form action="{{ route('obat.update', $obat->id )}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="row">
        <div class="col-md-12"> 
            <input type="hidden" name="id" value="{{ $obat->id}}" id="id_update">
            <div class="form-group">
                <label>Nama Obat 
                    @error('nama') <b @error('nama') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                </label>
                <input type="text" name="nama" value="{{ $obat->nama}}" class="form-control">
            </div> 
            <div class="form-group">
                <label>Harga 
                    @error('harga') <b @error('harga') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                </label>
                <input type="text" name="harga" value="{{ $obat->harga}}" class="form-control">
            </div> 
            <div class="form-group">
                <label>Keterangan 
                    @error('keterangan') <b @error('keterangan') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                </label>
                <input type="text" name="keterangan" value="{{ $obat->keterangan}}" class="form-control">
            </div> 
        
            <button type="button" class="btn btn-warning"><a class="text-white" style="text-decoration: none" href="{{ route('obat.index')}}">Kembali</a></button>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection




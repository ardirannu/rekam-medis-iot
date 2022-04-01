@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@push('page-styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/dt-1.10.24/datatables.min.css"/>
@endpush

@section('header')
    Poliklinik
@endsection 
 
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if (session('update_berhasil'))
                <div class="alert alert-warning alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>x</span>
                        </button>
                        <div class="container">
                            <div class="col-12">
                            {{ session('update_berhasil')}}
                            </div>
                        </div>
                    </div>  
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Data</button>
            </div>
            <div class="col-12">
                <hr>
              <div class="card">
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table id="table_id" class="text-center table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Poliklinik</th>
                                <th>Gedung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($poli as $no => $data)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->gedung }}</td>
                                <td class="text-left">
                                    <a href="{{ route('poliklinik.edit', $data->id) }}" class="badge badge-warning btn-edit">Edit</a>
                                    <a href="#" data-id="{{ $data->id }}" class="badge badge-danger swal-confirm">
                                        <form action="{{ route('poliklinik.destroy', $data->id) }}" id="delete{{ $data->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        </form> 
                                        Hapus
                                    </a> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="createModal">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('poliklinik.store')}}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama Poli 
                            @error('nama') <b @error('nama') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                          </label>
                          <input type="text" name="nama" value="{{ old('nama' ) }}" class="form-control">
                        </div> 
                        <div class="form-group">
                            <label>Gedung
                                @error('gedung') <b @error('gedung') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                              </label>
                            <select name="gedung" class="form-control">
                                <option value="" hidden>Pilih Gedung !</option>
                                <option name="gedung" value="Lt.1" @if(old('gedung') == "Lt.1") selected @endif>Lt.1</option>
                                <option name="gedung" value="Lt.2" @if(old('gedung') == "Lt.2") selected @endif>Lt.2</option>
                                <option name="gedung" value="Lt.3" @if(old('gedung') == "Lt.3") selected @endif>Lt.3</option>
                            </select>
                        </div>  
                      </div>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            </div>
        </div>
        </div>
    </div>

@endsection

@push('page-scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush

@push('after-scripts')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
 
    <script type="text/javascript" src="https://cdn.datatables.net/v/ju/dt-1.10.24/datatables.min.js"></script>

    <script>
        // alert konfirmasi hapus data
        $(".swal-confirm").click(function(e){
            id = e.target.dataset.id;
            swal({
                title: "Anda yakin ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Data berhasil dihapus!", {
                    icon: "success",
                    });
                    $(`#delete${id}`).submit();
                } else {

                }
            })
        });
        
        @if($errors->any())
            $('#createModal').modal('show')
        @endif
    </script>
@endpush
 
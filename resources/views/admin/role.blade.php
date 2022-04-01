@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@push('page-styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/dt-1.10.24/datatables.min.css"/>
@endpush

@section('header')
    Role Admin
@endsection 

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                @can('tombol_superadmin')
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Data</button>
                @endcan
                </div>
            <div class="col-12">
                <hr>
              <div class="card">
                <div class="card-body p-0">
                  <div class="table-responsive">
                    @can('table_superadmin')
                    <table id="table_id" class="text-center table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($role as $no => $data)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>
                                    <a href="#" data-id="{{ $data->id }}" class="badge badge-danger swal-confirm">
                                        <form action="{{ route('role.destroy', $data->id) }}" id="delete{{ $data->id }}" method="POST">
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
                    @endcan
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
                <form action="{{ route('role.store')}}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama Role 
                            @error('nama') <b @error('nama') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                          </label>
                          <input type="text" name="nama" value="{{ old('nama' ) }}" class="form-control">
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
 
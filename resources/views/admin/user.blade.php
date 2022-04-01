@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@push('page-styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/dt-1.10.24/datatables.min.css"/>
@endpush

@section('header')
    Daftar Pengguna
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
                                <th>Role</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $no => $data)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $data->role->nama }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                {{-- menampilkan data dengan langsung memanggil funtion relasinya --}}
                                {{-- <td>{{ $data->nomor->detail_nomor}} - {{ $data->nomor->operator->nama}}  --}}
                                {{-- </td>  --}}
                                <td class="text-center">
                                    <a href="#" data-id="{{ $data->id }}" class="badge badge-warning btn-edit">Edit</a>
                                    <a href="#" data-id="{{ $data->id }}" class="badge badge-danger swal-confirm">
                                        <form action="{{ route('user.destroy', $data->id) }}" id="delete{{ $data->id }}" method="POST">
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
                <form action="{{ route('user.store')}}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-md-12"> 
                        <div class="form-group">
                            <label>Tetapkan Role 
                                @error('role_id') <b @error('role_id') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                              </label>
                            <select name="role_id" class="form-control">
                              <option value="" hidden>Pilih Role !</option>
                              @foreach ($role as $data_role)
                                <option name="role_id" value="{{ $data_role->id }}" @if(old('role_id') == "{{ $data_role->id }}") selected @endif>{{ $data_role->nama }}</option>
                              @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                          <label>Username 
                            @error('name') <b @error('name') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                          </label>
                          <input type="text" name="name" value="{{ old('name' ) }}" class="form-control">
                        </div> 
                        <div class="form-group">
                          <label>Email 
                            @error('email') <b @error('email') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                          </label>
                          <input type="text" name="email" value="{{ old('email' ) }}" class="form-control">
                        </div> 
                        <div class="form-group">
                          <label>Password 
                            @error('password') <b @error('password') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                          </label>
                          <input type="password" id="password" name="password" value="{{ old('password' ) }}" class="form-control">
                          <input class="mt-2" type="checkbox" id="checkbox"> Show Password
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

    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Edit Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="" method="POST" id="form-edit">
                @csrf
            <div class="modal-body">
                
            </div>
            <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="button" class="btn btn-primary btn-update">Update</button>
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
    $(document).ready(function(){
        $('#checkbox').on('change', function(){
            $('#password').attr('type',$('#checkbox').prop('checked')==true?"text":"password"); 
        });
    });
    </script>

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

        $('.btn-edit').on('click', function(){
            let id = $(this).data('id')
            $.ajax({ 
                url:`user/${id}/edit`,
                method:"GET",
                success: function(data){
                    $('#editModal').find('.modal-body').html(data)
                    $('#editModal').modal('show')
                },
                error: function(error){
                    console.log(error)
                }
            })
        })
        
        $('.btn-update').on('click', function(){
            let id = $('#form-edit').find('#id_update').val()
            let formData = $('#form-edit').serialize()
            $.ajax({
                url:`user/${id}`,
                method:"PATCH",
                data: formData,
                success: function(data){
                    $('#editModal').modal('hide')
                    window.location.assign('user')
                },
                error: function(error){
                    console.log(error.responseJSON)
                    let error_log = error.responseJSON.errors;
                    if (error.status == 422 ){
                        if (typeof(error_log.name) !== 'undefined'){
                            $('#editModal').find('[name="name"]').prev()
                            .html('<span style="color:red">Username | '+ error_log.name[0]+'</span>')
                        }else{
                            $('#editModal').find('[name="name"]').prev().html('<span>Username</span>')
                        }
                        if (typeof(error_log.email) !== 'undefined'){
                            $('#editModal').find('[name="email"]').prev()
                            .html('<span style="color:red">Email | '+ error_log.email[0]+'</span>')
                        }else{
                            $('#editModal').find('[name="email"]').prev().html('<span>Email</span>')
                        }
                        if (typeof(error_log.role_id) !== 'undefined'){
                            $('#editModal').find('[name="role_id"]').prev()
                            .html('<span style="color:red">Role User | '+ error_log.role_id[0]+'</span>')
                        }else{
                            $('#editModal').find('[name="role_id"]').prev().html('<span>Role User</span>')
                        }
                        
                    }
                }
            })
        })
    </script>
@endpush
 
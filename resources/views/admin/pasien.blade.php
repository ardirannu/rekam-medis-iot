@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@push('page-styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/dt-1.10.24/datatables.min.css"/>
@endpush

@section('header')
    Pasien
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
                                <th>Nama Pasien</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>No Handphone</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasien as $no => $data)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->jkl }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->no_hp }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td class="text-left">
                                    <a href="{{ route('pasien.edit', $data->id) }}" class="badge badge-warning btn-edit">Edit</a>
                                    <a href="#" data-id="{{ $data->id }}" class="badge badge-danger swal-confirm">
                                        <form action="{{ route('pasien.destroy', $data->id) }}" id="delete{{ $data->id }}" method="POST">
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
                <form action="{{ route('pasien.store')}}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>ID Rekam Medis 
                            @error('kode_rekam_medis') <b @error('kode_rekam_medis') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                          </label>
                          <input type="text" name="kode_rekam_medis" value="{{ old('kode_rekam_medis' ) }}" class="form-control">
                        </div> 
                        <div class="form-group">
                          <label>Nama Pasien 
                            @error('nama') <b @error('nama') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                          </label>
                          <input type="text" name="nama" value="{{ old('nama' ) }}" class="form-control">
                        </div> 
                        <div class="form-group">
                            <label>Jenis Kelamin
                                @error('jkl') <b @error('jkl') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                              </label>
                            <select name="jkl" class="form-control">
                                <option value="" hidden>Pilih Jenis Kelamin !</option>
                                <option name="jkl" value="Laki-Laki" @if(old('jkl') == "Laki-Laki") selected @endif>Laki-Laki</option>
                                <option name="jkl" value="Perempuan" @if(old('jkl') == "Perempuan") selected @endif>Perempuan</option>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label>Email 
                              @error('email') <b @error('email') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                            </label>
                            <input type="text" name="email" value="{{ old('email' ) }}" class="form-control">
                        </div>  
                        <div class="form-group">
                            <label>No. Handphone 
                              @error('no_hp') <b @error('no_hp') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                            </label>
                            <input type="number" name="no_hp" value="{{ old('no_hp' ) }}" class="form-control">
                        </div>  
                        <div class="form-group">
                            <label>Alamat 
                              @error('alamat') <b @error('alamat') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                            </label>
                            <input type="text" name="alamat" value="{{ old('alamat' ) }}" class="form-control">
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
 
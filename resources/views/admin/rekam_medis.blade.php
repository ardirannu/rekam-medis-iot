@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@push('page-styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.css"/>
@endpush

@section('header')
    Rekam Medis
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
                <a class="btn btn-primary" href="{{ route('rekam_medis.create') }}">Tambah Data</a>
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
                                <th>Nama Dokter</th>
                                <th>Keluhan</th>
                                <th>Diagnosa</th>
                                <th>Obat</th>
                                <th>Poliklinik</th>
                                <th>Tanggal Periksa</th>
                                <th>Aksi</th>
                            </tr>
                         </thead>
                        <tbody>
                            @foreach ($rekam as $no => $data)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $data->kartu_pasien->pasien->nama }}</td>
                                <td>{{ $data->dokter->nama }}</td>
                                <td>{{ $data->keluhan }}</td>
                                <td>{{ $data->diagnosa }}</td>
                                <td>  
                                    @foreach (json_decode($data->obat_id) as $value)
                                        {{ $value }},
                                    @endforeach
                                </td>
                              
                                <td>{{ $data->poliklinik->nama }}</td>
                                <td>{{ $data->tgl_periksa }}</td>
                                <td class="text-left">
                                    <a href="{{ route('rekam_medis.edit', $data->id) }}" class="badge badge-warning btn-edit">Edit</a>
                                    <a href="#" data-id="{{ $data->id }}" class="badge badge-danger swal-confirm">
                                        <form action="{{ route('rekam_medis.destroy', $data->id) }}" id="delete{{ $data->id }}" method="POST">
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

@push('page-scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush

@push('after-scripts')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'pdf', 'excel', 'print'
            ]
        } );
        } );
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/ju/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.js"></script>


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
    </script>

@endpush
 
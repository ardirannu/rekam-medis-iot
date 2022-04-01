@extends('admin.layouts.master')

@push('page-styles')
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
@endpush

@section('title')
    Dashboard | Admin
@endsection

@section('header')
    Tambah Rekam Medis Pasien
@endsection 

@section('content') 
<div class="section-body">
    <div class="card">
    <div class="card-body">
        <form action="{{ route('rekam_medis.store')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label>Pasien 
                        @error('kartu_pasien_id') <b @error('kartu_pasien_id') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                      </label>
                    <select name="kartu_pasien_id" class="form-control">
                      <option value="" hidden>Pilih Pasien ! </option>
                      @foreach ($kartu_pasien as $data_kartu)
                        <option hidden name="kartu_pasien_id" value="{{ $data_kartu->id }}" @if("{{$rfid_check->data}}" == "{{ $data_kartu->kode_kartu }}") selected @endif>{{ $data_kartu->pasien->nama }} | {{ $data_kartu->pasien->kode_rekam_medis }} </option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label>Dokter 
                    @error('dokter_id') <b @error('dokter_id') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                  </label>
                  <select name="dokter_id" class="js-example-basic-single w-100 select2-hidden-accessible" aria-hidden="true">
                    @foreach ($dokter as $data_dokter)
                      <option name="dokter_id" value="{{ $data_dokter->id }}" @if(old('dokter_id') == "{{ $data_dokter->id }}") selected @endif>{{ $data_dokter->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label>Keluhan
                      @error('keluhan') <b @error('keluhan') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                    </label>
                    <input type="text" name="keluhan" value="{{ old('keluhan' ) }}" class="form-control">
                </div> 
                <div class="form-group">
                    <label>Diagnosa
                      @error('diagnosa') <b @error('diagnosa') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                    </label>
                    <input type="text" name="diagnosa" value="{{ old('diagnosa' ) }}" class="form-control">
                </div> 
                <div class="form-group">
                  <label>Obat
                    @error('obat') <b @error('obat') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                  </label>
                  <select name="obat_id[]" class="js-example-basic-multiple w-100 select2-hidden-accessible" multiple="" tabindex="-1" aria-hidden="true">
                    @foreach ($obat as $data_obat)
                    <option name="obat_id[]" value="{{ $data_obat->nama }}">{{ $data_obat->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Poliklinik 
                    @error('poliklinik_id') <b @error('poliklinik_id') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                  </label>
                  <select name="poliklinik_id" class="js-example-basic-single w-100 select2-hidden-accessible" aria-hidden="true">
                    @foreach ($poli as $data_poli)
                    <option name="poliklinik_id" value="{{ $data_poli->id }}" @if(old('poliklinik_id') == "{{ $data_poli->id }}") selected @endif>{{ $data_poli->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Periksa
                      @error('tgl_periksa') <b @error('tgl_periksa') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                    </label>
                    <input type="date" id="tgl_periksa" name="tgl_periksa" class="form-control" >
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
@endsection

@push('after-scripts')
<!-- Plugin js for this page -->
<script src="{{ asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="{{ asset('assets/js/file-upload.js') }}"></script>
<script src="{{ asset('assets/js/typeahead.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
  <!-- End custom js for this page-->
@endpush
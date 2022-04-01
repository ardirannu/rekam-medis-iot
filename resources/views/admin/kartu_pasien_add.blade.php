

@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@section('header')
    Tambah Kartu Pasien
@endsection 

@section('content')
<div class="section-body">
    <div class="card">
    <div class="card-body">
        <form action="{{ route('kartu.store')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label>Pasien 
                        @error('pasien_id') <b @error('pasien_id') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                      </label>
                    <select name="pasien_id" class="form-control">
                      <option value="" hidden>Pilih Pasien !</option>
                      @foreach ($pasien as $data_pasien)
                        <option name="pasien_id" value="{{ $data_pasien->id }}" @if(old('pasien_id') == "{{ $data_pasien->id }}") selected @endif>{{ $data_pasien->nama }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label>Kode Kartu (Silahkan Scan Kartu !)
                    @error('kode_kartu') <b @error('kode_kartu') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
                  </label>
                  <input type="text" id="getUID" name="kode_kartu" class="form-control" readonly>
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
</div>
@endsection

@push('page-scripts')
<script>
    $(document).ready(function(){
        var rfid="";
        //realtime get data from file rfid.blade.php
        setInterval(function() {
            $.ajax({
            async: false,
            cache: false,
            url: `rfid/get_rfid`, 
            type: "GET",
            dataType:"text",
            success: function(data) { 
                rfid = data;
            }
        });
            $("#getUID").val(rfid);
		}, 500);

    });
</script>
@endpush






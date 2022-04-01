<div class="row">
    <div class="col-md-12">
      <input type="hidden" name="id" value="{{ $user->id}}" id="id_update">
      <div class="form-group">
        <label>Tetapkan Role 
            @error('role_id') <b @error('role_id') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
          </label>
        <select name="role_id" class="form-control">
          <option value="" hidden>Pilih Role !</option>
          @foreach ($role as $data_role)
            <option name="role_id" value="{{ $data_role->id }}">{{ $data_role->nama }}</option>
          @endforeach
        </select>
    </div> 
      <div class="form-group"> 
        <label>Username 
          @error('name') <b @error('name') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
        </label>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
      </div> 
      <div class="form-group">
        <label>Email 
          @error('email') <b @error('email') class="text-danger" @enderror> {{ "(".$message.")" }} </b> @enderror
        </label>
        <input type="text" name="email" value="{{ $user->email }}" class="form-control">
      </div>  
    </div>
  </div>
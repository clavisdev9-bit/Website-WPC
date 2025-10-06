@extends('layouts.app')
@section('content')

<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          {{ $title }}
        </h2>
        <p class="text-muted">
            {{ $title }}
        </p>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form User</h3>
          </div>
            <div class="card-body">
                <form method="POST" action="{{ route('Administrator.store.user.management') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Fullname <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" placeholder="Fullname">
                                @error('fullname')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                      
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Username <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username">
                                @error('username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Email <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">
                                @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                       
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Password <small class="text-danger">*</small></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Password">
                                @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Konfirm Password <small class="text-danger">*</small></label>
                                <input type="password" class="form-control @error('passconf') is-invalid @enderror" name="passconf" value="{{ old('passconf') }}" placeholder="Confirm Password">
                                @error('passconf')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" >Role <small class="text-danger">*</small></label>
                                <select class="form-select @error('role') is-invalid @enderror" name="role" id="role">
                                    <option selected value="">Select</option>
                                     @foreach ($role as $rl)
                                           <option value="{{  $rl->id_role }}"  {{ old('role') == $rl->id_role ? 'selected' : '' }}>{{ $rl->role }}</option>
                                     @endforeach
                                </select>
                                    @error('role')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" >Group <small class="text-danger">*</small></label>
                                <select class="form-select @error('group') is-invalid @enderror" name="group" id="group">
                                    <option selected value="">Select</option>
                                    @foreach ($group as $gr)
                                          <option value="{{ $gr->id_group }}" {{ old('group') == $gr->id_group ? 'selected' : '' }}>{{ $gr->name_group }}</option>
                                    @endforeach
                                </select>
                                    @error('group')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" >Divisi <small class="text-danger">*</small></label>
                                <select class="form-select @error('divisi') is-invalid @enderror" name="divisi" id="divisi">
                                    <option selected value="">Select</option>
                                    @foreach ($divisi as $div)
                                          <option value="{{ $div->id }}" {{ old('divisi') == $div->id ? 'selected' : '' }}>{{ $div->name_division }}</option>
                                    @endforeach
                                </select>
                                    @error('divisi')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>



                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" >Status <small class="text-danger">*</small></label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                                <option selected value="">Select</option>
                               <option value="true" {{ old('status') === 'true' ? 'selected' : '' }}>Aktif</option>
                               <option value="false" {{ old('status') === 'false' ? 'selected' : '' }}>NonAktif</option>
                            </select>
                                @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                        </div>
                        </div>

                        
                    </div>

                    
                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>

</form>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    // assetCode
    $(document).ready(function() {
        $("#role").select2({
          placeholder: "SELECT A ROLE",
           allowClear: true,
           theme: 'bootstrap4',
        });

        $("#group").select2({
          placeholder: "SELECT A GROUP",
           allowClear: true,
           theme: 'bootstrap4',
        });

        $("#divisi").select2({
          placeholder: "SELECT A DIVISI",
           allowClear: true,
           theme: 'bootstrap4',
        });

        $("#status").select2({
          placeholder: "SELECT A STATUS",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });
</script>

@endsection
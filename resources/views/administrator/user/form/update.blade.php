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
                <form method="POST" action="{{ route('Administrator.update.user.management') }}"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Fullname <small class="text-danger">*</small></label>
                                <input type="hidden" class="form-control" name="id_user" value="{{ $id }}" placeholder="id">
                                <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname', $row->fullname) }}" placeholder="Fullname">
                                @error('fullname')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                      
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Username <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username' , $row->username) }}" placeholder="Username">
                                @error('username')
                                 <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Email <small class="text-danger">*</small></label>
                                <input type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    name="email" 
                                    value="{{ old('email', $row->email) }}" 
                                    placeholder="Email address">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                       
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Password <small class="text-danger">*</small></label>
                                <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Password">
                                <small class="badge badge-outline text-orange font-italic mt-1">Biarkan Kosong Jika password tidak Di ubah</small>
                                @error('password')
                                 <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Konfirm Password <small class="text-danger">*</small></label>
                                <input type="password" class="form-control  @error('passconf') is-invalid @enderror" name="passconf" value="{{ old('passconf') }}" placeholder="Confirm Password">
                                <small class="badge badge-outline text-orange font-italic mt-1">Biarkan Kosong Jika password tidak Di ubah</small>
                                @error('passconf')
                                 <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" >Role <small class="text-danger">*</small></label>
                                <select class="form-select  @error('role') is-invalid @enderror" name="role" id="role">
                                    <option selected value="">Select</option>
                                     @foreach ($role as $rl)
                                           <option value="{{  $rl->id_role }}"  {{ old('role', $row->role_id) == $rl->id_role ? 'selected' : '' }}>{{ $rl->role }}</option>
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
                                <select class="form-select  @error('group') is-invalid @enderror" name="group" id="group">
                                    <option selected value="">Select</option>
                                    @foreach ($group as $gr)
                                          <option value="{{ $gr->id_group }}" {{ old('group', $row->group_id) == $gr->id_group ? 'selected' : '' }}>{{ $gr->name_group }}</option>
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
                                <select class="form-select  @error('divisi') is-invalid @enderror" name="divisi" id="divisi">
                                    <option selected value="">Select</option>
                                    @foreach ($divisi as $div)
                                          <option value="{{ $div->id }}" {{ old('divisi', $row->divisi_id) == $div->id ? 'selected' : '' }}>{{ $div->name_division }}</option>
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
                            <select class="form-select  @error('status') is-invalid @enderror" name="status" id="status">
                                <option selected value="">Select</option>
                                <option value="1" {{ old('status', $row->is_active ?? '') == 1 ? 'selected' : '' }}>AKTIF</option>
                                <option value="0" {{ old('status', $row->is_active ?? '') == 0 ? 'selected' : '' }}>NONAKTIF</option>
                            </select>
                                @error('status')
                                 <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" >Image <small class="text-danger">(opsional)</small></label>
                                <img id="imgPreview" src="{{ url('/avatar/' . $row->image) }}" class="img-thumbnail" alt="Avatar" style="width: 100px;"/>
                            </div>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" class="custom-file-input" id="image"  id="customFile" accept="image/png, image/jpeg, image/jpg, image/gif">
                        <input type="hidden" name="imageold" value="{{($row->image)}}" class="form-control mt-2" id="coversold">
                        <small class="text-danger font-italic">Rekomendasi image width 100px - Hight 100px - ext(jpg or png)</small>
                       @error('image')
                             <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>


                      <script>
                      $(".custom-file-input").on("change", function() {
                      var fileName = $(this).val().split("\\").pop();
                      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                      });
                     </script>
                   

                    
                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-primary">Update</button>
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

      
                $("#image").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $("#imgPreview")
                              .attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
          


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
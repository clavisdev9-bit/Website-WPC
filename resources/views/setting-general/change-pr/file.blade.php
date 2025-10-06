@extends('layouts.app')
@section('content')

<div class="page-wrapper">
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">Account Settings</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- END PAGE HEADER -->

    <div id="flash" data-flash="{{ session('success') }}"></div>
    <div id="flashError" data-flash="{{ session('error') }}"></div>
    <div id="flashInfo" data-flash="{{ session('info') }}"></div>
      
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
              <div class="card-body">
                <h4 class="subheader">Account Settings</h4>
                <div class="list-group list-group-transparent">
                  <a href="" class="list-group-item list-group-item-action d-flex align-items-center active">My Account</a>
                </div>
                
              </div>
            </div>
            <div class="col-12 col-md-9 d-flex flex-column">
              <div class="card-body">
                <h2 class="mb-4">My Account</h2>
                <h3 class="card-title">Profile Details</h3>

                <form method="POST" action="{{ url('Setting_General/Change-profile-user') }}"  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  @php
                  $avatarSize = 'xl';
                  $defaultImg = 'default.jpg';
                  $imageUrl = $user->image ? route('avatar.show', ['filename' => $user->image]) : asset('storage/profile/' . $defaultImg);
                  $version = $user->image ? time() : time(); // Anda bisa menyesuaikan versioning untuk route
                  @endphp

                <div class="row align-items-center">
                  <div class="col-auto">
                    <img src="{{ $imageUrl }}?v={{ $version }}" id="imgPreview" 
                    width="{{ config('avatar.sizes.'.$avatarSize.'.width') }}"
                    height="{{ config('avatar.sizes.'.$avatarSize.'.height') }}"
                    class="img-thumbnail avatar avatar-{{ $avatarSize }}"
                    alt="{{ $row->fullname ?? 'User' }} profile"
                    loading="lazy"
                    onerror="this.src='{{ asset('storage/profile/'.$defaultImg) }}'">
                  </div>
                  <div class="col-auto">
                    <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" class="custom-file-input" id="image"  id="customFile" accept="image/png, image/jpeg, image/jpg, image/gif">
                    <input type="hidden" name="imageold" value="{{($user->image)}}" class="form-control mt-2" id="coversold">
                  </div>
                 
                </div>
                <h3 class="card-title mt-4">Your Data Profile</h3>
                <div class="row g-3">
                  <div class="col-md">
                    <div class="form-label">FullName</div>
                    <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ $user->fullname }}"/>
                    @error('fullname')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                  </div>
                 


                  <div class="col-md">
                    <div class="form-label">Status</div>
                    <input type="text" class="form-control" value="{{ ($user->is_active === true ? 'Aktif' : 'NonAktif') }}" disabled/>
                  </div>
                </div>
              
              </div>
              

              <div class="card-footer text-end">
                <div class="d-flex">
                  <button type="submit" class="btn btn-primary ms-auto">Change Profile</button>
                </div>
              </div>



            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END PAGE BODY -->


    <script>
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


                $(".custom-file-input").on("change", function() {
                      var fileName = $(this).val().split("\\").pop();
                      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                      });
    </script>
      
    @endsection 
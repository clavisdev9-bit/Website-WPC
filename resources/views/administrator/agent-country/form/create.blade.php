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
          <h3 class="card-title"> {{ $title }}</h3>
        </div>
        <div class="card-body">
          <form  action="{{ route('Administrator.store.agent.network.country') }}" method="POST"  enctype="multipart/form-data" class="mx-auto col-md-6">
          @csrf

            <div class="mb-1">
              <label class="form-label"> Country*</label>
                <select name="country" id="country"  class="form-control">
                    <option value="">-- Select Country --</option>
                     @foreach ($dataCountry as $country)
                        <option value="{{ $country['name'] }}" data-iso="{{ $country['code'] }}">
                            {{ $country['name'] }} ({{ $country['code'] }})
                        </option>
                    @endforeach
                </select>
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-1 mt-2">
              <label class="form-label"> ISO Code*</label>
              <input type="text" name="iso_code" class="form-control" readonly>
              @error('iso_code')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


             <div class="mb-1 mt-2">
              <label class="form-label"> Flag Country</label>
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img id="imgPreview" src="" alt="prev image"   style="width: 150px; height: 90px; object-fit: cover; border-radius: 4px;"/>
                                    <div class="mr-2"></div>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" name="flag" 
                                    class="custom-file-input" id="image"   id="customFile" accept="image/png, image/jpeg, image/jpg, image/gif, image/webp" />
                                    </div>
              @error('flag')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

  
          
            <!-- Submit Button -->
            <div class="form-footer">
              <button type="submit" class="btn btn-outline-primary">Submit</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">


                      $(".custom-file-input").on("change", function() {
                      var fileName = $(this).val().split("\\").pop();
                      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                      });
                      $(document).ready(() => {
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
                   $("#country").change(function () {
                    const selected = $(this).find(':selected');
                    const isoCode = selected.data('iso') || '';
                    $('input[name="iso_code"]').val(isoCode);
                });
             });


</script>




@endsection 


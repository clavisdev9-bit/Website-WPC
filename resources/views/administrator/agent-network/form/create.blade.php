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
          <form  action="{{ route('Administrator.store.agent.network') }}" method="POST"
          enctype="multipart/form-data"
          class="mx-auto col-md-6">
          @csrf

           <div class="mb-1 mt-2">
              <label class="form-label"> Name Agent*</label>
              <input type="text" name="name" value="{{ old('name') }}"
               class="form-control">
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1">
            <label class="form-label">Country Agent*</label>
            <select name="country" id="country" class="form-control">
                <option value="">-- Select Country --</option>
                @foreach ($dataCountry as $country)
                <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                @endforeach
            </select>
            @error('country')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="mb-1">
            <label class="form-label">City Agent*</label>
            <select name="city" id="city" class="form-control">
                <option value="">-- Select City --</option>
            </select>
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>



            <div class="mb-1 mt-2">
              <label class="form-label"> Address Agent*</label>
              <textarea name="address" id="address" cols="3" rows="3" class="form-control"></textarea>
              @error('address')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>



            <div class="mb-1 mt-2">
              <label class="form-label"> Latitude Agent*</label>
              <input type="text" name="lat" value="{{ old('lat') }}"
              placeholder="Enter latitude (e.g. -6.2000)"
               class="form-control">
              @error('lat')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


             <div class="mb-1 mt-2">
              <label class="form-label"> Longitude Agent*</label>
              <input type="text" name="lng" value="{{ old('lng') }}"
              placeholder="Enter longitude (e.g. 106.8166)"
               class="form-control">
              @error('lng')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1 mt-2">
              <label class="form-label"> Email Agent*</label>
              <input type="text" name="email" value="{{ old('email') }}"
               class="form-control">
              @error('email')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1 mt-2">
              <label class="form-label"> Phone Agent*</label>
              <input type="text" name="phone" value="{{ old('phone') }}"
               class="form-control">
              @error('phone')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1 mt-2">
              <label class="form-label"> Image Agent</label>
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img id="imgPreview" src="" alt="prev image"   style="width: 150px; height: 90px; object-fit: cover; border-radius: 4px;"/>
                                    <div class="mr-2"></div>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" 
                                    class="custom-file-input" id="image"   id="customFile" accept="image/png, image/jpeg, image/jpg, image/gif, image/webp" />
                                    </div>
              @error('image')
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

             });


</script>

<script type="text/javascript">
$(document).ready(function() {

  // Saat pilih country
  $('#country').on('change', function() {
    var countryId = $(this).val();
    $('#city').html('<option value="">-- Loading... --</option>');

    if(countryId) {
      $.ajax({
        url: "{{ url('Administrator/get-cities') }}/" + countryId,
        type: "GET",
        dataType: "json",
        success: function(data) {
          $('#city').empty();
          $('#city').append('<option value="">-- Select City --</option>');
          $.each(data, function(key, city) {
            $('#city').append('<option value="'+ city.id +'">'+ city.name +'</option>');
          });
        }
      });
    } else {
      $('#city').html('<option value="">-- Select City --</option>');
    }
  });

});
</script>


@endsection 


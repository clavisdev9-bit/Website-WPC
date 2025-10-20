@extends('layouts.app')
@section('content')

<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">{{ $title }}</h2>
        <p class="text-muted">{{ $title }}</p>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="container-xl">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
      </div>

      <div class="card-body">
        <form action="{{ route('Administrator.update.agent.network', $idData) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="mx-auto col-md-6">
          @csrf
          @method('PUT')

          {{-- ID (hidden jika tidak perlu ditampilkan) --}}
          <input type="hidden" name="id" value="{{ $idData }}">

          {{-- Name --}}
          <div class="mb-2 mt-2">
            <label class="form-label">Name Agent*</label>
            <input type="text" name="name" value="{{ old('name', $agent->name) }}" class="form-control">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          {{-- Country --}}
          <div class="mb-2">
            <label class="form-label">Country Agent*</label>
            <select name="country" id="country" class="form-control">
              <option value="">-- Select Country --</option>
              @foreach ($dataCountry as $country)
                <option value="{{ $country->id }}" {{ $agent->country_id == $country->id ? 'selected' : '' }}>
                  {{ $country->name }}
                </option>
              @endforeach
            </select>
            @error('country') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          {{-- City --}}
          <div class="mb-2">
            <label class="form-label">City Agent*</label>
            <select name="city" id="city" class="form-control">
              <option value="">-- Select City --</option>
              @foreach ($dataCity as $city)
                <option value="{{ $city->id }}" {{ $agent->city_id == $city->id ? 'selected' : '' }}>
                  {{ $city->name }}
                </option>
              @endforeach
            </select>
            @error('city') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          {{-- Address --}}
          <div class="mb-2">
            <label class="form-label">Address*</label>
            <textarea name="address" class="form-control" rows="3">{{ old('address', $agent->address) }}</textarea>
            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          {{-- Lat & Lng --}}
          <div class="row">
            <div class="col-md-6 mb-2">
              <label class="form-label">Latitude*</label>
              <input type="text" name="lat" value="{{ old('lat', $agent->lat) }}" class="form-control">
              @error('lat') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-2">
              <label class="form-label">Longitude*</label>
              <input type="text" name="lng" value="{{ old('lng', $agent->lng) }}" class="form-control">
              @error('lng') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Email --}}
          <div class="mb-2">
            <label class="form-label">Email*</label>
            <input type="email" name="email" value="{{ old('email', $agent->email) }}" class="form-control">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          {{-- Phone --}}
          <div class="mb-2">
            <label class="form-label">Phone*</label>
            <input type="text" name="phone" value="{{ old('phone', $agent->phone) }}" class="form-control">
            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          {{-- Status --}}
          <div class="mb-2">
            <label class="form-label">Status*</label>
            <select name="status" class="form-control">
              <option value="active" {{ $agent->status == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ $agent->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>

          {{-- Image Preview --}}
          <div class="mb-2">
            <label class="form-label d-block">Agent Image</label>
            <img id="imgPreview" 
                 src="{{ $agent->image ? route('agent.image.show', $agent->image) : asset('images/DefaultAgent.jpg') }}"
                 class="img-thumbnail mb-2 border"
                 alt="Preview" 
                 style="width: 150px; height: 90px; object-fit: cover; border-radius: 4px;">

            <input 
              class="form-control @error('image') is-invalid @enderror" 
              type="file" 
              name="image" 
              id="image"
              accept="image/png, image/jpeg, image/jpg, image/gif, image/webp">

            {{-- old image --}}
            <input type="hidden" name="image_old" value="{{ $agent->image ?? '' }}">

            <small class="text-muted d-block mt-1">
              Rekomendasi: 100x100px, format JPG/PNG/GIF
            </small>

            @error('image')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          {{-- Buttons --}}
          <div class="form-footer mt-3">
            <button type="submit" class="btn btn-outline-primary">Update</button>
            <a href="{{ route('Administrator.agent.network') }}" class="btn btn-outline-secondary">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

{{-- Script --}}
<script>
$(document).ready(function() {
  // Preview image
  $("#image").change(function () {
    const file = this.files[0];
    if (file) {
      let reader = new FileReader();
      reader.onload = function (event) {
        $("#imgPreview").attr("src", event.target.result);
      };
      reader.readAsDataURL(file);
    }
  });

  // Dependent city dropdown
  $('#country').on('change', function() {
    var countryId = $(this).val();
    $('#city').html('<option value="">-- Loading... --</option>');
    if(countryId) {
      $.ajax({
        url: "{{ url('Administrator/get-cities') }}/" + countryId,
        type: "GET",
        dataType: "json",
        success: function(data) {
          $('#city').empty().append('<option value="">-- Select City --</option>');
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

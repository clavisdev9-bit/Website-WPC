@extends('layouts.app')
@section('content')

<div class="page-body">
  <div class="container-xl">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('Administrator.agent.network.country.view.updates') }}"
              method="POST" 
              enctype="multipart/form-data" 
              class="mx-auto col-md-6">
          @csrf
          @method('PUT')

          <div class="mb-1">
            <label class="form-label">Country*</label>
            <select name="country" id="country" class="form-control">
              <option value="">-- Select Country --</option>
              @foreach ($dataCountry as $country)
                <option 
                  value="{{ $country['name'] }}" 
                  data-iso="{{ $country['code'] }}"
                  {{ $row->name === $country['name'] ? 'selected' : '' }}>
                  {{ $country['name'] }} ({{ $country['code'] }})
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-1 mt-2">
            <label class="form-label">ISO Code*</label>
              <input type="hidden" name="id" class="form-control" 
                   value="{{ $idCountry }}" readonly>
            <input type="text" name="iso_code" class="form-control" 
                   value="{{ $row->iso_code }}" readonly>
          </div>

          <div class="col-md-4">
  <div class="mb-3">
    <label for="flag" class="form-label">
      Flag <small class="text-danger">(*)</small>
    </label>

    {{-- Preview Image --}}
   <img id="imgPreview" 
     src="{{ isset($row) && $row->flag ? route('flag.image.show', $row->flag) : asset('images/defaultFlag.png') }}"
     class="img-thumbnail mb-2 border"
     alt="Preview" 
     style="width: 150px; height: 90px; object-fit: cover; border-radius: 4px;">


    {{-- Input File --}}
    <input 
        class="form-control @error('flag') is-invalid @enderror" 
        type="file" 
        name="flag" 
        id="flag"
        accept="image/png, image/jpeg, image/jpg, image/gif, image/webp">

    {{-- Simpan nama file lama --}}
    <input type="hidden" name="flag_old" value="{{ $row->flag ?? '' }}" />

    <small class="text-muted">
      Rekomendasi: 100x100px, format: JPG/PNG/GIF
    </small>

    @error('flag')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>
</div>

<script>
  document.getElementById('flag').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(evt) {
        document.getElementById('imgPreview').src = evt.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>


          <div class="form-footer mt-3">
            <button type="submit" class="btn btn-outline-primary">Update</button>
            <a href="{{ route('Administrator.agent.network.country') }}" class="btn btn-outline-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(() => {


    // Autofill ISO code
    $("#country").change(function () {
      const selected = $(this).find(':selected');
      const isoCode = selected.data('iso') || '';
      $('input[name="iso_code"]').val(isoCode);
    });
  });
</script>
@endsection

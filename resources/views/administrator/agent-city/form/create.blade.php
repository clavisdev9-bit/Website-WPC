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
          <form  action="" method="POST"  enctype="multipart/form-data" class="mx-auto col-md-6">
          @csrf

            <div class="mb-1">
              <label class="form-label"> Country*</label>
                <select name="country" id="country"  class="form-control">
                    <option value="">-- Select Country --</option>
                        @foreach ($country as $ct)
                                    <option value="{{ $ct->id }}" 
                                    {{ old('country') == $ct->id ? 'selected' : '' }}>
                                        {{ $ct->name }}
                                    </option>
                        @endforeach
                </select>
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-1 mt-2">
              <label class="form-label"> Name City*</label>
              <input type="text" name="iso_code" class="form-control">
              @error('iso_code')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1 mt-2">
              <label class="form-label"> Latitude*</label>
              <input type="text" name="iso_code" class="form-control">
              @error('iso_code')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


             <div class="mb-1 mt-2">
              <label class="form-label"> Longitude *</label>
              <input type="text" name="iso_code" class="form-control">
              @error('iso_code')
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




@endsection 


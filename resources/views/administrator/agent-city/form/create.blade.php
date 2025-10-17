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
          <form  action="{{ route('Administrator.store.agent.network.city') }}" method="POST"
          enctype="multipart/form-data"
          class="mx-auto col-md-6">
          @csrf

            <div class="mb-1">
              <label class="form-label"> Country*</label>
                <select name="country" id="country" class="form-control">
                  <option value="">-- Select Country --</option>
                  @foreach ($country as $ct)
                      <option 
                          value="{{ $ct->id }}" 
                          {{ (string) old('country') === (string) $ct->id ? 'selected' : '' }}>
                          {{ $ct->name }}
                      </option>
                  @endforeach
              </select>
              @error('country')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1 mt-2">
              <label class="form-label"> Name City*</label>
              <input type="text" name="name" value="{{ old('name') }}"
               class="form-control">
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1 mt-2">
              <label class="form-label"> Latitude*</label>
              <input type="text" name="lat" value="{{ old('lat') }}"
              placeholder="Enter latitude (e.g. -6.2000)"
               class="form-control">
              @error('lat')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


             <div class="mb-1 mt-2">
              <label class="form-label"> Longitude *</label>
              <input type="text" name="lng" value="{{ old('lng') }}"
              placeholder="Enter longitude (e.g. 106.8166)"
               class="form-control">
              @error('lng')
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


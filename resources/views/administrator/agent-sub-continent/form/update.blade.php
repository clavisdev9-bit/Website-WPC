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
          <form  action="{{ route('Administrator.update.agent.network.subcontinent', $id) }}" 
          method="POST"
          enctype="multipart/form-data"
          class="mx-auto col-md-6">
          @csrf
          @method('PUT')

            <div class="mb-1">
            <label class="form-label">Continent*</label>
            <select name="continent" id="continent" class="form-control">
                <option value="">-- Select Continent --</option>
                @foreach ($continent as $ct)
                <option 
                    value="{{ $ct->id }}" 
                    {{ (string) old('continent', $row->continent_id ?? '') === (string) $ct->id ? 'selected' : '' }}>
                    {{ $ct->name }}
                </option>
                @endforeach
            </select>
            @error('continent')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>



            <div class="mb-1 mt-2">
              <label class="form-label"> Name Sub-Continent*</label>
              <input type="text" name="name" value="{{ old('name', $row->name) }}" 
               placeholder="Enter Name"
               class="form-control">
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1 mt-2">
              <label class="form-label">Code Sub-Continent*</label>
              <input type="text" name="code" value="{{ old('code', $row->code) }}"
               placeholder="Enter Code Sub-Continent" 
               class="form-control">
              @error('code')
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


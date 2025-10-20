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
          <form  action="{{ route('Administrator.update.agent.network.continent', $id) }}" method="POST"  enctype="multipart/form-data" class="mx-auto col-md-6">
          @csrf
          @method('PUT')

            <div class="mb-1 mt-2">
              <label class="form-label"> Name Continent*</label>
              <input type="text" value="{{ $row->name }}" name="name" class="form-control">
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1 mt-2">
              <label class="form-label"> ISO Code Continent*</label>
              <input type="text" name="code" value="{{ $row->code }}" class="form-control">
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


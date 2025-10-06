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
            Form {{ $title }}
          </p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="page-body">
    <div class="container-xl">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Management Role Form</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('Administrator.update.role.management') }}" method="POST" class="mx-auto col-md-6">
            @csrf
            @method('PUT')
          
            <input type="hidden" name="idRole" class="form-control" value="{{ old('role', $idRole) }}">
            <div class="mb-1">
              <label class="form-label"> Name Role*</label>
              <input type="text" name="role" value="{{ old('role', $row->role) }}"  class="form-control" placeholder="Enter role name">
              @error('role')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

          
            <!-- Submit Button -->
            <div class="form-footer">
              <button type="submit" class="btn btn-outline-primary">Update</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



@endsection 


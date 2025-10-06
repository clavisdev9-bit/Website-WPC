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

  <div id="flash" data-flash="{{ session('success') }}"></div>
<div id="flashError" data-flash="{{ session('error') }}"></div>
<div id="flashInfo" data-flash="{{ session('info') }}"></div>
  
  <div class="page-body">
    <div class="container-xl">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Change Password</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('Setting_General.change.password.user') }}" method="POST"  class="mx-auto col-md-6">
          @csrf

            <div class="mb-1">
              <label class="form-label"> New Password*</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter New Password">
              @error('password')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-1 mt-2">
                <label class="form-label"> Confirm New Password*</label>
                <input type="password" name="passconf" class="form-control @error('passconf') is-invalid @enderror" placeholder="Enter New Password Confirm">
                @error('passconf')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
  
          
            <!-- Submit Button -->
            <div class="form-footer">
              <button type="submit" class="btn btn-outline-primary">Change</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



@endsection 
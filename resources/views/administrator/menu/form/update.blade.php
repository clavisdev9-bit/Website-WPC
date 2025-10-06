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
          <h3 class="card-title">Management Menu Form</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('Administrator.update.menu.management') }}" class="mx-auto col-md-6">
          @csrf
          @method('PUT')

           <input type="hidden" name="idMenu"  value="{{ $idMenu }}" class="form-control" placeholder="Enter menu name" readonly>
            <div class="mb-0">
              <label class="form-label"> Name Menu*</label>
              <input type="text" name="menu"  value="{{ $row->menu }}" class="form-control" placeholder="Enter menu name">
              @error('menu')
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
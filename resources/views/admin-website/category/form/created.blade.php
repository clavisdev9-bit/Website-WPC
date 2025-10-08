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
          <h3 class="card-title">Management {{ $title }}</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('store.category.blogs') }}" method="POST"  class="mx-auto col-md-6">
          @csrf

            <div class="mb-1">
              <label class="form-label"> Name Category*</label>
              <input type="text" name="name" class="form-control" placeholder="Enter name category">
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1">
              <label class="form-label"> Description Category*</label>
             <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
              @error('description')
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


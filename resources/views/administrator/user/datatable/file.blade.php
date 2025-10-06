@extends('layouts.app')
@section('content')

 <!-- Page Header -->
 <div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            {{ $title }}
        </div>
        <h2 class="page-title">
            {{ $title }}
        </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{  route('Administrator.create.user.management') }}" class="btn btn-outline-azure">
             <i class="fa fa-plus">  </i>Create
            </a>
        </div>
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
            <h3 class="card-title"> {{ $title }}</h3>
        </div>
        <div class="table-responsive mb-4 p-3">
            <table class="table card-table table-vcenter text-nowrap" id="userTable">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Name</th>
                        {{-- <th>Username</th> --}}
                        <th>Email</th>
                        <th>Group</th>
                        {{-- <th>Divisi</th> --}}
                        <th style="width: 10%;">Role</th>
                        <th style="width: 15px;">Image</th>
                        <th style="width: 15px;">Detail</th>
                        <th style="width: 15px;">Access</th>
                        <th style="width: 25px;">Action</th>
                      </tr>

                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>





<div class="modal modal-blur fade" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
	<h5 class="modal-title">Data user</h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
	


    <div class="container">
        <article class="card">
            <header class="card-header"> Details Data user </header>
            <div class="card-body">

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>FullName:</strong> <br> <p id="fn"></p> </div>
                        <div class="col"> <strong>Username:</strong> <br> <p id="un"></p> </div>
                        <div class="col"> <strong>Status:</strong> <br> <p id="st"></p> </div>
                    </div>
                </article>
                <hr>

                <article class="card">
                    <div class="card-body row">
                    <div class="col"> <strong>Password:</strong> <br> <textarea class="form-control" id="pw" cols="10" rows="5" readonly></textarea> </div>
                    </div>
                </article>
                <hr>
            </div>
        </article>
    </div>
        
          </div>
          
<div class="modal-footer">
	<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
</div>
		</div>
	</div>
</div>

<meta name="route-user-get" content="{{ route('Administrator.get.user.management') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
		
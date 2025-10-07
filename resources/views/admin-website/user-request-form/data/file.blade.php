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
            <table class="table card-table table-vcenter text-nowrap" id="requestContactTable">
                <thead>
                    <tr>
                        <th style="width: 2%">No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>User Interested For</th>
                        <th style="width: 15%">Details</th>
                        <th style="width: 5%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<meta name="route-get-data-request" content="{{ route('get.data.request') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">


{{-- modal details --}}
<div class="modal modal-blur fade" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
	<h5 class="modal-title">Data List Request Contact</h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
	


    <div class="container">
        <article class="card">
            <header class="card-header"> Details Data List Request Contact </header>
            <div class="card-body">
                <h2>Name User Request: <span id="nm"></span></h2>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Email:</strong> <br> <p id="em"></p> </div>
                        <div class="col"> <strong>Phone:</strong> <br> <p id="phones"></p></div>
                        <div class="col"> <strong>Date Request:</strong> <br> <p id="crte"></p> </div>
                    </div>
                </article>
                <hr>

                 <article class="card">
                    <div class="card-body row">
                    <div class="col"> <strong>Subject</strong> <br> <textarea class="form-control" id="sub" cols="2" rows="2" readonly></textarea> </div>
                    </div>
                </article>


                <article class="card">
                    <div class="card-body row">
                    <div class="col"> <strong>Messages:</strong> <br> <textarea class="form-control" id="masage" cols="10" rows="5" readonly></textarea> </div>
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


@endsection
		
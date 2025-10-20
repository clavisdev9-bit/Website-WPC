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
            <a href="{{ route('Administrator.create.agent.network') }}" class="btn btn-outline-azure">
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
            <table class="table card-table table-vcenter text-nowrap" id="agentNetworkTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th>Name Agent Network</th>
                        <th>Code Agent Network</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Details </th>
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


<div class="modal modal-blur fade" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
	<h5 class="modal-title">Data Submenu</h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
	


    <div class="container">
        <article class="card">
            <header class="card-header"> Details Network </header>
            <div class="card-body">
                <h2>Name Network Agent: <span id="menu"></span></h2>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Code Network Agent:</strong> <br> <p id="menu"></p> </div>
                        <div class="col"> <strong>Country Network Agent:</strong> <br> <p id="title"></p> </div>
                        <div class="col"> <strong>City Network Agent:</strong> <br> <p id="pmn"></p></div>
                    </div>
                </article>
                <hr>


                <article class="card">
                    <div class="card-body row">
                    <div class="col"> <strong>Address Network Agent:</strong> <br> <textarea class="form-control" id="url" cols="3" rows="3" readonly></textarea> </div>
                    </div>
                </article>
                <hr>

                 <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Latitude :</strong> <br> <p id="icon"></p> </div>
                        <div class="col"> <strong>Longitude :</strong> <br> <p id="status"></p></div>
                    </div>
                </article>
                <hr>


                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Phone :</strong> <br> <p id="icon"></p> </div>
                        <div class="col"> <strong>Email :</strong> <br> <p id="status"></p></div>
                        <div class="col"> <strong>Status :</strong> <br> <p id="status"></p></div>
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

<meta name="route-agent-network-get" content="{{ route('Administrator.get.agent.network') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
		
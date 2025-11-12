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
            <a href="{{ route('sync.contact.process') }}" id="syncBtn" class="btn btn-outline-azure">
             <i class="fa fa-refresh">  </i> Synchronize contact
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
            <table class="table card-table table-vcenter text-nowrap" id="contactSyncTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th>Name Contacts</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Roles / Tags</th>
                        <th>Country</th>
                        <th>State</th>
                        <th style="width: 5%">Details</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>

  <hr>


    <div class="card mt-5">
        <div class="card-header">
            <h3 class="card-title"> {{ $titles }}</h3>
        </div> 
        <div class="table-responsive mb-4 p-3">
            <table class="table card-table table-vcenter text-nowrap" id="contactSyncLogTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th>Sync Time</th>
                        <th style="width: 8%">Total Records</th>
                        <th>Status</th>
                        <th>Messages</th>
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
            <header class="card-header"> Details Contacts </header>
            <div class="card-body">

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Name:</strong> <br> <p id="name"></p> </div>
                        <div class="col"> <strong>Email:</strong> <br> <p id="email"></p> </div>
                        <div class="col"> <strong>Phone:</strong> <br> <p id="phone"></p></div>
                    </div>
                </article>
                <hr>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Country:</strong> <br> <p id="countryName"></p> </div>
                        <div class="col"> <strong>State:</strong> <br> <p id="stateName"></p> </div>
                        <div class="col"> <strong>Street 1:</strong> <br> <p id="streetName"></p></div>
                    </div>
                </article>
                <hr>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Street 2:</strong> <br> <p id="streetTwoName"></p> </div>
                        <div class="col"> <strong>Zip:</strong> <br> <p id="zipName"></p> </div>
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




<meta name="route-contact-sync-get" content="{{ route('Admin.quotation.get.system.contact.sync') }}">
<meta name="route-contact-sync-get-log" content="{{ route('Admin.quotation.get.system.contact.sync.log') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">


@endsection
		
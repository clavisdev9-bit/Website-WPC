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
            <a href="{{ route('Administrator.create.agent.network.subcontinent') }}" class="btn btn-outline-azure">
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
            <table class="table card-table table-vcenter text-nowrap" id="subcontinentAgentNetworkTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th>Name Continent</th>
                        <th>Name Sub Continent</th>
                        <th>ISO Code Sub Continent</th>
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
<meta name="route-agent-network-subcontinent-get" content="{{ route('Administrator.get.agent.network.subcontinent') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
		
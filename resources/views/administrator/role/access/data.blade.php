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
            {{-- <a href="" class="btn btn-outline-azure">
             <i class="fa fa-plus"> Create </i>
            </a> --}}
        </div>
        </div>
    </div>
    </div>
</div>
@php
    use Illuminate\Support\Facades\Crypt;
@endphp

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
            <table class="table card-table table-vcenter text-nowrap" id="MenuRoleTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th>Name Menu</th>
                        <th style="width: 30%">Access Accept</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu as $mn)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mn->menu }}</td>
                                        <td>
                                            <div>
                                                <label class="form-check">
                                                  <input
                                                   class="form-check-input" type="checkbox" 
                                                   {{ cek_akses($roles->id_role, $mn->id_menu) }}
                                                   {{-- data-role="{{ $roles->id_role}}"
                                                   data-menu="{{ $mn->id_menu }}" --}}
                                                   data-role="{{ Crypt::encrypt($roles->id_role) }}"
                                                    data-menu="{{ Crypt::encrypt($mn->id_menu) }}"
                                                   />
                                                  <span class="form-check-label">If there is access checklist, if there is no access there is no checklist</span>
                                                </label>
                                      </td>
                                    </tr>
                                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="route-menu-change" content="{{ route('Administrator.change.access.menu') }}">
@endsection
		
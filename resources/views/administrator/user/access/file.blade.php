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
            <table class="table card-table table-vcenter text-nowrap" id="accessTable">
                <thead>
                    <tr>
                        <th style="width: 5px;">No</th>
                        <th>Name Menu</th>
                        <th>Name Submenu Dan Action(add/edit/del)</th>
                        <th>Noted</th>
                        <th style="width: 5%;">Status Submenu</th>
                        <th style="width: 5%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submenu as $sub)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @php
                                $map = [
                                    'Administrator'         => 'blue',
                                    'Admin_Cms_Website'     => 'yellow',
                                    'Admin_Quotation_system'=> 'red',
                                    'Costumers'             => 'cyan',
                                    'Setting_General'       => 'dark',
                                ];

                                $color = $map[$sub->menu_name] ?? 'secondary';
                            @endphp

                            <span class="badge bg-{{ $color }}-lt">
                                {{ $sub->menu_name }}
                            </span>
                        </td>
                        <td>{{ $sub->title }}</td>
                        <td>{{ $sub->noted }}</td>
                        <td>
                            {!! ($sub->is_active == 1 
                                ? '<span class="badge badge-pill badge-danger">Aktif</span>' 
                                : '<span class="badge badge-pill badge-secondary">NonAktif</span>'
                            ) !!}
                        </td>
                        <td>
                        <div class="custom-control custom-switch">
                       <input class="form-check-input" type="checkbox"
                       {{ cek_akses_submenu($userID->id_user, $sub->id_submenu) }}  
                        data-user="{{ $userID->id_user }}"
                        data-submenu="{{ $sub->id_submenu }}"/>
                       <label class="form-check-label" for="defaultCheck3"></label>
                      </div>  
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
<meta name="route-submenu-change" content="{{ route('Administrator.change.access.submenu') }}">
@endsection
		
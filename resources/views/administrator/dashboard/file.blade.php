@extends('layouts.app')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            Page
        </div>
        <h2 class="page-title">
            {{ $title }}
        </h2>
        </div>
    </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">

            <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader"> User Management</div>
                    <div class="ms-auto lh-1">
                    </div>
                </div>
                <div class="h1 mb-3">{{ $users }}</div>
                <div class="d-flex mb-2">
                    <div>  <a href="">More</a></div>
                </div>
                </div>
            </div>
            </div>



            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Role Management</div>
                        <div class="ms-auto lh-1">
                        </div>
                    </div>
                    <div class="h1 mb-3">{{ $role }}</div>
                    <div class="d-flex mb-2">
                        <div>  <a href="">More</a></div>
                    </div>
                    </div>
                </div>
                </div>


                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Menu Management</div>
                            <div class="ms-auto lh-1">
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ $menu }}</div>
                        <div class="d-flex mb-2">
                            <div>  <a href="">More</a></div>
                        </div>
                        </div>
                    </div>
                    </div>


                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Submenu Management</div>
                                <div class="ms-auto lh-1">
                                </div>
                            </div>
                            <div class="h1 mb-3">{{ $submenu }}</div>
                            <div class="d-flex mb-2">
                                <div>  <a href="">More</a></div>
                            </div>
                            </div>
                        </div>
                        </div>

        </div>
        </div>


@endsection
		
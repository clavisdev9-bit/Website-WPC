@extends('frontend.layouts.app')
@section('content')


  <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb-tracking">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Services Warehousing</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item text-light fw-bolder"><a href="">Home</a></li>
                    <li class="breadcrumb-item active text-primary">Warehousing</li>
                </ol>    
                 <small class="text-white fw-bolder">Warehousing For Your Logistic-shipping</small>
            </div>
        </div>
        <!-- Header End -->


        <div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="text-secondary fw-bold">Let us know which best describes you</h5>
                  <div class="d-flex flex-wrap gap-2"> 
                    <a href="{{ route('users.logistic') }}" class="btn btn-primary d-flex align-items-center gap-2 py-2 px-4 rounded-pill user-type-link {{ request()->routeIs('logistic.page') ? 'active' : '' }}">
                        <i class="fas fa fa-box"></i>
                        <span>I am a Logistic</span>
                    </a>
                    <a href="{{ route('users.transportation') }}" class="btn btn-primary d-flex align-items-center gap-2 py-2 px-4 rounded-pill user-type-link  {{ request()->routeIs('transportation.page') ? 'active' : '' }}">
                        <i class="fas fa fa-truck"></i>
                        <span>I am a Transportation</span>
                    </a>
                    <a href="{{ route('users.warehouse') }}" class="btn btn-primary d-flex align-items-center gap-2 py-2 px-4 rounded-pill user-type-link active {{ request()->routeIs('warehouse.page') ? 'active' : '' }}">
                        <i class="fas fa fa-warehouse"></i>
                        <span>I am a Warehouse</span>
                    </a>
                </div>
        </div>
    </div>

    <div class="card p-3 shadow-lg border-0 mb-5">
        <div class="card-body">
            <h4 class="card-title text-center text-dark fw-bold mb-4">WPC Logistic is a one-stop service center for global freight forwarding and logistics needs.</h4>
            
                <ul class="nav nav-tabs justify-content-center border-0 mb-4" id="serviceTab">
                    <li class="nav-item">
                        <a href="{{ route('users.logistic') }}" class="my-nav-link nav-link rounded-0 logistic-tab {{ request()->routeIs('users.logistic') ? 'active' : '' }}">
                            <small class="text-dark text-bold">Logistic</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.transportation') }}" class="my-nav-link nav-link rounded-0 transportation-tab {{ request()->routeIs('users.transportation') ? 'active' : '' }}">
                            <small class="text-dark text-bold">Transportation</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.warehouse') }}" class="my-nav-link nav-link rounded-0 warehouse-tab {{ request()->routeIs('users.warehouse') ? 'active' : '' }}">
                            <small class="text-dark text-bold">Warehousing</small>
                        </a>
                    </li>
                </ul>

            <div class="tab-content" id="serviceTabContent">
                <div class="tab-pane fade show active" id="import" role="tabpanel" aria-labelledby="logistic-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-0  p-3" style="background-color: #0744a0; color: #fff;">
                                <h5 class="fw-bold mb-3 text-white">OUR WAREHOUSING SERVICES</h5>
                                <div class="list-group list-group-flush">
                                    <a href="{{ route('users.dedicated.warehouse') }}" class="list-group-item list-group-item-action active bg-white text-dark fw-bold border-0 border-start border-4 border-warning">Dedicated Warehouse</a>
                                    <a href="{{ route('users.public.warehouse') }}" class="list-group-item list-group-item-action border-0">Public Warehouse</a>
                                    <a href="{{ route('users.warehouse.management.system') }}" class="list-group-item list-group-item-action border-0">Warehouse Management System</a>
                                </div>
                                <div class="placeholder-glow mt-4">
                                    <span class="placeholder col-8"></span>
                                    <span class="placeholder col-6"></span>
                                    <span class="placeholder col-10"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <h2 class="fw-bold mb-3">Warehousing</h2>
                            <hr class="border-warning border-3 mb-4 mt-2" style="width: 100px;">
                            <p class="text-secondary">Warehousing Services</p>
                            <p class="text-dark fw-bold">Economic development in every countries is directly proportional to the land prices. In other words, economic development causing land more scarce, therefore the prices is soaring high. In addition, there are fewer vast land to build warehouse. For companies and retailer, that become an obstacle to overcome.
                                                         Building new warehouses are not the best solution. Not only it needs large sum of capital, but also it was not easy to find the right location for warehouse based on target market distribution area.
                                                        WPC Logistics understand such problem. Consequently, WPC Logistics provides public warehouse and dedicated warehouse facility that can be used by the customers. Hence, customers could implement on time and stockless production strategy. </p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-solid fa-caret-right text-primary me-2"></i> <a href="{{ route('users.dedicated.warehouse') }}">Dedicated Warehouse</a></li>
                                <li class="mb-2"><i class="fas fa-solid fa-caret-right text-primary me-2"></i> <a href="{{ route('users.public.warehouse') }}">Public Warehouse</a></li>
                                <li class="mb-2"><i class="fas fa-solid fa-caret-right text-primary me-2"></i> <a href="{{ route('users.warehouse.management.system') }}">Warehouse Management System</a></li>
                            </ul>
                            <a href="{{ route('users.qoute') }}" class="btn btn-warning py-2 px-4 rounded-pill mt-3" style="background-color: #C7153D; color: #fff;">GET A QUOTE</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    </div>
</div>

        @endsection
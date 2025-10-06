 <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid header-top">
            <div class="nav-shaps-2"></div>
            <div class="container d-flex align-items-center">
                <div class="d-flex align-items-center h-100">
                    <a href="#" class="navbar-brand" style="height: 125px;">
                        {{-- <h1 class="text-white mb-0">WPC Logistic</h1> --}}
                       {{-- <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="Logo">  --}}
                       <img src="/images/logo.png" 
                        alt="Logo" 
                        class="img-fluid d-inline-block align-text-top mb-2" 
                        style="max-height:80px; width:auto;"> 
                       
                    </a>
                  

                </div>
                <div class="w-100 h-100">
                    <div class="topbar px-0 py-2 d-none d-lg-block" style="height: 45px;">
                        <div class="row gx-0 align-items-center">
                            <div class="col-lg-8 text-center text-lg-center mb-lg-0">
                                <div class="d-flex flex-wrap">
                                    <div class="pe-4">
                                        <a href="mailto:inquiry@wpclogistics.com" class="text-muted small"><i class="fas fa-envelope text-white me-2"></i>inquiry@wpclogistics.com</a>
                                    </div>
                                    <div class="pe-0">
                                        <a href="mailto:example@gmail.com" class="text-muted small"><i class="fa fa-clock text-white me-2"></i>Mon - Sat: 9.00 am - 8.00 pm</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center text-lg-end">
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex align-items-center small">
                                        <a href="{{ route('Auth.login') }}" class="login-btn text-body me-3 pe-3"> <span>Login</span></a>
                                        <a href="{{ route('Auth.register') }}" class="text-body me-3"> Register</a>
                                    </div>
                                    <div class="d-flex pe-3">
                                        <a class="btn p-0 text-white me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn p-0 text-white me-3" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn p-0 text-white me-3" href="#"><i class="fab fa-instagram"></i></a>
                                        <a class="btn p-0 text-white me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-bar px-0 py-lg-0" style="height: 80px;">
                        <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-lg-end">
                            <a href="#" class="navbar-brand-2">
                                 {{-- <h1 class="text-white mb-0">WPC Logistic</h1> --}}
                               <img src="/images/logo.png" 
                        alt="Logo" 
                        class="img-fluid d-inline-block align-text-top mb-2" 
                        style="max-height:63px; width:auto;">
                            </a> 
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                                <span class="fa fa-bars"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">


                                <div class="navbar-nav mx-0 mx-lg-auto">
                                   
                                    <a href="{{ route('users.home') }}" 
       class="nav-item nav-link {{ request()->routeIs('users.home') ? 'active' : '' }}">
       Home
    </a>

    <a href="{{ route('users.about') }}" 
       class="nav-item nav-link {{ request()->routeIs('users.about') ? 'active' : '' }}">
       About
    </a>

    <div class="nav-item dropdown">
        <a href="#" class="nav-link {{ request()->is('services/*') ? 'active' : '' }}" data-bs-toggle="dropdown">
            <span class="dropdown-toggle">Services</span>
        </a>
        <div class="dropdown-menu">
            <a href="{{ route('users.logistic') }}" 
               class="dropdown-item {{ request()->routeIs('users.logistic') ? 'active' : '' }}">
               Logistic
            </a>
            <a href="{{ route('users.transportation') }}" 
               class="dropdown-item {{ request()->routeIs('users.transportation') ? 'active' : '' }}">
               Transportation
            </a>
            <a href="{{ route('users.warehouse') }}" 
               class="dropdown-item {{ request()->routeIs('users.warehouse') ? 'active' : '' }}">
               Warehouse
            </a>
        </div>
    </div>

    <a href="/wpc-esys/form-qoutation" 
       class="nav-item nav-link {{ request()->is('wpc-esys/form-qoutation') ? 'active' : '' }}">
       Get Quote
    </a>

    <a href="{{ route('users.news') }}" 
       class="nav-item nav-link {{ request()->routeIs('users.news') ? 'active' : '' }}">
       News
    </a>

    <a href="/wpc-esys/network" 
       class="nav-item nav-link {{ request()->is('wpc-esys/network') ? 'active' : '' }}">
       Network
    </a>

    <a href="{{ route('users.contact') }}" 
       class="nav-item nav-link {{ request()->routeIs('users.contact') ? 'active' : '' }}">
       Contact
    </a>


                                    <div class="nav-btn ps-3">
                                        {{-- <button class="btn-search btn btn-light btn-md-square mt-2 mt-lg-0 mb-4 mb-lg-0 flex-shrink-0" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button> --}}
                                        {{-- <a href="{{ route('users.qoute') }}" class="btn btn-light py-2 px-4 ms-0 ms-lg-3"> <span>Karier</span></a> --}}
                                    <a href="/wpc-esys/form-qoutation" class="btn btn-white py-2 px-4 ms-0 ms-lg-3">
                                    <span>Get Quote</span>
                                    </a>
                                        <a href="" class="btn btn-white py-2 px-4 ms-0 ms-lg-3">
                                         <span>Karir</span>
                                    </a>
                                    
                                    </div>
                                    <div class="nav-shaps-1"></div>
                                </div>

                                
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center bg-primary">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="btn bg-light border nput-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


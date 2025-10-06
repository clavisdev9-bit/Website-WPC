  <div class="page">
      <!-- BEGIN NAVBAR  -->
      <header class="navbar navbar-expand-md d-print-none" style="background: #0077B5;">
        <div class="container-xl">
          <!-- BEGIN NAVBAR TOGGLER -->
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar-menu"
            aria-controls="navbar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- END NAVBAR TOGGLER -->
          <!-- BEGIN NAVBAR LOGO -->
          <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="." aria-label="Tabler">
              <img src="{{ asset('logo1.png') }}"  class="navbar-brand-image" viewBox="0 0 232 68" alt="">
            </a>
            <div class="navbar-brand d-flex flex-column align-items-start">
            <span class="fw-bold text-capitalize text-light">WPC Logistic</span>
            <small class="text-light">Experience That Delivers</small>
          </div>
          </div>
          <!-- END NAVBAR LOGO -->
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">
                <a href="" class="btn btn-primary btn-5" target="_blank" rel="noreferrer">
                   <i class="nav-icon fa fa-headset"> Support</i>
                 
                </a>

                <a href="" class="btn btn-primary btn-6" target="_blank" rel="noreferrer">
                 
                  <i class="nav-icon fas fa-book"> User Guide</i>
                  
                </a>

                <div class="dropdown">
                <a class="btn btn-primary btn-6 dropdown-toggle" href="#" role="button" 
                  id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="nav-icon fas fa-language"> Languange</i>
                    
                </a>

                <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                  <li><a class="dropdown-item" href="?lang=id">🇮🇩 Indonesia</a></li>
                  <li><a class="dropdown-item" href="?lang=en">🇬🇧 English</a></li>
                  <li><a class="dropdown-item" href="?lang=fr">🇫🇷 Français</a></li>
                  <li><a class="dropdown-item" href="?lang=zh">🇨🇳 中文</a></li>
                </ul>
              </div>

              </div>
            </div>
           


            <div class="nav-item dropdown">

              


              <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="Open user menu">
                  <img  :src="" 
                  class="avatar avatar-sm rounded-circle"  style="background-image" alt="">
                      <div class="d-none d-xl-block ps-2">
                        <div class="text-light">Name Users</div>
                    <div class="mt-1 small text-light">xxxxx</div>
                      </div>
              </a>


              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="" class="dropdown-item">Profile</a>
                <div class="dropdown-divider"></div>
                 <a href="#" @click.prevent="logout" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header>


      <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
            <div class="container-xl">
              <div class="row flex-column flex-md-row flex-fill align-items-center">
                <div class="col">
                  <!-- BEGIN NAVBAR MENU -->
                <ul class="navbar-nav">

                   <li class="nav-item">
                    <a href="{{ route('users.qoute.home') }}" class="nav-link">
                        <span class="nav-link-icon d-md-none d-lg-inline-block text-secondary">
                            <i class="nav-icon fa fa-home fa-lg"></i>
                        </span>
                        <span class="nav-link-title text-secondary">Home</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.qoute.new') }}" class="nav-link">
                        <span class="nav-link-icon d-md-none d-lg-inline-block text-secondary">
                            <i class="nav-icon fa fa-file-invoice fa-lg"></i>
                        </span>
                        <span class="nav-link-title text-secondary">Qoutation</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <span class="nav-link-icon d-md-none d-lg-inline-block text-secondary">
                            <i class="nav-icon fas fa-clipboard fa-lg"></i>
                        </span>
                        <span class="nav-link-title text-secondary">Schedule</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <span class="nav-link-icon d-md-none d-lg-inline-block text-secondary">
                            <i class="nav-icon fa fa-tag fa-lg"></i>
                        </span>
                        <span class="nav-link-title text-secondary">Prices</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <span class="nav-link-icon d-md-none d-lg-inline-block text-secondary">
                            <i class="nav-icon fas fa-receipt fa-lg"></i> 
                        </span>
                        <span class="nav-link-title text-secondary">Booking</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="" class="nav-link">
                        <span class="nav-link-icon d-md-none d-lg-inline-block text-secondary">
                            <i class="nav-icon fas fa-book fa-lg"></i> 
                        </span>
                        <span class="nav-link-title text-secondary">Documentation</span>
                    </a>
                </li>

                 <li class="nav-item">
                    <a href="{{ route('users.home') }}" class="nav-link">
                        <span class="nav-link-icon d-md-none d-lg-inline-block text-secondary">
                            <i class="nav-icon fas fa-arrow-right fa-lg"></i> 
                        </span>
                        <span class="nav-link-title text-secondary">Back To Landing Page</span>
                    </a>
                </li>

              </ul>
                  <!-- END NAVBAR MENU -->
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </header>
      </div>
      <!-- END NAVBAR  -->
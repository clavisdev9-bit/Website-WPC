
        <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
       <div class="navbar-brand d-flex align-items-center">
   <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-brand-image me-2" />
    <span class="fw-bold text-capitalize mt-2">  WPC Logistic</span>
</div>
        <hr class="my-2 border-light">

         @php
            $user = getUserData();
                        $defaultImg = 'default.jpg';
                        $imageUrl = $user->image ? route('avatar.show', ['filename' => $user->image]) : asset('storage/profile/' . $defaultImg);
                        $version = $user->image ? time() : time(); // Anda bisa menyesuaikan versioning untuk route
            @endphp
        <div class="navbar-nav flex-row d-lg-none">
            
            <div class="d-none d-lg-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
                   data-bs-placement="bottom">
            <!-- Download SVG icon from http://tabler.io/icons/icon/moon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
                   data-bs-placement="bottom">
            <!-- Download SVG icon from http://tabler.io/icons/icon/sun -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                </a>
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
            <!-- Download SVG icon from http://tabler.io/icons/icon/bell -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                        <span class="badge bg-red"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                </div>
                    </div>
                </div>
            </div>

    @php
    $user = getUserData();
                  $defaultImg = 'default.jpg';
                  $imageUrl = $user->image ? route('avatar.show', ['filename' => $user->image]) : asset('storage/profile/' . $defaultImg);
                  $version = $user->image ? time() : time(); // Anda bisa menyesuaikan versioning untuk route
    @endphp

@if ($user)

    <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <img src="{{ $imageUrl }}?v={{ $version }}" 
            class="avatar avatar-sm rounded-circle"
            alt="{{ $row->fullname ?? 'User' }} profile"
            loading="lazy"
            onerror="this.src='{{ asset('storage/profile/'.$defaultImg) }}'">
            <div class="d-none d-xl-block ps-2">
                <div>{{ $user->fullname }}</div>
                <div class="mt-1 small text-secondary">{{$user->email }}</div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="" class="dropdown-item">Profile</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('Setting_General.logout') }}" class="dropdown-item">Logout</a>
        </div>
    </div>
</div>
    @else
    {{-- {{ set null also}} --}} 
    @endif
        

    <?php
        use Illuminate\Support\Facades\DB;
        
        // Ambil role_id dan user_id dari session
        $role_id = session()->get('role_id');
        $user_id = session()->get('id_user');

         if (!$role_id || !$user_id) {
                abort(403, 'Akses Ditolak: Role atau User ID tidak ditemukan.');
                // return redirect('/');
            }
        $menus = DB::table('menus AS m')
                ->join('access_menus AS a', 'm.id_menu', '=', 'a.id_menu')
                ->where('a.id_role', $role_id)
                ->select('m.id_menu', 'm.menu')
                ->orderBy('m.id_menu', 'asc')
                ->get();

                $menu_ids = $menus->pluck('id_menu');

               
                $submenus = DB::table('submenus AS s')
                    ->Join('access_submenus AS ua', 's.id_submenu', '=', 'ua.id_submenu')
                    ->whereIn('s.id_menu', $menu_ids)
                    ->where('ua.id_user', $user_id)
                    ->where('s.is_active', 1)
                    // ->whereNull('s.parent_id') // Hanya ambil yang parent_id NULL (submenu utama)
                    ->where(function($query) {
                            $query->whereNull('s.parent_id')
                                ->orWhere('s.parent_id', 0);
                        })
                    ->select('s.id_submenu', 's.id_menu', 's.title', 's.url', 's.icon', 's.parent_id')
                    ->orderBy('s.id_submenu', 'asc') 
                    ->get();

                     $childSubmenus = DB::table('submenus AS s')
                        ->join('access_submenus AS ua', 's.id_submenu', '=', 'ua.id_submenu')
                        ->whereIn('s.id_menu', $menu_ids)
                        ->where('ua.id_user', $user_id)
                        ->where('s.is_active', 1)
                        ->whereNotNull('s.parent_id')
                        ->select('s.id_submenu', 's.id_menu', 's.title', 's.url', 's.icon', 's.parent_id')
                        ->orderBy('s.title', 'asc')
                        ->get();
                        $groupedChildren = $childSubmenus->groupBy('parent_id');
        ?>


        <div class="collapse navbar-collapse" id="sidebar-menu">
          
            <ul class="navbar-nav">
                 @foreach ($menus as $menu)
               <li>
  <span class="d-block px-3 nav-link-icon d-md-none d-lg-inline-block text-uppercase fw-bold text-info small border-bottom border-light pb-1 mb-1 mt-1">
      {{ $menu->menu }}
  </span>
</li>

    @foreach ($submenus as $sm)
        @if ($sm->id_menu == $menu->id_menu)

        @php
            $hasChildren = isset($groupedChildren[$sm->id_submenu]);
            $isActive = Request::is(ltrim($sm->url, '/') . '*') || ($hasChildren && collect($groupedChildren[$sm->id_submenu])->contains(function ($child) {
                return Request::is(ltrim($child->url, '/') . '*');
            }));
           @endphp


            @php
                $hasChildren = isset($groupedChildren[$sm->id_submenu]);
                $isActiveParent = false;
                if ($hasChildren) {
                    foreach ($groupedChildren[$sm->id_submenu] as $child) {
                        if (Request::is(trim($child->url, '/'))) {
                            $isActiveParent = true;
                            break;
                        }
                    }
                }
            @endphp

            @if (!$hasChildren)
                <!-- Submenu biasa -->
                <li class="nav-item mb-1">
                        <a class="nav-link {{ Request::is(ltrim($sm->url, '/') . '*') ? 'active' : '' }}" href="{{ url($sm->url) }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="{{ $sm->icon }}"></i>
                        </span>
                        <span class="nav-link-title">
                            {{ $sm->title }}
                        </span>
                    </a>
                </li>
            @else
                
                <li class="nav-item dropdown {{ $isActiveParent ? 'show' : '' }}">
                    <a class="nav-link dropdown-toggle {{ $isActiveParent ? 'show' : '' }}" href="#" id="submenu-{{ $sm->id_submenu }}" role="button" data-bs-toggle="dropdown" aria-expanded="{{ $isActiveParent ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="{{ $sm->icon }}"></i>
                        </span>
                        <span class="nav-link-title">
                            {{ $sm->title }}
                        </span>
                    </a>
                    <ul class="dropdown-menu {{ $isActiveParent ? 'show' : '' }}" aria-labelledby="submenu-{{ $sm->id_submenu }}">
                        @foreach ($groupedChildren[$sm->id_submenu] as $child)
                            <li>
                                <a class="dropdown-item {{ Request::is(trim($child->url, '/')) ? 'active' : '' }}" href="{{ url($child->url) }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="{{ $child->icon }}"></i>
                                        <span class="nav-link-title">{{ $child->title }}</span>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                
            @endif
        @endif
    @endforeach
  @endforeach
    
            </ul>
        </div>
        
            </div>
        </aside>
              
            <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none" >
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
                   data-bs-placement="bottom">
            <!-- Download SVG icon from http://tabler.io/icons/icon/moon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
                   data-bs-placement="bottom">
            <!-- Download SVG icon from http://tabler.io/icons/icon/sun -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                </a>
                <div class="nav-item dropdown d-none d-md-flex me-3">

            <!-- Download SVG icon from http://tabler.io/icons/icon/bell -->
           
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
           
           
            </div>
                    </div>
                </div>
            </div>
              @if ($user)
    <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <img src="{{ $imageUrl }}?v={{ $version }}" 
            class="avatar avatar-sm rounded-circle"
            alt="{{ $row->fullname ?? 'User' }} profile"
            loading="lazy"
            onerror="this.src='{{ asset('storage/profile/'.$defaultImg) }}'">
       {{-- <span class="avatar avatar-sm" style="background-image: ></span> --}}
            <div class="d-none d-xl-block ps-2">
                <div>{{ $user->fullname }}</div>
                <div class="mt-1 small text-secondary">{{$user->email }}</div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="" class="dropdown-item">Profile</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('Setting_General.logout') }}" class="dropdown-item">Logout</a>
        </div>
    </div>
</div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                  {{-- <small>this is if your add new title</small> --}}
                    </div>
            </div>
        </div>
    </header>
    @else
   {{-- {{ biarin kososng aja}} --}}
@endif
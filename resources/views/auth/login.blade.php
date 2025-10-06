@include('auth.partials.header')
<body class=" d-flex flex-column">
<script src="{{ asset('assets/backend/dist/js/demo-theme.min.js?1738096682') }}"></script>


	<div class="mt-5">
	 <div class="page page-center">
      <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
          <div class="col-lg">
            <div class="container-tight">
              <div class="text-center mb-4">
               

				 <a href="." class="navbar-brand">
                <img src="/images/logo.png" alt="Logo Perusahaan" width="310" height="32" viewBox="0 0 232 68" class=" navbar-brand-image">
               </a>
               <br>
               <a href="." class="navbar-brand">
                <h3 class="h3 text-center mb-0">WPC Logistic</h3> 
               </a>
              </div>
              <div class="card card-md">
                <div class="card-body">
                  <h2 class="h2 text-center mb-4">Login to your account</h2>



                 

		<form id="loginForm" action="{{ route('Auth.checks.authentication') }}" method="post" autocomplete="off" novalidate>
            @csrf

            <div class="select-role">
                @if ($errors->any())
                <div class="alert alert-warning" role="alert">
                    <div class="d-flex">
                    <div>
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2"><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>
                    </div>
                    <div>
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </div>
                </div>
                 </div>
                @endif
                
                @if(session('message'))
                <div class="alert alert-warning" role="alert">
                    <div class="d-flex">
                    <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2"><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>
                    </div>
                    <div>
                        {{ session('message') }}
                    </div>
                    </div>
               </div>
                @endif
                    </div> 

	<div class="mb-3">
		<label class="form-label">Email address</label>
		<input type="text" class="form-control" name="email" placeholder="email" autocomplete="off">
        
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror
	</div>


	<div class="mb-2">
		<label class="form-label">
			Password
		</label>
		<div class="input-group input-group-flat">
	<input type="password" class="form-control" name="password"  placeholder="Your password"  autocomplete="off">
	<span class="input-group-text">
        <a class="link-secondary" data-bs-toggle="tooltip">
		<i class="fa fa-lock" aria-hidden="true"></i>
	</span>
    </div>
    @error('password')
    <div class="text-danger">{{ $message }}</div>
    @enderror
        </div>
       

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </div>
    </form>


                </div>
               
               
              </div>
              <div class="text-center text-secondary mt-3">Don't have account yet? <a href="{{ route('Auth.register') }}" tabindex="-1">Sign up</a></div>
            </div>
          </div>
          </div>
          </div>
          </div>
        </div>
</div>
@include('auth.partials.footer')


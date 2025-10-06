@extends('layouts.app')
@section('content')

<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          {{ $title }}
        </h2>
        <p class="text-muted">
            {{ $title }}
        </p>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Submenu</h3>
          </div>
            <div class="card-body">
                <form method="POST" action="{{ route('Administrator.store.submenu.management') }}">
                    @csrf

                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Menu <small class="text-danger">*</small></label>
                                <select class="form-select" name="menu" id="menu" class="form-control" style="width: 100%; height: 38px">
                                    <option value="" selected>Select</option>
                                    @foreach ($menu as $mn)
                                    <option value="{{ $mn->id_menu }}" 
                                    {{ old('menu') == $mn->id_menu ? 'selected' : '' }}>
                                        {{ $mn->menu }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('menu')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Parent <small class="text-danger">(opsional)</small></label>
                                <select class="form-select" name="parent" id="parent" class="form-control" style="width: 100%; height: 38px">
                                <option value="" selected>Select</option>
                                    @foreach ($submenu as $smn)
                                    <option value="{{ $smn->id_submenu }}" 
                                    {{ old('parent') == $smn->id_submenu ? 'selected' : '' }}>
                                        {{ $smn->title }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('parent')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <!-- Company -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Title <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="title">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">URL <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="url" value="{{ old('url') }}" placeholder="ex: Admin/example-name">
                                @error('url')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Icon <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="icon" value="{{ old('icon') }}" placeholder="using icon from fontawesome (fas fa fa-icon)">
                                @error('icon')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" >Status <small class="text-danger">*</small></label>
                            <select class="form-select" name="status" id="status">
                                <option selected value="">Select</option>
                                <option value="1">Aktif</option>
                                <option value="0">NonAktif</option>
                            </select>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        </div>
                    </div>

                    

                    <!-- About Me -->
                    <div class="mb-3">
                        <label class="form-label">Noted <small class="text-danger">(opsional)</small></label>
                        <textarea class="form-control" name="noted" rows="4" placeholder="Noted"></textarea>
                        @error('noted')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>

</form>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    // assetCode
    $(document).ready(function() {
        $("#menu").select2({
          placeholder: "SELECT A MENU",
           allowClear: true,
           theme: 'bootstrap4',
        });

        $("#status").select2({
          placeholder: "SELECT A STATUS",
           allowClear: true,
           theme: 'bootstrap4',
        });

        $("#parent").select2({
          placeholder: "SELECT A PARENT",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });
</script>

@endsection
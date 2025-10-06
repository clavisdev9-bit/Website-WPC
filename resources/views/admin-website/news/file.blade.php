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
            <a href="{{ route('form.add.blogs') }}" class="btn btn-outline-azure">
             <i class="fa fa-plus"> </i>Create
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
            <table class="table card-table table-vcenter text-nowrap" id="BlogsTable">
                <thead>
                    <tr>
                        <th style="width: 2%">No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th style="width: 15%">Details</th>
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
<meta name="route-get-blogs" content="{{ route('get.blogs') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">



{{-- modal details --}}
<div class="modal modal-blur fade" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
	<h5 class="modal-title">Data Blogs - News</h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
	


    <div class="container">
        <article class="card">
            <header class="card-header"> Details Data Blogs - News </header>
            <div class="card-body">
                <h2>Title Blog: <span id="title"></span></h2>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Slug Blog:</strong> <br> <p id="slug"></p> </div>
                        <div class="col"> <strong>Category Blog:</strong> <br> <p id="name_category"></p></div>
                        <div class="col"> <strong>Date Created Blog:</strong> <br> <p id="created_at"></p> </div>
                    </div>
                </article>
                <hr>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Author:</strong> <br> <p id="name_author"></p> </div>
                        <div class="col"> <strong>meta title:</strong> <br> <p id="meta_title"></p></div>
                    </div>
                </article>
                <hr>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>meta description:</strong> <br> <p id="meta_description"></p> </div>
                        <div class="col"> <strong>status Publish:</strong> <br> <p id="is_published"></p></div>
                    </div>
                </article>
                <hr>

                 <article class="card">
                    <div class="card-body row">
                    <div class="col"> <strong>Excerpt:</strong> <br> <textarea class="form-control" id="excerpt" cols="5" rows="2" readonly></textarea> </div>
                    </div>
                </article><hr>

                <article class="card">
                    <div class="card-body row">
                    <div class="col"> <strong>Content:</strong> <br> <textarea class="form-control" id="content" cols="10" rows="5" readonly></textarea> </div>
                    </div>
                </article>
                <hr>
    

            </div>
        </article>
    </div>
        
          </div>
          
<div class="modal-footer">
	<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
</div>
		</div>
	</div>
</div>

@endsection
		
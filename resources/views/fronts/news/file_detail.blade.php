@extends('frontend.layouts.app')
@section('content')

 <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb-tracking">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ $title }}</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">{{ $title }}</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

<!-- Blog Detail Start -->
<div class="container py-5">
  <div class="row g-5">
    
    <!-- Blog Content -->
    <div class="col-lg-8">
      <!-- Blog Image -->
      <div class="mb-4">
        <img class="img-fluid rounded w-100" src="{{ route('blogs.image.show', ['filename' => $blog->image]) }}" alt="Blog Title">
      </div>

      <!-- Blog Meta -->
      <div class="mb-3 d-flex justify-content-between small text-muted">
        <span><i class="fa fa-user text-primary me-2"></i> {{ $blog->name_author }}</span>
        <span><i class="fa fa-calendar text-primary me-2"></i> {{ $blog->created_at->format('d M Y') }}</span>
        <span><i class="fa fa-folder text-primary me-2"></i> {{ $blog->name_category }}</span>
      </div>

      <!-- Blog Title -->
      <h2 class="fw-bold mb-4">{{ $blog->title }}</h2>

      <!-- Blog Content -->
      <div class="mb-4">
        <p>
          {!! $blog->content !!}
        </p>
      </div>

      <!-- Blockquote -->
      <blockquote class="p-3 border-start border-3 border-primary bg-light fst-italic mb-4">
        “Great companies are built on great logistics.” – Fred Smith (Founder FedEx) <br>
        “Perusahaan besar dibangun di atas logistik yang hebat.” – Fred Smith (Pendiri FedEx)
      </blockquote>

   

      <!-- Share / Like -->
      <div class="d-flex justify-content-between align-items-center mt-4">
        <span><i class="fa fa-heart text-danger me-2"></i> Liked by 4 people</span>
        <div class="d-flex">
          <a class="btn btn-outline-primary btn-sm me-2" href="#"><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-outline-primary btn-sm me-2" href="#"><i class="fab fa-twitter"></i></a>
          <a class="btn btn-outline-primary btn-sm" href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>

      <!-- Prev/Next -->
      <div class="d-flex justify-content-between border-top pt-4 mt-4">
      @if($prev)
          <a href="{{ route('users.news.show', $prev->slug) }}" class="text-decoration-none">
            <i class="fa fa-arrow-left me-2"></i> {{ $prev->title }}
          </a>
        @else
          <span></span>
        @endif

        @if($next)
          <a href="{{ route('users.news.show', $next->slug) }}" class="text-decoration-none">
            {{ $next->title }} <i class="fa fa-arrow-right ms-2"></i>
          </a>
        @endif
    </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <!-- Search -->
      <div class="mb-5">
        <form action="#" method="GET">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search keyword">
            <button class="btn btn-primary" type="submit">Search</button>
          </div>
        </form>
      </div>

      

      <div class="mb-5">
    <h4 class="fw-bold mb-3">Category</h4>
    <ul class="list-unstyled">
        @foreach($categories as $category)
            <li class="mb-2">
                <a href="{{ url('news/category/'.$category->id) }}" class="text-dark">
                    <i class="fa fa-angle-right text-primary me-2"></i> 
                    {{ $category->name }} ({{ $category->blogs_count }})
                </a>
            </li>
        @endforeach
    </ul>
</div>


      <!-- Recent Post -->
<div class="mb-5">
    <h4 class="fw-bold mb-3">Recent Post</h4>
    @foreach($recentPosts as $post)
        <div class="d-flex mb-3">
            <img src="{{ route('blogs.image.show', ['filename' => $post->image]) }}" 
                 class="flex-shrink-0 img-fluid rounded" 
                 style="width: 80px; height: 60px; object-fit: cover;" 
                 alt="{{ $post->title }}">
            <div class="ms-3">
                <a href="{{ route('users.news.show', $post->slug) }}" class="h6 d-block mb-1">
                    {{ \Illuminate\Support\Str::limit($post->title, 25) }}
                </a>
                <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
            </div>
        </div>
    @endforeach
</div>


      <!-- Tag Clouds -->
      <div class="mb-5">
        <h4 class="fw-bold mb-3">Tag Clouds</h4>
        <div class="d-flex flex-wrap gap-2">
          <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill">Project</a>
          <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill">Company</a>
          <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill">Technology</a>
          <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill">Brands</a>
          <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill">Design</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Blog Detail End -->
@endsection



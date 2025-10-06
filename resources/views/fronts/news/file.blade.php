@extends('frontend.layouts.app')
@section('content')

 <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb-news">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our News</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">News</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->





<!-- Blog Start -->
<div class="container-fluid blog py-5" style="background-color: #f8fbff;">
  <div class="container py-5">
    <!-- Section Title -->
    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
      <h4 class="text-primary fw-bold">Our News</h4>
      <h1 class="display-5 fw-bold mb-4">Check Out Our Latest Stories</h1>
      <p class="mb-0 text-muted">
        Get the latest information about logistics, warehousing, and international shipping to support your business.
      </p>
    </div>

    <!-- Blog Grid -->
    <div class="row g-4">
       @foreach($blogs as $blog)
      <!-- Blog Item -->
      <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 blog-card">
          <a href="{{ route('users.news.show', $blog->slug) }}">
            <img 
              src="{{ route('blogs.image.show', ['filename' => $blog->image]) }}" 
              class="card-img-top" 
              alt="{{ $blog->title }}">
          </a>
          <div class="card-body p-4">
            <div class="d-flex justify-content-between mb-3 small text-muted">
            <span><i class="fa fa-user text-primary me-2"></i> {{ $blog->name_author ?? 'Admin' }}</span>
            <span><i class="fa fa-calendar text-primary me-2"></i> {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}</span>
          </div>
            <a href="{{ route('users.news.show', $blog->slug) }}" class="h5 fw-bold d-inline-block mb-3 text-dark">{{ Str::limit($blog->excerpt, 100) }}</a>
            <p class="text-muted"> {{ $blog->title }}</p>
            <a href="{{ route('users.news.show', $blog->slug) }}" class="btn btn-primary btn-sm px-3 rounded-pill">
              Read More <i class="fa fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>
      @endforeach

    </div>

    <!-- Pagination -->
<nav aria-label="Blog Pagination" class="mt-5 wow fadeInUp" data-wow-delay="0.7s">
  {{-- <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">...</a></li>
    <li class="page-item"><a class="page-link" href="#">8</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul> --}}{{ $blogs->links('pagination::bootstrap-5') }}
</nav>

  </div>
</div>
<!-- Blog End -->




<!-- Extra CSS -->
<style>
  .blog-card {
    transition: all 0.4s ease;
  }
  .blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
  }
</style>




@endsection
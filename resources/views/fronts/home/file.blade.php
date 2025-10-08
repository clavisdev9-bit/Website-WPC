@extends('frontend.layouts.app')
@section('content')

 <!-- Carousel Start -->
        <div class="header-carousel owl-carousel overflow-hidden bg-dark">
            <div class="header-carousel-item hero-section">
                <div class="hero-bg-half-1"></div>
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                 

                                    <div class="hero-text text-sm-center text-md-start">
                                        <h4 class="text-white text-uppercase fw-bold mb-4 animate__animated animate__fadeInDown">
                                            Welcome to
                                        </h4>
                                        <h1 class="display-1 text-white mb-4 animate__animated animate__fadeInUp">
                                            WPC Logistic
                                        </h1>
                                      <p class="lead text-light animate__animated animate__fadeIn">
                                            Driven by Reliability <span class="fw-bold text-light">Fast. Safe. On Time.</span>
                                          </p>
                                          <a href="/wpc-esys/qoutation-request" class="btn btn-gradient px-4 py-2 mt-2">
                                            Get Quote
                                          </a>
                                          {{-- <a href="" class="btn btn-gradient px-4 py-2 mt-2">
                                          Tracking Login
                                          </a> --}}

                                            <!-- Ikon logistik -->
                                            <div class="d-flex justify-content-center justify-content-md-start gap-3 mt-4">
                                                <div class="transport-icon">
                                                    <i class="fas fa-ship"></i> <!-- Laut -->
                                                </div>
                                                <div class="transport-icon">
                                                    <i class="fas fa-plane"></i> <!-- Udara -->
                                                </div>
                                                <div class="transport-icon">
                                                    <i class="fas fa-truck"></i> <!-- Darat -->
                                                </div>
                                                <div class="transport-icon">
                                                    <i class="fas fa-box"></i> <!-- Kargo umum -->
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="header-carousel-item hero-section">
                <div class="hero-bg-half-2"></div>
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    
                                    <div class="hero-text text-sm-center text-md-start">
                                          <h4 class="text-white text-uppercase fw-bold mb-4 animate__animated animate__fadeInDown">
                                              Express sea Freight
                                          </h4>
                                          <h1 class="display-1 text-white mb-4 animate__animated animate__fadeInUp">
                                              Global Freight, Warehousing and Logistics Services
                                          </h1>
                                        <p class="lead text-light animate__animated animate__fadeIn">
                                               Driven by Reliability <span class="fw-bold text-light">Fast. Safe. On Time.</span>
                                            </p>
                                            <a href="/wpc-esys/qoutation-request" class="btn btn-gradient px-4 py-2 mt-2">
                                              Get Quote
                                            </a>

                                             {{-- <a href="" class="btn btn-gradient px-4 py-2 mt-2">
                                              Tracking Login
                                              </a> --}}

                                              <!-- Ikon logistik -->
                                              <div class="d-flex justify-content-center justify-content-md-start gap-3 mt-4">
                                                  <div class="transport-icon">
                                                      <i class="fas fa-ship"></i> <!-- Laut -->
                                                  </div>
                                                  <div class="transport-icon">
                                                      <i class="fas fa-plane"></i> <!-- Udara -->
                                                  </div>
                                                  <div class="transport-icon">
                                                      <i class="fas fa-truck"></i> <!-- Darat -->
                                                  </div>
                                                  <div class="transport-icon">
                                                      <i class="fas fa-box"></i> <!-- Kargo umum -->
                                                  </div>
                                              </div>
                                          </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->

     

      <!-- About Start -->
        <div class="container-fluid about pt-5">
            <div class="container pt-5">
                <div class="row g-5">
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="about-content h-100">
                            <h4 class="text-light">About WPS LOGISTIC</h4>
                            <h1 class="display-4 text-white mb-4">Express Sail Freight Experience That Delivers</h1>
                            <p class="mb-4">Since 1998, WPC Logistics has provided our customers with alternative logistics solutions that ensure seamless delivery. Furthermore, WPC Logistics continuously updates its systems by periodically changing its delivery cycle..</p>
                            <div class="tab-class pb-4">
                                <ul class="nav d-flex mb-2">
                                    <li class="nav-item mb-3 me-3">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logisticsModal">
                                             Logistics
                                            </button>
                                    </li>

                                     <li class="nav-item ml-3 me-3">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transportationModal">
                                             Transportation
                                            </button>
                                    </li>
                                    
                                  <li class="nav-item ml-3 me-3">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#warehouseModal">
                                            Warehouse
                                            </button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane fade show p-0 active">
                                        <div class="row">
                                            <div class="col-12">
                                            <!-- Item 1 -->
                                            <div class="d-flex align-items-start border-top border-bottom py-4">
                                                <span class="fas fa-ship text-white fa-4x me-4"></span>
                                                <p class="mb-0">
                                                There are many ways to do the whole process which we call the basic of third party logistics (3PL). 
                                                The operator must understand each process from start to finish, as the whole process is not only 
                                                about the product itself but also requires observation before execution. 
                                                Everything must be integrated with professionals who understand the market process.
                                                </p>
                                            </div>

                                            <!-- Item 2 -->
                                            <div class="d-flex align-items-start border-top border-bottom py-4">
                                                <span class="fas fa-truck text-white fa-4x me-4"></span>
                                                <div>
                                                <p class="mb-2">
                                                    WPC Logistics is a logistic provider company focused on efficiency, reliability, 
                                                    and supported by professional human resources with expertise in all logistic sectors, as follows:
                                                </p>
                                                <ol class="mb-0 ps-3">
                                                    <li>Have office branches in most of major ports in Indonesia</li>
                                                    <li>Warehouse facilities for consumer goods, retailer, general merchandise and industrial product</li>
                                                    <li>ISO Tank</li>
                                                    <li>DG Packaging</li>
                                                    <li>Regulation team for consumer goods</li>
                                                </ol>
                                                </div>
                                            </div>

                                             <div class="d-flex align-items-start border-top border-bottom py-4">
                                                <span class="fas fa-plane-departure text-white fa-4x me-4"></span>
                                                <p class="mb-0">
                                                Since 1998, WPC Logistics gives alternative logistic solution while never missed the delivery deadlines to our consumers. In other hand, WPC Logistics also keep the system updated by doing cycle changing regularly.
                                                </p>
                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane fade show p-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center border-top border-bottom py-4">
                                                    <span class="fas fa-rocket text-white fa-4x me-4"></span>
                                                    <p class="mb-0">There is many ways to do the whole process which we called the basic of third party logistics (3PL). The operator have to understand of each process from front to the end as terms of the whole process is not only begin from the product but we must do the observation of the product that need to execute. All have to be integrated with a professional who understand the market process.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-3" class="tab-pane fade show p-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center border-top border-bottom py-4">
                                                    <span class="fas fa-rocket text-white fa-4x me-4"></span>
                                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 align-items-center">
                                <div class="col-sm-6">
                                   <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#privacyModal">
                                     <i class="fa fa-shield-alt fa-2x"></i> Privacy Policy
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex flex-shrink-0 ps-4">
                                        <a href="#" class="btn btn-warning btn-lg-square position-relative wow tada" data-wow-delay=".9s">
                                            <i class="fa fa-phone-alt fa-2x"></i>
                                            <div class="position-absolute" style="top: 5px; right: 5px;">
                                                <span><i class="fa fa-comment-dots text-dark"></i></span>
                                            </div>
                                        </a>
                                        <div class="d-flex flex-column ms-3">
                                            <span>Call to Our Experts</span>
                                            <a href="tel:+62 21 3450605"><span class="text-white">Free: +62 21 3450605</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="about-img">
                            <div class="about-img-inner d-flex h-50">
                                <img src="{{ asset('assets/frontend/img/transportation-service.png') }}" class="img-fluid w-100" style="object-fit: cover;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->



        <!-- Quote Start -->
        <div class="position-relative" 
     style="background-image: url('{{ asset('assets/frontend/img/renew/web1.jpg') }}');
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            min-height: 100vh;">
    
    <!-- Overlay -->
    <div class="position-absolute w-100 h-100" 
         style="background: rgba(0, 51, 102, 0.7); top:0; left:0;"></div>

    <div class="container py-5 position-relative" style="z-index:1;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 rounded shadow-lg p-5 bg-white text-center">

                    <!-- Title -->
                    <h2 class="fw-bold text-uppercase mb-4" style="color:#002147;">
                        Request a Quote
                    </h2>
                    <p class="text-muted mb-4">
                        Get your personalized logistics solution for 
                        <span class="fw-semibold">Air</span>, 
                        <span class="fw-semibold">Sea</span>, and 
                        <span class="fw-semibold">Land</span> transport
                    </p>

                    <!-- Logo -->
                    <div class="mb-4">
                        <img src="{{ asset('/images/certification-logo.png') }}" 
                             alt="Certification Logos" 
                             class="img-fluid" style="max-height:60px;">
                    </div>

                    <!-- Button to Quotation Form -->
                    <a href="/wpc-esys/qoutation-request" 
                       class="btn btn-info px-5 py-3 fw-bold text-white" 
                       style="background-color:#0d3b66; transition:0.3s; border-radius: 12px; border: none;"">
                        GO TO QUOTATION FORM
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
       <!-- Quote End -->



         <!-- Features Start -->
        <div class="container-fluid feature bg-white py-5">
            <div class="container py-5">
                    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
              <h4 class="text-primary fw-bold">Our News</h4>
              <h1 class="display-5 fw-bold mb-4">Check Out Our Latest Stories</h1>
              <p class="mb-0 text-muted">
                Get the latest information about logistics, warehousing, and international shipping to support your business.
              </p>
            </div>

                <div class="feature-carousel owl-carousel">
                   @foreach($blogs as $blog)
                    <div class="feature-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-img">
                            <img src="{{ route('blogs.image.show', ['filename' => $blog->image]) }}" class="img-fluid w-100"  alt="">
                        </div>
                        <div class="feature-content p-4">
                            <h4 class="mb-3">{{ $blog->title }}</h4>
                            <p class="mb-4">{{ Str::limit($blog->excerpt, 100) }}
                            </p>
                            <a href="{{ route('users.news.show', $blog->slug) }}" class="btn btn-warning py-2 px-4" style="background-color: #C7153D; color: #fff;"> <span>Read More</span></a>
                        </div>
                    </div>
                     @endforeach
                    
                    
                </div>
                <div class="feature-shaps"></div>
            </div>
        </div>
        <!-- Features End -->





          <!-- Testimonial Start -->
        <div class="container-fluid testimonial bg-dark py-5" style="margin-bottom: 90px;">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-white">Testimonial</h4>
                    <h1 class="display-4 text-white">What Our Customers Are Saying</h1>
                </div>
                <div class="testimonial-carousel owl-carousel wow fadeInUp" data-wow-delay="0.2s">
                    <div class="testimonial-item mx-auto" style="max-width: 900px;">
                        <span class="fa fa-quote-left fa-3x quote-icon"></span>
                        <div class="testimonial-img mb-4">
                            <img src="{{ asset('assets/frontend/img/testimonial-1.jpg') }}" class="img-fluid" alt="Image">
                        </div>
                        <p class="fs-4 text-white mb-4">All network data is on progress uploading to provide a new service level of inquiry
                        </p>
                        <div class="d-block">
                            <h4 class="text-white">WPC Team</h4>
                            <p class="m-0 pb-3">WPC IT Development</p>
                            <div class="d-flex">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item mx-auto" style="max-width: 900px;">
                        <span class="fa fa-quote-left fa-3x quote-icon"></span>
                        <div class="testimonial-img mb-4">
                            <img src="{{ asset('assets/frontend/img/testimonial-3.jpg') }}" class="img-fluid" alt="Image">
                        </div>
                        <p class="fs-4 text-white mb-4">Logistic is like an art, without a right composition it is just an ordinary art
                        </p>
                        <div class="d-block">
                            <h4 class="text-white">Sutiono T</h4>
                            <p class="m-0 pb-3">CEO WPC Logistics</p>
                            <div class="d-flex">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item mx-auto" style="max-width: 900px;">
                        <span class="fa fa-quote-left fa-3x quote-icon"></span>
                        <div class="testimonial-img mb-4">
                            <img src="{{ asset('assets/frontend/img/testimonial-2.jpg') }}" class="img-fluid" alt="Image">
                        </div>
                        <p class="fs-4 text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero quasi deleniti ratione similique eaque blanditiis fugit voluptas ex officiis expedita repellat doloribus veniam delectus tempore, laudantium, aliquam ad? Rem, accusantium?
                        </p>
                        <div class="d-block">
                            <h4 class="text-white">Client Name</h4>
                            <p class="m-0 pb-3">Profession</p>
                            <div class="d-flex">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->













        
        <!-- Modal privacy -->
           <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="exampleModalLabel">Terms & Conditions & Privacy Policy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body" style="text-align: justify; font-size: 0.9rem;">
        <h5 class="fw-bold">Web Site Terms and Conditions of Use</h5>
        
        <h6>1. Terms</h6>
        <p>
          By accessing this web site, you are agreeing to be bound by these web site Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this web site are protected by applicable copyright and trade mark law.
        </p>

        <h6>2. Use License</h6>
        <p>Permission is granted to temporarily download one copy of the materials (information or software) on WPC's web site for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
        <ul>
          <li>Modify or copy the materials;</li>
          <li>Use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
          <li>Attempt to decompile or reverse engineer any software contained on WPC's web site;</li>
          <li>Remove any copyright or other proprietary notations from the materials; or</li>
          <li>Transfer the materials to another person or "mirror" the materials on any other server.</li>
        </ul>
        <p>This license shall automatically terminate if you violate any of these restrictions and may be terminated by WPC at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.</p>

        <h6>3. Disclaimer</h6>
        <p>
          The materials on WPC's web site are provided "as is". WPC makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. 
        </p>

        <h6>4. Limitations</h6>
        <p>
          In no event shall WPC or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on WPC's Internet site, even if WPC or a WPC authorized representative has been notified orally or in writing of the possibility of such damage. 
        </p>

        <h6>5. Revisions and Errata</h6>
        <p>
          The materials appearing on WPC's web site could include technical, typographical, or photographic errors. WPC does not warrant that any of the materials on its web site are accurate, complete, or current. 
        </p>

        <h6>6. Links</h6>
        <p>
          WPC has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by WPC of the site. Use of any such linked web site is at the user's own risk.
        </p>

        <h6>7. Site Terms of Use Modifications</h6>
        <p>
          WPC may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.
        </p>

        <h6>8. Governing Law</h6>
        <p>
          Any claim relating to WPC's web site shall be governed by the laws of Indonesia without regard to its conflict of law provisions.
        </p>

        <hr>

        <h5 class="fw-bold">Privacy Policy</h5>
        <p>Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy policy.</p>
        <ul>
          <li>Before or at the time of collecting personal information, we will identify the purposes for which information is being collected.</li>
          <li>We will collect and use of personal information solely with the objective of fulfilling those purposes specified by us and for other compatible purposes, unless we obtain the consent of the individual concerned or as required by law.</li>
          <li>We will only retain personal information as long as necessary for the fulfillment of those purposes.</li>
          <li>We will collect personal information by lawful and fair means and, where appropriate, with the knowledge or consent of the individual concerned.</li>
          <li>Personal data should be relevant to the purposes for which it is to be used, and, to the extent necessary for those purposes, should be accurate, complete, and up-to-date.</li>
          <li>We will protect personal information by reasonable security safeguards against loss or theft, as well as unauthorized access, disclosure, copying, use or modification.</li>
          <li>We will make readily available to customers information about our policies and practices relating to the management of personal information.</li>
        </ul>
        <p>We are committed to conducting our business in accordance with these principles in order to ensure that the confidentiality of personal information is protected and maintained.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



{{-- Modern Logistics Modal --}}
<div class="modal fade" id="logisticsModal" tabindex="-1" aria-labelledby="logisticsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
      
      <!-- Header -->
      <div class="modal-header bg-gradient text-white border-0">
        <h5 class="modal-title d-flex align-items-center fw-bold" id="logisticsModalLabel">
          <i class="fas fa-box-open me-2"></i> Logistics Services
        </h5>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body px-4 py-4">
        <p class="text-muted mb-4">
          Anyone can store inventory and send it out on a truck. 
          But when outsourcing logistics, it’s important to choose a provider with 
          <span class="fw-semibold text-primary">proven expertise</span> to ensure efficiency, scalability, and reliability.
        </p>
        
        <div class="row g-4">
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-box-open fa-lg text-primary me-3"></i>
              <span>Inventory Management</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-truck fa-lg text-success me-3"></i>
              <span>Transportation & Delivery</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-warehouse fa-lg text-warning me-3"></i>
              <span>Warehousing Solutions</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-clipboard-check fa-lg text-danger me-3"></i>
              <span>Quality Control</span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Footer -->
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
          <i class="fas fa-times me-1"></i> Close
        </button>
      </div>
      
    </div>
  </div>
</div>



{{-- Modern Transportation Modal --}}
<div class="modal fade" id="transportationModal" tabindex="-1" aria-labelledby="transportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
      
      <!-- Header -->
      <div class="modal-header bg-gradient text-white border-0">
        <h5 class="modal-title d-flex align-items-center fw-bold" id="transportModalLabel">
          <i class="fas fa-truck me-2"></i> Transportation
        </h5>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body px-4 py-4">
        <p class="text-muted mb-4">
          The strategic delivery of goods is critical to your market position. 
          <span class="fw-semibold text-primary">Shorter transit times</span>, 
          <span class="fw-semibold text-success">lower delivery costs</span>, 
          <span class="fw-semibold text-warning">order traceability</span>, 
          and <span class="fw-semibold text-danger">service reliability</span> 
          are competitive differentiators that WPC helps your company realize.
        </p>
        
        <div class="row g-4">
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-box-open fa-lg text-primary me-3"></i>
              <span>Inventory Management</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-truck fa-lg text-success me-3"></i>
              <span>Transportation & Delivery</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-warehouse fa-lg text-warning me-3"></i>
              <span>Warehousing Solutions</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-clipboard-check fa-lg text-danger me-3"></i>
              <span>Quality Control</span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Footer -->
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
          <i class="fas fa-times me-1"></i> Close
        </button>
      </div>
      
    </div>
  </div>
</div>



{{-- Modern Warehousing Modal --}}
<div class="modal fade" id="warehouseModal" tabindex="-1" aria-labelledby="warehouseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
      
      <!-- Header -->
      <div class="modal-header bg-gradient text-white border-0">
        <h5 class="modal-title d-flex align-items-center fw-bold" id="warehouseModalLabel">
          <i class="fas fa-warehouse me-2"></i> Warehousing
        </h5>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body px-4 py-4">
        <p class="text-muted mb-4">
          Optimized warehousing is essential to achieving 
          <span class="fw-semibold text-primary">shorter lead times</span>, 
          <span class="fw-semibold text-success">lower costs</span>, 
          and <span class="fw-semibold text-warning">greater flexibility</span>.  
          WPC provides modern storage solutions that ensure 
          <span class="fw-semibold text-danger">efficiency and reliability</span>.
        </p>
        
        <div class="row g-4">
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-box-open fa-lg text-primary me-3"></i>
              <span>Inventory Management</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-truck fa-lg text-success me-3"></i>
              <span>Transportation & Delivery</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-warehouse fa-lg text-warning me-3"></i>
              <span>Warehousing Solutions</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center p-3 bg-light rounded-3 shadow-sm h-100">
              <i class="fas fa-clipboard-check fa-lg text-danger me-3"></i>
              <span>Quality Control</span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Footer -->
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
          <i class="fas fa-times me-1"></i> Close
        </button>
      </div>
      
    </div>
  </div>
</div>


@endsection
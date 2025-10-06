@extends('frontend.layouts.app')
@section('content')


  <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb-about">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-2 wow fadeInDown" data-wow-delay="0.1s">Who We Are</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item"><a href="">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">About</li>
                </ol>    
                <small class="text-white fw-bolder">Global Freight Forwarding and Logistics Services
             Quality service is our focus</small>
            </div>
        </div>
        <!-- Header End -->

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



        <!-- Modal -->
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




{{-- modal logistik --}}
<div class="modal fade" id="logisticsModal" tabindex="-1" aria-labelledby="logisticsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      
      <!-- Header -->
      <div class="modal-header bg-white text-white">
        <h5 class="modal-title d-flex align-items-center" id="logisticsModalLabel">
          <i class="fas fa-box-open me-2"></i> Logistics
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body">
        <p>
          Anyone can store inventory and send it out on a truck. 
          When looking to outsource all or part of a company’s logistics function, 
          it is important to look for a third-party logistics provider with proven expertise.
        </p>
        
        <ul class="list-unstyled">
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-box-open text-secondary me-2"></i> Inventory Management
          </li>
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-truck text-secondary me-2"></i> Transportation & Delivery
          </li>
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-warehouse text-secondary me-2"></i> Warehousing Solutions
          </li>
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-clipboard-check text-secondary me-2"></i> Quality Control
          </li>
        </ul>
      </div>
      
      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times me-1"></i> Close
        </button>
      </div>
      
    </div>
  </div>
</div>



{{-- modal transport --}}
<div class="modal fade" id="transportationModal" tabindex="-1" aria-labelledby="logisticsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      
      <!-- Header -->
      <div class="modal-header bg-white text-white">
        <h5 class="modal-title d-flex align-items-center" id="transportModalLabel">
          <i class="fas fa-truck me-2"></i> Transportation
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body">
        <p>
         The strategic delivery of goods is critical to your market position. Shorter transit times, lower delivery costs, 
         order traceability, and service reliability are competitve differentiators that WPC can help your company realize..
        </p>
        
        <ul class="list-unstyled">
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-box-open text-secondary me-2"></i> Inventory Management
          </li>
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-truck text-secondary me-2"></i> Transportation & Delivery
          </li>
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-warehouse text-secondary me-2"></i> Warehousing Solutions
          </li>
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-clipboard-check text-secondary me-2"></i> Quality Control
          </li>
        </ul>
      </div>
      
      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times me-1"></i> Close
        </button>
      </div>
      
    </div>
  </div>
</div>



{{-- modal transport --}}
<div class="modal fade" id="warehouseModal" tabindex="-1" aria-labelledby="logisticsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      
      <!-- Header -->
      <div class="modal-header bg-white text-white">
        <h5 class="modal-title d-flex align-items-center" id="warehouseModalLabel">
          <i class="fas fa-warehouse me-2"></i> Warehousing
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body">
        <p>
         The strategic delivery of goods is critical to your market position. Shorter transit times, lower delivery costs, 
         order traceability, and service reliability are competitve differentiators that WPC can help your company realize..
        </p>
        
        <ul class="list-unstyled">
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-box-open text-secondary me-2"></i> Inventory Management
          </li>
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-truck text-secondary me-2"></i> Transportation & Delivery
          </li>
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-warehouse text-secondary me-2"></i> Warehousing Solutions
          </li>
          <li class="d-flex align-items-center mb-2">
            <i class="fas fa-clipboard-check text-secondary me-2"></i> Quality Control
          </li>
        </ul>
      </div>
      
      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times me-1"></i> Close
        </button>
      </div>
      
    </div>
  </div>
</div>

@endsection
@extends('frontend.layouts.app')
@section('content')


  <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb-contact">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item text-light fw-bolder"><a href="">Home</a></li>
                    <li class="breadcrumb-item active text-primary">About</li>
                </ol>    
                 <small class="text-white fw-bolder">Contact any of our offices below, and we’ll connect you to the right place. During business hours, a real person will always answer—no automated systems</small>
            </div>
        </div>
        <!-- Header End -->

               


         <!-- Contact Start -->
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="mb-4">
                            <h4 class="text-primary">Contact Us</h4>
                            <h1 class="display-4 mb-4">Connect With Our Logistics Experts</h1>
                            <p class="mb-4"> Have questions about logistics, warehousing, or shipping solutions?  
                            Our expert team is ready to help you find the most efficient and reliable way to move your goods.  
                            Whether it’s storage, transportation, or end-to-end supply chain management — we’ve got you covered.  
                            Reach out today and let’s optimize your logistics together. <a class="text-primary fw-bold" href="/wpc-esys/form-qoutation">Get Qoute</a>.
                            </p>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="bg-white d-flex">
                                        <i class="fas fa-map-marker-alt fa-2x text-primary me-2"></i>
                                        <div>
                                            <h4>Address</h4>
                                            <p class="mb-0">WPC MAIN OFFICE - INDONESIA
                                                Jl. Kesehatan Raya No. 54 B Tanah Abang IV, Jakarta 10160</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="bg-white d-flex">
                                        <i class="fas fa-envelope fa-2x text-primary me-2"></i>
                                        <div>
                                            <h4>Mail Us</h4>
                                            <p class="mb-0"> inquiry@wpclogistics.com</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="bg-white d-flex">
                                        <i class="fa fa-phone-alt fa-2x text-primary me-2"></i>
                                        <div>
                                            <h4>Telephone</h4>
                                            <p class="mb-0">+62 21 3450605</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="bg-white d-flex">
                                        <i class="fas fa-fax fa-2x text-primary me-2"></i>
                                        <div>
                                            <h4>Fax</h4>
                                            <p class="mb-0">+62 21 3458307</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-2 mb-5">
                            <a class="btn btn-dark py-2 px-3 px-sm-4 me-2" href="#"> <span>Instagram</span> <i class="fas fa-chevron-circle-right"></i></a>
                            <a class="btn btn-dark py-2 px-3 px-sm-4 ms-2" href="#"> <span>Facebook</span> <i class="fas fa-chevron-circle-right"></i></a>
                            <a class="btn btn-dark py-2 px-3 px-sm-4 mx-2" href="#"> <span>X</span> <i class="fas fa-chevron-circle-right"></i></a>
                        </div>
                        <div class="contact-banner">
                            <div class="row g-0">
                                <div class="col-9">
                                    <div class="p-4 pe-0">
                                        <h4 class="display-5 mb-0">collaborate with our company</h4>
                                        <div class="d-flex align-items-center">
                                            <a href="/wpc-esys/qoutation-request" class="h5 mb-0 me-3">visit our Qoute</a>
                                            <a class="text-primary py-3" href=""><i class="fas fa-file-import me-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                         <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.4s">
            <div class="form-section bg-dark p-5 h-100">
                <h1 class="display-4 text-white mb-4">Contact Form</h1>
                {{-- ALERT SUCCESS --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- ALERT ERROR --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                <form action="{{ route('users.contact.form.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12 col-xl-6">
                                <label for="name">Your Name</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="Your Name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="col-lg-12 col-xl-6">
                                <label for="email">Your Email</label>
                                <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Your Email">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="col-lg-12 col-xl-6">
                            <label for="phone">Your Phone</label>
                            <input type="text" class="form-control" value="{{ old('phone') }}" id="phone" name="phone" placeholder="Phone">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-xl-6">
                            <label for="interested_in">I Am Interested In</label>
                            <select name="interested_in" id="interested_in" class="form-control" style="width: 100%; height: 38px">
                                <option value="">Chose One Field</option>
                                <option value="Request To Join Network" {{ old('interested_in') == 'Request To Join Network' ? 'selected' : '' }}>Request To Join Network</option>
                                <option value="Request To Become Member"  {{ old('interested_in') == 'Request To Become Member' ? 'selected' : '' }}>Request To Become Member</option>
                                <option value="Logistics" {{ old('interested_in') == 'Logistics' ? 'selected' : '' }}>Logistics</option>
                                <option value="Transportation" {{ old('interested_in') == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                                <option value="Warehousing" {{ old('interested_in') == 'Warehousing' ? 'selected' : '' }}>Warehousing</option>
                            </select>
                        @error('interested_in')
                                <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="col-12">
                            <label for="subject">Subject</label>
                            <input type="text text-bold" value="{{ old('subject') }}" class="form-control" id="subject" name="subject" placeholder="Subject">
                        @error('subject')
                                <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="col-12">
                                <label for="message">Message</label>
                                <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 160px;">{{ old('message') }}</textarea>
                        @error('message')
                                <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        {{-- <div class="col-12 mt-3">
                            <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
                        </div> --}}

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" name="agree_privacy" type="checkbox" value="1" id="flexCheck">
                                <label class="form-check-label" for="flexCheck">
                                    I agree with the site privacy policy
                                </label>
                                @error('agree_privacy')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-default btn-danger w-100">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
                </div>
    

        <!-- Google reCAPTCHA script -->
        {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}

                                </div>
                            </div>
        {{-- <div class="col-12 wow fadeInUp" data-wow-delay="0.2s">
            <div class="h-100 overflow-hidden">
                <iframe class="w-100" style="height: 400px;" 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3966.442191261933!2d106.815447!3d-6.176994!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f35b8a5e3b57%3A0x2b9f1f1f1f1f1f1f!2sJl.%20Taman%20Tanah%20Abang%20III%2054%2C%20Petojo%20Sel.%2C%20Kec.%20Gambir%2C%20Kota%20Jakarta%20Pusat%2C%20DKI%20Jakarta%2010160!5e0!3m2!1sen!2sid" 
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            </div>
        </div> --}}
        <!-- Contact End -->
        


<script type="text/javascript">
    // assetCode
    $(document).ready(function() {
        $("#interested_in").select2({
          placeholder: "SELECT ONE FIELD",
           allowClear: true,
           theme: 'bootstrap4',
        });


        setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 9000); // 4 detik
    });
</script>

@endsection
@extends('frontend.layouts.app')
@section('content')


  <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb-tracking">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Get a Quotation</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item text-light fw-bolder"><a href="">Home</a></li>
                    <li class="breadcrumb-item active text-primary">Quotation</li>
                </ol>    
                 <small class="text-white fw-bolder">By completing this form, you are requesting rates from WPC Logistic. Please complete this form as accurately as possible. One of our representatives will contact you via E-mail as quickly as possible within 24 hours.</small>
            </div>
        </div>
        <!-- Header End -->

         
<!-- Quote Start -->
<div class="position-relative" 
     style="background-image: url('{{ asset('assets/frontend/img/new/carousel-1.jpg') }}');
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            min-height: 100vh;">
    
    <!-- Overlay -->
    <div class="position-absolute w-100 h-100" 
         style="background: rgba(0, 51, 102, 0.7); top:0; left:0;"></div>

    <div class="container py-5 position-relative" style="z-index:1;">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 rounded shadow-lg p-4 p-md-5 bg-white">
                    <div class="card-body">

                        <!-- Title -->
                        <div class="text-center mb-5">
                            <h2 class="fw-bold text-uppercase" style="color:#002147;">Create Request Quotation</h2>
                            <p class="text-muted mb-3">
                                Get your personalized logistics solution for 
                                <span class="fw-semibold">Air</span>, 
                                <span class="fw-semibold">Sea</span>, and 
                                <span class="fw-semibold">Land</span> Transport
                            </p>
                            <hr class="mx-auto" style="width:80px; border:3px solid #be1003; opacity:1;">
                        </div>

                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/frontend/img/certification-logo.png') }}" 
                                 alt="Certification Logos" 
                                 class="img-fluid" style="max-height:60px;">
                        </div>

                        <!-- Personal Information -->
                        <h5 class="fw-bold mb-4" style="color:#002147;">
                            Personal Information 
                            <hr class="d-inline-block ms-2" style="width:60px; border:2px solid #be1003; opacity:1;">
                        </h5>

                       <form action="{{ route('users.qoutation.store') }}" method="POST">
                            @csrf
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Company Name">
                                 @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                </div>

                                {{-- <div class="col-md-6">
                                    <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                                    @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                {{-- <div class="col-md-6">
                                    <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address">
                                    @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                                        <div class="col-md-6">
                                        <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="phone_type" class="form-select" style="max-width: 150px;">
                                                <option value="personal" {{ old('phone_type') == 'personal' ? 'selected' : '' }}>Personal</option>
                                                <option value="company" {{ old('phone_type') == 'company' ? 'selected' : '' }}>Company</option>
                                                <option value="office" {{ old('phone_type') == 'office' ? 'selected' : '' }}>Office</option>
                                            </select>
                                            <input type="text" 
                                                name="phone" 
                                                value="{{ old('phone') }}" 
                                                class="form-control @error('phone') is-invalid @enderror" 
                                                placeholder="Phone Number">
                                        </div>
                                        @error('phone')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="email_type" class="form-select" style="max-width: 150px;">
                                                <option value="personal" {{ old('email_type') == 'personal' ? 'selected' : '' }}>Personal</option>
                                                <option value="company" {{ old('email_type') == 'company' ? 'selected' : '' }}>Company</option>
                                                <option value="office" {{ old('email_type') == 'office' ? 'selected' : '' }}>Office</option>
                                            </select>
                                            <input type="email" 
                                                name="email" 
                                                value="{{ old('email') }}" 
                                                class="form-control @error('email') is-invalid @enderror" 
                                                placeholder="Email Address">
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>



                                <div class="col-md-6">
                                <label class="form-label fw-bold">Select An Option <span class="text-danger">*</span></label>
                                <select name="bussines_type" id="bussines_type" class="form-select @error('bussines_type') is-invalid @enderror" style="width: 100%;">
                                    <option value="">-- Select --</option>
                                    <option value="I am a business" {{ old('bussines_type') == 'I am a business' ? 'selected' : '' }}>I am a business</option>
                                    <option value="I am a freight forwarder" {{ old('bussines_type') == 'I am a freight forwarder' ? 'selected' : '' }}>I am a freight forwarder</option>
                                </select>
                                @error('bussines_type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                               </div>

                                {{-- <div class="col-md-6">
                                    <label class="form-label fw-bold">State / City <span class="text-danger">*</span></label>
                                   <select name="state" id="state" class="form-select @error('state') is-invalid @enderror" style="width: 100%;">
                                    <option value="">-- SELECT State / City --</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state['id'] }}" {{ old('state') == $state['id'] ? 'selected' : '' }}>
                                            {{ $state['name'] }} - {{ $state['country'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('state')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                </div> --}}


                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Country <span class="text-danger">*</span></label>
                                   <select name="country" id="country" class="form-select @error('country') is-invalid @enderror" style="width: 100%;">
                                    <option value="">-- SELECT COUNTRY --</option>
                                </select>
                                @error('country')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                </div>


                                <div class="col-md-6">
                                <label class="form-label fw-bold">State <span class="text-danger">*</span></label>
                                <select name="state" id="state" class="form-select @error('state') is-invalid @enderror" style="width: 100%;">
                                    <option value="">-- SELECT STATE --</option>
                                </select>
                                @error('state')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <!-- Help Section -->
                            <h5 class="fw-bold mb-4 mt-4" style="color:#002147;">
                                How can we help you? 
                                <hr class="d-inline-block ms-2" style="width:60px; border:2px solid #be1003; opacity:1;">
                            </h5>

                            <div class="row g-3 mb-4">

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Transportation Method Delivery <span class="text-danger">*</span></label>
                                    <select name="transportation" id="transportation_pickup" class="form-select transportation @error('transportation') is-invalid @enderror" style="width: 100%;">
                                        <option value="">- Select -</option>
                                        <option value="Air">Air</option>
                                        <option value="Ocean">Ocean</option>
                                    </select>
                                    @error('transportation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                     @enderror
                                </div>



                                {{-- <div class="col-md-6">
                                    <label class="form-label fw-bold">Transportation Method Pickup <span class="text-danger">*</span></label>
                                    <select name="transportation" id="transportation_pickup" class="form-select @error('transportation') is-invalid @enderror" style="width: 100%;">
                                        <option value="">- Select -</option>
                                        @foreach ($transportations as $transport)
                                            <option value="{{ $transport['value'] }}">
                                                {{ $transport['value'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                     @error('transportation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                     @enderror
                                </div> --}}


                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Pickup Address or Port of Origin <span class="text-danger">*</span></label>
                                    <select name="pickup_origin" id="pickup_origin" class="form-select @error('pickup_origin') is-invalid @enderror" style="width: 100%;">
                                        <option value="">- Select -</option>
                                    </select>
                                    @error('pickup_origin')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                     @enderror
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Transportation Method Delivery <span class="text-danger">*</span></label>
                                    <select name="transportation" id="transportation_delivery" class="form-select transportation @error('transportation') is-invalid @enderror" style="width: 100%;">
                                        <option value="">- Select -</option>
                                        <option value="Air">Air</option>
                                        <option value="Ocean">Ocean</option>
                                    </select>
                                    @error('transportation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                     @enderror
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Delivery Address or Port of Destination <span class="text-danger">*</span></label>
                                    <select name="delivery_destination" id="delivery_destination" class="form-select @error('delivery_destination') is-invalid @enderror" style="width: 100%;">
                                        <option value="">- Select -</option>
                                    </select>
                                     @error('delivery_destination')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                     @enderror
                                </div>


                               <div class="col-12">
                                    <label class="form-label fw-bold">Cargo Details <span class="text-danger">*</span></label>
                                    <textarea 
                                        class="form-control @error('cargo_details') is-invalid @enderror" 
                                        name="cargo_details" 
                                        rows="3" 
                                        placeholder="Pieces, weights, dimensions, and any special handling requirements">{{ old('cargo_details') }}</textarea>
                                    @error('cargo_details')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" 
                                        class="btn px-5 py-2 fw-bold text-white" 
                                        style="background-color:#0d3b66; transition:0.3s;">
                                    SUBMIT FORM
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quote End -->
<script>

// khusus statis dan from controller 
$(document).ready(function() {
    $('#country').select2({
        placeholder: "SELECT A COUNTRY",
        allowClear: true,
        theme: 'bootstrap4'
    });

     $('#state').select2({
        placeholder: "SELECT A STATE",
        allowClear: true,
        theme: 'bootstrap4'
    });

     $('#transportation_pickup').select2({
        placeholder: "SELECT",
        allowClear: true,
        theme: 'bootstrap4'
    });

     $('#transportation_delivery').select2({
        placeholder: "SELECT",
        allowClear: true,
        theme: 'bootstrap4'
    });

    $('#bussines_type').select2({
        placeholder: "SELECT A OPTION",
        allowClear: true,
        theme: 'bootstrap4'
    });

     $('#pickup_origin').select2({
        placeholder: "SELECT",
        allowClear: true,
        theme: 'bootstrap4'
    });


    $('#delivery_destination').select2({
        placeholder: "SELECT",
        allowClear: true,
        theme: 'bootstrap4'
    });


// khusus ajax reload  

  $('#transportation_pickup').on('change', function() {
        let transport = $(this).val();

        if (transport) {
            $.ajax({
                url: "/pickup",  // route Laravel, bukan langsung ngrok
                type: "GET",
                data: { transportation: transport },
                success: function(response) {
                    let pickupSelect = $('#pickup_origin');
                    pickupSelect.empty().append('<option disabled selected>- SELECT A PICKUP ORIGIN -</option>');
                    if (response.data) {
                        response.data.forEach(function(item) {
                            let optionText =  item.pickup_origin_address + " (" + item.country_name + ")";
                            pickupSelect.append('<option value="'+item.id+'">'+optionText+'</option>');
                        });
                    }
                    console.log(response);
                },
                error: function() {
                    alert("Gagal mengambil data pickup origins");
                }
            });
        }
    });


    $('#transportation_delivery').on('change', function() {
        let transport = $(this).val();
        if (transport) {
            $.ajax({
                url: "/delivery",  // route Laravel, bukan langsung ngrok
                type: "GET",
                data: { transportation: transport },
                success: function(response) {
                    let deliveryDestinationSelect = $('#delivery_destination');
                    deliveryDestinationSelect.empty().append('<option disabled selected>- SELECT A DELIVERY DESTINATION -</option>');

                    if (response.data) {
                        response.data.forEach(function(item) {
                            let optionText = item.pickup_destination_address + " (" + item.country_name + ")";
                            deliveryDestinationSelect.append('<option value="'+item.id+'">'+optionText+'</option>');
                        });
                    }
                    console.log(response);
                },
                error: function() {
                    alert("Gagal mengambil data Delivery Destination");
                }
            });
        }
    });
});


// });
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const success = @json(session('success'));
    const error   = @json(session('error'));

   if (success) {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: success,
        confirmButtonText: 'OK',
        confirmButtonColor: '#0f1d3a',
        background: '#ffffff',
        color: '#374151',
        customClass: {
            popup: 'rounded-xl shadow-md',
            title: 'text-xl font-semibold',
        }
    });
}



    if (error) {
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: error,
        confirmButtonText: 'Close',
        confirmButtonColor: '#0f1d3a', // merah clean
        background: '#ffffff',
        color: '#374151',
        customClass: {
            popup: 'rounded-xl shadow-md',
            title: 'text-xl font-semibold',
        }
    });
}

});
</script>


<script>
$(document).ready(function () {
    // Load countries di awal
    $.ajax({
        url: "/api/countries",
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (response.success) {
                let $dropdown = $("#country");
                response.data.forEach(function(item) {
                    $dropdown.append(
                        $("<option>", {
                            value: item.id, // pakai ID untuk ambil state nanti
                            text: item.name + " (" + item.code + ")"
                        })
                    );
                });
            }
        }
    });

    // Saat country berubah, load states
    $("#country").on("change", function () {
        let countryId = $(this).val();
        let $stateDropdown = $("#state");

        $stateDropdown.empty().append('<option value="">-- Select State --</option>');

        if (countryId) {
            $.ajax({
                url: "/api/states/" + countryId,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        response.data.forEach(function(item) {
                            $stateDropdown.append(
                                $("<option>", {
                                    value: item.id,
                                    text: item.name
                                })
                            );
                        });
                    }
                }
            });
        }
    });
});
</script>


@endsection
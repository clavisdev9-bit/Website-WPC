@extends('qoutations.layouts.app')

@section('content')
<div class="container my-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <!-- Card Utama -->
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#quotation" role="tab">Quotation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#point-to-point" role="tab">Point to Point</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tracking" role="tab">Tracking</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">

                        <!-- Quotation Tab -->
                        <div class="tab-pane fade show active" id="quotation" role="tabpanel">
                            <div class="card shadow-sm p-4">
                                <h4 class="fw-bold mb-4">Request Quotation</h4>

                                <form>
                                    <!-- Personal Info -->
                                      <h5 class="fw-bold mb-3 text-primary">Personal Information  <i class="fa fa-user"></i></h5>
                                      
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" placeholder="Enter your name">
                                        </div>
                                        
                                         <div class="col-md-6 mb-3">
                                            <label class="form-label">Company</label>
                                            <input type="text" class="form-control" placeholder="Company name">
                                        </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-6 mb-3">
                                            <label class="form-label">Phone</label>
                                            <div class="input-group">
                                                <select class="form-select" style="max-width: 150px;">
                                                    <option selected disabled>Type</option>
                                                    <option value="personal">Personal</option>
                                                    <option value="office">Office</option>
                                                    <option value="whatsapp">WhatsApp</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <input type="text" class="form-control" placeholder="Enter your phone number">
                                            </div>
                                        </div>

                                       <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <div class="input-group">
                                                <select class="form-select" style="max-width: 150px;">
                                                    <option selected disabled>Type</option>
                                                    <option value="personal">Personal</option>
                                                    <option value="company">Company</option>
                                                    <option value="office">Office</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <input type="email" class="form-control" placeholder="Enter your email">
                                            </div>
                                        </div>
                                    </div>


                                      <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">Country <span class="text-danger">*</span></label>
                                                    <select name="country" id="country" class="form-select @error('country') is-invalid @enderror" style="width: 100%;">
                                                        <option value="">Select Country</option>
                                                    </select>
                                                @error('country')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">State <span class="text-danger">*</span></label>
                                                <select name="state" id="state" class="form-select @error('state') is-invalid @enderror" style="width: 100%;">
                                                    <option value="">select State</option>
                                                </select>
                                                @error('state')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                      </div>

                                    

                                    <!-- Cargo Details -->
                                    <h5 class="fw-bold mt-4 mb-3 text-primary">Cargo Details <i class="fa fa-box"></i></h5>
                                    <div class="mb-3">
                                        <label class="form-label">Cargo Description</label>
                                        <textarea class="form-control" rows="3" placeholder="Describe your cargo"></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Pieces</label>
                                            <input type="number" class="form-control" placeholder="e.g. 10">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Weight (kg)</label>
                                            <input type="number" class="form-control" placeholder="e.g. 500">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Volume (CBM)</label>
                                            <input type="number" class="form-control" placeholder="e.g. 2.5">
                                        </div>
                                    </div>

                                    <!-- Origin & Destination -->
                                    <h5 class="fw-bold mt-4 mb-3 text-primary">Route <i class="fa fa fa-route"></i></h5>
                                    <div class="row">

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

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Origin</label>
                                            <input type="text" class="form-control" placeholder="Port of Origin">
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

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Destination</label>
                                            <input type="text" class="form-control" placeholder="Port of Destination">
                                        </div>
                                    </div>

                                    <div class="text-end mt-3">
                                        <button type="reset" class="btn btn-secondary">Clear</button>
                                        <button type="submit" class="btn btn-primary">Request Quotation</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Point to Point Tab -->
                        <div class="tab-pane fade" id="point-to-point" role="tabpanel">
                            <div class="card shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="fw-bold">Point to Point Search</h4>
                                    <div>
                                        <button class="btn btn-outline-secondary btn-sm">List</button>
                                        <button class="btn btn-outline-secondary btn-sm">Calendar</button>
                                    </div>
                                </div>

                                <form>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Origin</label>
                                            <input type="text" class="form-control" placeholder="Input up to 3 Origins">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Destination</label>
                                            <input type="text" class="form-control" placeholder="Input up to 3 Destinations">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Next</label>
                                            <select class="form-select">
                                                <option>1 Week</option>
                                                <option selected>2 Weeks</option>
                                                <option>1 Month</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Cargo Type</label>
                                            <select class="form-select">
                                                <option>Dry/General</option>
                                                <option>Reefer</option>
                                                <option>Dangerous Goods</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="humanCheck">
                                            <label class="form-check-label" for="humanCheck">I am human</label>
                                        </div>
                                    </div>

                                    <div class="text-end mt-3">
                                        <button type="reset" class="btn btn-secondary">Clear</button>
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Tracking Tab -->
                        <div class="tab-pane fade" id="tracking" role="tabpanel">
                            <div class="card shadow-sm p-4">
                                <h4 class="fw-bold mb-3">Track Your Shipment</h4>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Tracking Number / Container Number</label>
                                        <input type="text" class="form-control" placeholder="Enter your tracking number">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Track Now</button>
                                </form>
                            </div>
                        </div>

                    </div> <!-- end tab content -->

                </div>
            </div> <!-- end card utama -->

        </div>
    </div>
</div>
@endsection

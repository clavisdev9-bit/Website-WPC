{{-- @extends('frontend.layouts.app')
@section('content')


<div class="container-fluid bg-breadcrumb-network">
            <div class="container text-center py-5" style="max-width: 500px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Networks</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item text-light fw-bolder"><a href="">Home</a></li>
                    <li class="breadcrumb-item active text-primary">Networks</li>
                </ol>    
                 <small class="text-white fw-bolder">Our branches are spread all over the world.</small>
            </div>
</div>

 <div class="col-12 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="h-200 overflow-hidden">
    <iframe class="w-100" style="height: 400px;" 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d198317.2912141493!2d106.689431!3d-6.229728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e19e3a4fdf%3A0x301576d14febc70!2sJakarta%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1726549738275!5m2!1sen!2sid" 
        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
                    </div>



                    <div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-globe-americas me-2"></i> Our Coverage
        </h2>
        <p class="text-muted">We operate globally across multiple regions.</p>
    </div>

    <div class="row g-4">
        <!-- Asia -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-globe-asia me-2"></i> Asia
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small">
                        <li>Indonesia</li>
                        <li>India</li>
                        <li>Japan</li>
                        <li>Bangladesh</li>
                        <li>Singapore</li>
                        <li>Malaysia</li>
                        <li>Thailand</li>
                        <li>Vietnam</li>
                        <li>China</li>
                        <li>Korea</li>
                        <!-- ... dst -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Europe -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-globe-europe me-2"></i> Europe
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small">
                        <li>Germany</li>
                        <li>France</li>
                        <li>United Kingdom</li>
                        <li>Italy</li>
                        <li>Spain</li>
                        <li>Poland</li>
                        <li>Netherlands</li>
                        <li>Switzerland</li>
                        <!-- ... dst -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Africa -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-globe-africa me-2"></i> Africa
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small">
                        <li>South Africa</li>
                        <li>Egypt</li>
                        <li>Morocco</li>
                        <li>Uganda</li>
                        <li>Mozambique</li>
                        <li>Angola</li>
                        <!-- ... dst -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tambah card lagi untuk America & Australia -->
    </div>
</div>


@endsection --}}


@extends('frontend.layouts.app')

@section('content')

<div class="container-fluid bg-breadcrumb-network">
    <div class="container text-center py-5" style="max-width: 500px;">
        <h4 class="text-white display-4 mb-4">Networks</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0">
            <li class="breadcrumb-item text-light fw-bolder"><a href="">Home</a></li>
            <li class="breadcrumb-item active text-primary">Networks</li>
        </ol>    
        <small class="text-white fw-bolder">Our branches are spread throughout the world. With the best and fastest service, you can find our agents on the map below or in the table below.</small>
    </div>
</div>

{{-- Map Section --}}
<div class="col-12 my-4">
    <div style="width:100%; height:700px;">
        <div id="map" style="width:100%; height:100%;"></div>
    </div>
</div>



<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-globe-americas me-2"></i> Our Coverage
        </h2>
        <p class="text-muted">We operate globally across multiple regions.</p>
    </div>

    <div class="row g-4">
        <!-- Asia -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-globe-asia me-2"></i> Asia
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small">
                        <li>Indonesia</li>
                        <li>India</li>
                        <li>Japan</li>
                        <li>Bangladesh</li>
                        <li>Singapore</li>
                        <li>Malaysia</li>
                        <li>Thailand</li>
                        <li>Vietnam</li>
                        <li>China</li>
                        <li>Korea</li>
                        <!-- ... dst -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Europe -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-globe-europe me-2"></i> Europe
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small">
                        <li>Germany</li>
                        <li>France</li>
                        <li>United Kingdom</li>
                        <li>Italy</li>
                        <li>Spain</li>
                        <li>Poland</li>
                        <li>Netherlands</li>
                        <li>Switzerland</li>
                        <!-- ... dst -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Africa -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-globe-africa me-2"></i> Africa
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small">
                        <li>South Africa</li>
                        <li>Egypt</li>
                        <li>Morocco</li>
                        <li>Uganda</li>
                        <li>Mozambique</li>
                        <li>Angola</li>
                        <!-- ... dst -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tambah card lagi untuk America & Australia -->
    </div>
</div>

{{-- Leaflet & MarkerCluster --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Init map
    var map = L.map('map').setView([20, 0], 2); // global view

    // Base layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Cluster group
    var markers = L.markerClusterGroup();

    // --- Data Agents Indonesia ---
    var jakarta = [
        { name: "Jakarta Agent 1", coords: [-6.200, 106.816] },
        { name: "Jakarta Agent 2", coords: [-6.220, 106.845] },
        { name: "Jakarta Agent 3", coords: [-6.180, 106.850] },
        { name: "Jakarta Agent 4", coords: [-6.250, 106.830] },
        { name: "Jakarta Agent 5", coords: [-6.210, 106.870] },
        { name: "Jakarta Agent 6", coords: [-6.240, 106.820] },
        { name: "Jakarta Agent 7", coords: [-6.190, 106.810] },
        { name: "Jakarta Agent 8", coords: [-6.230, 106.860] },
        { name: "Jakarta Agent 9", coords: [-6.205, 106.840] },
        { name: "Jakarta Agent 10", coords: [-6.225, 106.855] },
    ];

    var surabaya = [
        { name: "Surabaya Agent 1", coords: [-7.250, 112.738] },
        { name: "Surabaya Agent 2", coords: [-7.255, 112.740] },
        { name: "Surabaya Agent 3", coords: [-7.260, 112.745] },
        { name: "Surabaya Agent 4", coords: [-7.265, 112.750] },
        { name: "Surabaya Agent 5", coords: [-7.270, 112.755] },
        { name: "Surabaya Agent 6", coords: [-7.275, 112.760] },
        { name: "Surabaya Agent 7", coords: [-7.280, 112.765] },
        { name: "Surabaya Agent 8", coords: [-7.285, 112.770] },
        { name: "Surabaya Agent 9", coords: [-7.290, 112.775] },
        { name: "Surabaya Agent 10", coords: [-7.295, 112.780] },
    ];

    var palembang = [
        { name: "Palembang Agent 1", coords: [-2.976, 104.775] },
        { name: "Palembang Agent 2", coords: [-2.980, 104.780] },
        { name: "Palembang Agent 3", coords: [-2.985, 104.785] },
        { name: "Palembang Agent 4", coords: [-2.990, 104.790] },
        { name: "Palembang Agent 5", coords: [-2.995, 104.795] },
    ];

    var bali = [
        { name: "Bali Agent 1", coords: [-8.650, 115.216] },
        { name: "Bali Agent 2", coords: [-8.655, 115.220] },
        { name: "Bali Agent 3", coords: [-8.660, 115.225] },
    ];

    var makassar = [
        { name: "Makassar Agent 1", coords: [-5.147, 119.432] },
        { name: "Makassar Agent 2", coords: [-5.150, 119.435] },
        { name: "Makassar Agent 3", coords: [-5.155, 119.440] },
        { name: "Makassar Agent 4", coords: [-5.160, 119.445] },
    ];

    // --- Data Agents Luar Negeri ---
    var singapore = [
        { name: "Singapore Agent 1", coords: [1.290, 103.851] },
        { name: "Singapore Agent 2", coords: [1.300, 103.860] },
        { name: "Singapore Agent 3", coords: [1.310, 103.870] },
        { name: "Singapore Agent 4", coords: [1.320, 103.880] },
        { name: "Singapore Agent 5", coords: [1.330, 103.890] },
        { name: "Singapore Agent 6", coords: [1.340, 103.900] },
    ];

    var china = [
        { name: "China Agent 1", coords: [39.9042, 116.4074] }, // Beijing
        { name: "China Agent 2", coords: [31.2304, 121.4737] }, // Shanghai
        { name: "China Agent 3", coords: [23.1291, 113.2644] }, // Guangzhou
        { name: "China Agent 4", coords: [30.5728, 104.0668] }, // Chengdu
        { name: "China Agent 5", coords: [22.3193, 114.1694] }, // Hong Kong
        { name: "China Agent 6", coords: [29.5630, 106.5516] }, // Chongqing
        { name: "China Agent 7", coords: [34.3416, 108.9398] }, // Xi’an
    ];

    var us = [
        { name: "US Agent 1", coords: [40.7128, -74.0060] }, // New York
        { name: "US Agent 2", coords: [34.0522, -118.2437] }, // Los Angeles
        { name: "US Agent 3", coords: [41.8781, -87.6298] }, // Chicago
        { name: "US Agent 4", coords: [29.7604, -95.3698] }, // Houston
        { name: "US Agent 5", coords: [33.4484, -112.0740] }, // Phoenix
    ];

    var france = [
        { name: "France Agent 1", coords: [48.8566, 2.3522] }, // Paris
        { name: "France Agent 2", coords: [45.7640, 4.8357] }, // Lyon
        { name: "France Agent 3", coords: [43.2965, 5.3698] }, // Marseille
        { name: "France Agent 4", coords: [44.8378, -0.5792] }, // Bordeaux
        { name: "France Agent 5", coords: [50.6292, 3.0573] }, // Lille
    ];

    // Gabung semua
    var allAgents = [].concat(
        jakarta, surabaya, palembang, bali, makassar,
        singapore, china, us, france
    );

    // Loop semua agent
    allAgents.forEach(agent => {
        var marker = L.marker(agent.coords).bindPopup(`<b>${agent.name}</b>`);
        markers.addLayer(marker);
    });

    map.addLayer(markers);
});
</script>

@endsection

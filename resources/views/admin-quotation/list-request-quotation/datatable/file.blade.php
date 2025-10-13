@extends('layouts.app')
@section('content')

  <!-- Page Header -->
 <div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            Page {{ $title }}
        </div>
        <h2 class="page-title">
            {{ $title }}
        </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            {{-- <a href="" class="btn btn-outline-azure">
             <i class="fa fa-plus"> Create </i>
            </a> --}}
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
            <table class="table card-table table-vcenter text-nowrap" id="qoutationsTable">
                <thead>
                    <tr>
                        <th style="width: 2%">No.</th>
                        <th>Code Quotation</th>
                        <th>Date Request</th>
                        <th>Data Costumer</th>
                        <th>Trasportation <br> Method</th>
                        <th>Data Quotation</th>
                         <th style="width: 5%">Agents Pickup</th>
                        <th style="width: 5%">Agents Destination</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<meta name="route-get-qoute" content="{{ route('get.quotation') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">


{{-- modal Data Cotumers Quotation --}}
<div class="modal fade" id="modal-costumers-quotation" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Details Costumers Request</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p> <b>No Request</b>: <span id="no_reg"></span></p>
        <hr>
        <p><b>Name Costumers:</b> <span id="name_cust"></span></p>

        <div class="row mb-3">
          <div class="col-md-6">
            <b>Email:</b> <span id="email"></span>
          </div>
          <div class="col-md-6">
            <b>Phone:</b> <span id="phone"></span>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <b>State Code:</b> <span id="state_code"></span>
          </div>
          <div class="col-md-6">
            <b>State:</b> <span id="state"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal modal-blur fade" id="modal-quotation" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
	<h5 class="modal-title">Data Quotation Request</h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="container">
        <article class="card">
            <header class="card-header"> Details Quotation Request  </header>
            <div class="card-body">
                <h2>Code Quotation Request: <span id="no_request"></span></h2>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Transportation Methode:</strong> <br> <p id="transportation_method"></p> </div>
                    </div>
                </article>
                <hr>


                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>pickup origin:</strong> <br> <p id="pickup_origin"></p></div>
                        <div class="col"> <strong>pickup destination:</strong> <br> <p id="destination_origin"></p> </div>
                    </div>
                </article>
                <hr>


                <article class="card">
                    <div class="card-body row">
                    <div class="col"> <strong>terms condition:</strong> <br> <textarea class="form-control" id="terms" cols="10" rows="5" readonly></textarea> </div>
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


<!-- Search Agent Origin Modal -->
{{-- <div class="modal modal-blur fade" id="modal-agent-searching-origin" tabindex="-1" aria-labelledby="agentSearchLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-sm">
      
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title">Search Agent Origin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <!-- Filter Section -->
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label" for="country">Country</label>
             <select name="country_origin" id="country_origin" class="form-select">
                     <option value="">-- Select Country --</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">State</label>
              <select name="state_origin" id="state_origin" class="form-select">
                     <option value="">-- Select State --</option>
            </select>
          </div>


            <div class="col-md-6">
              <label class="form-label">City</label>
              <select id="city_origin" class="form-select">
                <option value="">-- Select City --</option>
              </select>
            </div>



          <div class="col-md-6">
            <label class="form-label">Street 1</label>
              <select id="street_origin" class="form-select">
              <option value="">- Select Street -</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Zip Number</label>
            <select id="zip_origin" class="form-select">
              <option value="">-- Select Zip --</option>
            </select>
          </div>



        <div class="col-md-6">
            <label class="form-label">Tags</label>
            <select id="tags_origin" class="form-select">
              <option value="">-- Select Tags --</option>
            </select>
        </div>

        </div>

        <!-- Divider -->
        <hr class="text-muted">

        <!-- Search results -->
        <div>
          <h6 class="mb-3">Available Agents</h6>
          <div id="agent-search-results" class="row g-3"></div>
        </div>

        <!-- Selected list -->
        <div class="mt-4">
          <h6>Selected Agents</h6>
          <ul id="selected-agents-list" class="list-group small"></ul>
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button id="send-offer-btn" class="btn btn-primary" type="button">
          <i class="bi bi-envelope me-1"></i> Send Offer
        </button>
      </div>
    </div>
  </div>
</div> --}}





{{-- ---------------------------------------Batas--------------------------------------- --}}



<!-- Search Agent Destination Modal -->
<div class="modal modal-blur fade" id="modal-agent-searching-destination" tabindex="-1" aria-labelledby="agentSearchLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-sm">
      
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title">Search Agent Destination</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <!-- Filter Section -->
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label" for="country">Country</label>
             <select name="country_destination" id="country_destination" class="form-select">
                     <option value="">-- Select Country --</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">State</label>
              <select name="state_destination" id="state_destination" class="form-select">
                     <option value="">-- Select State --</option>
            </select>
          </div>


            <div class="col-md-6">
              <label class="form-label">City</label>
              <select id="city_destination" class="form-select">
                <option value="">-- Select City --</option>
              </select>
            </div>



          <div class="col-md-6">
            <label class="form-label">Street 1</label>
              <select id="street_destination" class="form-select">
              <option value="">- Select Street -</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Zip Number</label>
            <select id="zip_destination" class="form-select">
              <option value="">-- Select Zip --</option>
            </select>
          </div>



        <div class="col-md-6">
            <label class="form-label">Tags</label>
            <select id="tags_destination" class="form-select">
              <option value="">-- Select Tags --</option>
            </select>
        </div>

        </div>

        <div class="text-end mb-3">
          <button id="btn-search-agent" class="btn btn-outline-primary">
            <i class="fa fa-search"></i> Search Agent
          </button>
        </div>


        <!-- Divider -->
        <hr class="text-muted">

        <!-- Search results -->
        <div>
          <h6 class="mb-3">Available Agents</h6>
       <div class="row" id="agent-search-results-destination">
  <!-- hasil pencarian akan tampil di sini -->
     </div>
        </div>

        <!-- Selected list -->
        <div class="mt-4">
          <h6>Selected Agents</h6>
          <ul id="selected-agents-list" class="list-group small"></ul>
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button id="send-offer-btn" class="btn btn-outline-primary" type="button">
          <i class="fa fa-envelope me-1"></i> Send Offer
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Compose Email -->
<div class="modal fade" id="modal-compose" tabindex="-1" aria-labelledby="composeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-sm">
      <div class="modal-header">
        <h5 class="modal-title" id="composeLabel">Compose Email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form id="compose-form">
          <!-- Recipients -->
          <div class="mb-3">
            <label class="form-label">Recipients</label>
            <input type="text" class="form-control" id="compose-recipients" readonly>
            <div class="form-text">Selected agents will receive this email</div>
          </div>

          <!-- Subject -->
          <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" class="form-control" id="compose-subject" placeholder="Enter subject...">
          </div>

          <!-- Body -->
          <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea id="compose-body" class="form-control" rows="6" placeholder="Write your email..."></textarea>
          </div>

          <!-- Attachments (optional) -->
          <div class="mb-3">
            <label class="form-label">Attachment</label>
            <input type="file" class="form-control" id="compose-attachment" multiple>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="btn-send-email" class="btn btn-primary">Send Email</button>
      </div>
    </div>
  </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
  
  // ==== FUNGSI REUSABLE ====
  function initLocationSelectors(prefix) {
      const countrySelect = document.getElementById(`country_${prefix}`);
      const stateSelect   = document.getElementById(`state_${prefix}`);
      const citySelect    = document.getElementById(`city_${prefix}`);
      const streetSelect  = document.getElementById(`street_${prefix}`);
      const zipSelect     = document.getElementById(`zip_${prefix}`);
      const tagSelect     = document.getElementById(`tags_${prefix}`);

      // Reset awal
      if (countrySelect) countrySelect.innerHTML = `<option value="">-- Select Country --</option>`;
      if (stateSelect) stateSelect.innerHTML = `<option value="">-- Select State --</option>`;
      if (citySelect) citySelect.innerHTML = `<option value="">-- Select City --</option>`;
      if (streetSelect) streetSelect.innerHTML = `<option value="">-- Select Street --</option>`;
      if (zipSelect) zipSelect.innerHTML = `<option value="">-- Select Zip --</option>`;
      if (tagSelect) tagSelect.innerHTML = `<option value="">-- Select Tags --</option>`;

      // === Ambil Country ===
      fetch('{{ route("api.countries") }}')
          .then(res => res.json())
          .then(res => {
              if (res.success && res.data && countrySelect) {
                  res.data.forEach(c => {
                      countrySelect.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                  });
              }
          })
          .catch(err => console.error('Error fetching countries:', err));

      // === Ambil State berdasarkan Country ===
      if (countrySelect && stateSelect) {
          countrySelect.addEventListener('change', function () {
              const countryId = this.value;
              stateSelect.innerHTML = `<option value="">-- Select State --</option>`;
              if (!countryId) return;

              fetch(`/external/api/states/${countryId}`)
                  .then(res => res.json())
                  .then(res => {
                      if (res.success && Array.isArray(res.data)) {
                          res.data.forEach(state => {
                              stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                          });
                      }
                  })
                  .catch(err => console.error('Error fetching states:', err));
          });
      }

      // ===  City ===
      if (citySelect) {
          fetch('{{ route("api.city") }}')
              .then(res => res.json())
              .then(res => {
                  if (res.success && res.data) {
                      res.data.forEach(city => {
                          citySelect.innerHTML += `<option value="${city}">${city}</option>`;
                      });
                  }
              })
              .catch(err => console.error('Error fetching cities:', err));
      }

      // === Street ===
      if (streetSelect) {
          fetch('{{ route("api.city.street") }}')
              .then(res => res.json())
              .then(res => {
                  if (res.success && res.data) {
                      res.data.forEach(street => {
                          streetSelect.innerHTML += `<option value="${street}">${street}</option>`;
                      });
                  }
              })
              .catch(err => console.error('Error fetching streets:', err));
      }

      // === ZIP ===
      if (zipSelect) {
          fetch('{{ route("api.city.street.zip") }}')
              .then(res => res.json())
              .then(res => {
                  if (res.success && res.data) {
                      res.data.forEach(zip => {
                          zipSelect.innerHTML += `<option value="${zip}">${zip}</option>`;
                      });
                  }
              })
              .catch(err => console.error('Error fetching ZIPs:', err));
      }

      // === Tags ===
      if (tagSelect) {
          fetch('{{ route("api.tags.contact") }}')
              .then(res => res.json())
              .then(res => {
                  if (res.success && res.data) {
                      res.data.forEach(tag => {
                          tagSelect.innerHTML += `<option value="${tag}">${tag}</option>`;
                      });
                  }
              })
              .catch(err => console.error('Error fetching tags:', err));
      }
  }
  // call untuk Destination
  initLocationSelectors("destination");
  // call untuk origin
  initLocationSelectors("origin");

});


</script>






<script>
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('btn-search-agent').addEventListener('click', function () {
    const filters = {
      country: document.getElementById('country_destination')?.value || '',
      state: document.getElementById('state_destination')?.value || '',
      city: document.getElementById('city_destination')?.value || '',
      street: document.getElementById('street_destination')?.value || '',
      zip: document.getElementById('zip_destination')?.value || '',
      tags: document.getElementById('tags_destination')?.value || '',
    };

    fetch('{{ route("api.agent.contact.search") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify(filters)
    })
    .then(res => res.json())
    .then(res => {
      const resultsContainer = document.getElementById('agent-search-results-destination');
      if (!resultsContainer) {
        console.warn('❗ Elemen hasil pencarian tidak ditemukan');
        return;
      }

      console.log('Hasil dari API:', res);
      resultsContainer.innerHTML = '';

      if (res.success && Array.isArray(res.data) && res.data.length > 0) {
        res.data.forEach(agent => {
          resultsContainer.innerHTML += `
            <div class="col-md-6 mb-3">
              <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                  <h6 class="fw-bold text-primary mb-1">${agent.name ?? '-'}</h6>
                  <div class="small text-muted mb-1">📍 ${agent.city ?? '-'}, ${agent.street ?? '-'}</div>
                  <div class="small text-muted mb-1">ZIP: ${agent.zip ?? '-'}</div>
                  <div class="small mb-2"><span class="badge bg-success">${agent.company_type ?? '-'}</span></div>
                  <div class="small">📧 ${agent.email ?? '-'}<br>☎️ ${agent.phone ?? '-'}</div>
                </div>
              </div>
            </div>`;
        });
      } else {
        resultsContainer.innerHTML = '<div class="text-muted text-center py-3"><em>No agents found.</em></div>';
      }
    })
    .catch(err => console.error('Error searching agents:', err));
  });
});

</script>


















@endsection
		
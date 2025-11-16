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
        <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
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
                        <th>Code Quote</th>
                        <th>Date Request</th>
                        <th>Data Costumer</th>
                        <th>Trasportation <br> Method</th>
                        <th>Data Quotation</th>
                        <th>Pickup</th>
                        <th>Destination</th>
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


{{-- modal data request qoutation --}}
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
                        <div class="col"> <strong>Commodity:</strong> <br> <p id="commodity"></p></div>
                        <div class="col"> <strong>Unit of Measure (UOM):</strong> <br> <p id="uom"></p> </div>
                        <div class="col"> <strong>Ratio:</strong> <br> <p id="ratio"></p> </div>
                    </div>
                </article>
                <hr>

             <article class="card">
                    <div class="card-body row">
                        <div class="col">
                            <strong>Chargeable Weight (kg):</strong><br>
                            <p id="chargeable_weight"></p>
                        </div>

                        <div class="col">
                            <strong>Gross Weight (kg):</strong><br>
                            <p id="gross_weight"></p>
                        </div>

                        <div class="col">
                            <strong>Package Qty:</strong><br>
                            <p id="package_qty"></p>
                        </div>
                    </div>
                </article>
                <hr>



                <article class="card">
                    <div class="card-body row">
                    <div class="col"> <strong>other notes:</strong> <br> <textarea class="form-control" id="terms" cols="10" rows="5" readonly></textarea> </div>
                    </div>
                </article>
                <hr>

                 <article class="card" hidden>
                    <div class="card-body row">
                    <div class="col"> <strong>terms condition for pickup mail:</strong> <br> <textarea class="form-control" id="termsPick" cols="10" rows="5" readonly></textarea> </div>
                    </div>
                </article>

                <article class="card" hidden>
                    <div class="card-body row">
                    <div class="col"> <strong>terms condition for destination mail:</strong> <br> <textarea class="form-control" id="termsDest" cols="10" rows="5" readonly></textarea> </div>
                    </div>
                </article>

               
             
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


{{-- modal Search Data Pickup contact --}}
<div class="modal fade" id="modal-pickup-agent" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-primary">Page Search Agent Pickup  <i class="fa-solid fa-box-open"></i></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <h6 class="text-danger">data request pickup</h6>
        <article class="card">
          <div class="card-body row">
            <div class="col"> <strong>No Request:</strong> <br> <p id="code_req"></p> </div>
            <div class="col"> <strong>Methode Transportation:</strong> <br> <p id="tm"></p> </div>
            <div class="col"> <strong>Pickup Origin:</strong> <br> <p id="pickup_origin_s"></p> </div>
          </div>
        </article>

        <hr>
        <h6 class="text-danger">search for contacts based on available parameters</h6>
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Country</label>
            <select id="country_destination" class="form-select">
              <option value="">Select Country</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">State</label>
            <select id="state_destination" class="form-select">
              <option value="">Select State</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">City</label>
            <select id="city_destination" class="form-select">
              <option value="">Select City</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Tags</label>
            <select id="tags_destination" class="form-select">
              <option value="">Select Tags</option>
            </select>
          </div>
        </div>

        <div class="text-end mb-3">
          <button id="btn-reset-agent" class="btn btn-outline-secondary me-2">
            <i class="fa fa-rotate-left"></i> Reset
          </button>
          <button id="btn-search-agent" class="btn btn-outline-primary" disabled>
            <i class="fa fa-search"></i> Search Agent
          </button>
        </div>

        <div>
          <h6 class="text-danger">Available Agents</h6>
          <div class="row" id="agent-search-results-destination"></div>
        </div>

        <hr>

        <div class="mt-4">
          <h6 class="text-danger">Selected Agents</h6>
          <ul id="selectedList" class="list-group small"></ul>
        </div>

      </div>

      
    </div>
  </div>
</div>



{{-- modal kirim email pickup --}}
<div class="modal fade" id="modalSendEmail" tabindex="-1" aria-labelledby="modalSendEmailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalSendEmailLabel">
          <i class="fa fa-envelope"></i> Send Offer Email to Agent Pickup
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

       
          <!-- Selected Contacts -->
          <div class="mb-3">
            <label class="form-label fw-bold">To <small class="text-danger">(***)</small></label>
            <div id="emailSelectedList" class="d-flex flex-wrap gap-2"></div>
          </div>

          <!-- CC -->
          <div class="mb-3">
            <label class="form-label fw-bold">Cc <small class="text-danger">(optional)</small></label>
            <div id="ccSelectedList" class="d-flex flex-wrap gap-2"></div>
            <input 
              type="text" 
              id="ccInput" 
              class="form-control mt-2" 
              placeholder="Add CC email and press Enter" 
            />
          </div>

          

          <!-- Subject -->
          <div class="mb-3">
            <label for="emailSubject" class="form-label fw-bold">Subject <small class="text-danger">(***)</small></label>
            <input 
              type="text" 
              class="form-control" 
              id="emailSubject" 
              placeholder="Enter subject"
            />
          </div>

          <!-- Message -->
          <div class="mb-3">
            <label for="emailMessage" class="form-label fw-bold">Message <small class="text-danger">(***)</small></label>
            <textarea 
              id="emailMessage" 
              class="form-control" 
              rows="6" 
              placeholder="Write your message..."
            ></textarea>
          </div>

          <!-- Attachment -->
          <div class="mb-3">
            <label for="emailAttachment" class="form-label fw-bold">Attachment <small class="text-danger">(optional | Max Size File 10MB | Pdf)</small></label>
            <input type="file" class="form-control" id="emailAttachment"  accept=".pdf">
          </div>
        </div>


          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fa fa-times"></i> Cancel
            </button>
            <button class="btn btn-danger" id="btnSendEmailNow">
              <i class="fa fa-paper-plane"></i> Send Email
            </button>
          </div>
    </div>
  </div>
</div>

{{-- ------------------------------------------------------------- --}}

{{-- modal Search Data Destination contact --}}
<div class="modal fade" id="modal-destination-agent" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-warning">Page Search Agent Destination <i class="fa-solid fa-warehouse"></i></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <h6 class="text-danger">data request destination</h6>
        <article class="card">
          <div class="card-body row">
            <div class="col"> <strong>No Request:</strong> <br> <p id="code_req_destination"></p> </div>
            <div class="col"> <strong>Methode Transportation:</strong> <br> <p id="dm"></p> </div>
            <div class="col"> <strong>Destination Origin:</strong> <br> <p id="destination_origin_s"></p> </div>
          </div>
        </article>

        <hr>
        <h6 class="text-danger">search for contacts based on available parameters</h6>
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Country</label>
            <select id="country_destination_contact" class="form-select">
              <option value="">Select Country</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">State</label>
            <select id="state_destination_contact" class="form-select">
              <option value="">Select State</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">City</label>
            <select id="city_destination_contact" class="form-select">
              <option value="">Select City</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Tags</label>
            <select id="tags_destination_contact" class="form-select">
              <option value="">Select Tags</option>
            </select>
          </div>
        </div>

        <div class="text-end mb-3">
          <button id="btn-reset-agent-destination" class="btn btn-outline-secondary me-2">
            <i class="fa fa-rotate-left"></i> Reset
          </button>
          <button id="btn-search-agent-destination" class="btn btn-outline-primary" disabled>
            <i class="fa fa-search"></i> Search Agent
          </button>
        </div>

        <div>
          <h6 class="text-danger">Available Agents</h6>
          <div class="row" id="agent-search-results-destination-contact"></div>
        </div>

        <hr>

        <div class="mt-4">
          <h6 class="text-danger">Selected Agents</h6>
          <ul id="selectedListContact" class="list-group small"></ul>
        </div>

      </div>

      
    </div>
  </div>
</div>



{{-- modal kirim email destination --}}
<div class="modal fade" id="modalSendEmailDestination" tabindex="-1" aria-labelledby="modalSendEmailDestinationLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalSendEmailDestinationLabel">
          <i class="fa fa-envelope"></i> Send Offer Email to Agent Destination
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <!-- Selected Contacts -->
        <div class="mb-3">
          <label class="form-label fw-bold">To <small class="text-danger">(***)</small></label>
          <div id="emailSelectedListDestination" class="d-flex flex-wrap gap-2 p-2 border rounded bg-light-subtle"></div>
        </div>

        <!-- CC -->
        <div class="mb-3">
          <label class="form-label fw-bold">Cc <small class="text-danger">(optional)</small></label>
          <div id="ccSelectedListDestination" class="d-flex flex-wrap gap-2"></div>
          <input type="text" id="ccInputDestination" class="form-control mt-2" placeholder="Add CC email and press Enter">
        </div>

        <!-- Subject -->
        <div class="mb-3">
          <label for="emailSubject" class="form-label fw-bold">Subject <small class="text-danger">(***)</small></label>
          <input type="text" class="form-control" id="emailSubjectDestination" placeholder="Enter subject">
        </div>

        <!-- Message -->
        <div class="mb-3">
          <label for="emailMessage" class="form-label fw-bold">Message <small class="text-danger">(***)</small></label>
          <textarea id="emailMessageDestination" class="form-control" rows="6" placeholder="Write your message..."></textarea>
        </div>

        <!-- Attachment -->
        <div class="mb-3">
          <label for="emailAttachment" class="form-label fw-bold">Attachment <small class="text-danger">(optional | Max Size File 10MB | PDF)</small></label>
          <input type="file" class="form-control" id="emailAttachmentDestination" accept=".pdf">
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fa fa-times"></i> Cancel
        </button>
        <button class="btn btn-danger" id="btnSendEmailDestinationNow">
          <i class="fa fa-paper-plane"></i> Send Email
        </button>
      </div>
    </div>
  </div>
</div>



{{-- code js untuk Destination --}}
<script>
  //  start code logic untuk Destination 
document.addEventListener("DOMContentLoaded", () => {
  const countrySelectContact = document.getElementById("country_destination_contact");
  const stateSelectContact = document.getElementById("state_destination_contact");
  const citySelectContact = document.getElementById("city_destination_contact");
  const tagsSelectContact = document.getElementById("tags_destination_contact");
  const btnSearchContact = document.getElementById("btn-search-agent-destination");
  const resultsContainerContact = document.getElementById("agent-search-results-destination-contact");
  const selectedListContact = document.getElementById("selectedListContact");


  // --- Tombol Reset Destination---
  let btnResetDestination = document.getElementById("btn-reset-agent-destination");
  if (!btnResetDestination) {
    btnResetDestination = document.createElement("button");
    btnResetDestination.className = "btn btn-outline-danger ms-2";
    btnResetDestination.id = "btn-reset-agent-destination";
    btnResetDestination.innerHTML = `<i class="fa fa-rotate-left"></i> Reset`;
    btnSearchContact.parentElement.appendChild(btnResetDestination);
  }

  // === Fungsi tombol Reset Destination ===
btnResetDestination.addEventListener("click", () => {
  // Kosongkan semua dropdown
  countrySelectContact.value = "";
  stateSelectContact.innerHTML = `<option value="">Select State</option>`;
  citySelectContact.innerHTML = `<option value="">Select City</option>`;
  tagsSelectContact.value = "";

  // Kosongkan hasil dan pilihan
  resultsContainerContact.innerHTML = "";
  selectedListContact.innerHTML = "";
  selectedAgentsDestination.clear();

  // Nonaktifkan tombol Search
  btnSearchContact.disabled = true;

  Swal.fire({
    icon: "info",
    title: "Form Reset!",
    text: "All filters and selected agents have been cleared.",
    timer: 2000,
    showConfirmButton: false
  });
});


  let allContactsDestination = [];
  const selectedAgentsDestination = new Set();

  let filteredResultsDestination = [];
  let currentPageDestination = 1;
  const itemsPerPageDestination = 6;

  // === Fetch Data Agent ===
  fetch("/api/contacts")
    .then(res => res.json())
    .then(data => {
      allContactsDestination = data.data || [];
      
      // country
      const countriesContact = [...new Set(allContactsDestination.flatMap(c => c.countries?.map(ct => ct.country_name) || []))];
      countriesContact.forEach(c => countrySelectContact.innerHTML += `<option value="${c}">${c}</option>`);
      console.log(countriesContact);

      // tags
      const allTagsContact = [...new Set(allContactsDestination.flatMap(c => c.tags?.map(t => t.tag_name) || []))];
      allTagsContact.forEach(tag => {
        tagsSelectContact.innerHTML += `<option value="${tag}">${tag}</option>`;
      });
    })
    .catch(err => console.error("Error fetching contacts:", err));

  // === Filter dropdown chain ===
  countrySelectContact.addEventListener("change", () => {
    const selectedCountry = countrySelectContact.value;
    const filtered = allContactsDestination.filter(c => c.countries?.some(ct => ct.country_name === selectedCountry));
    const states = [...new Set(filtered.flatMap(c => c.states?.map(s => s.state_name) || []))];
    stateSelectContact.innerHTML = `<option value=""> Select State </option>`;
    states.forEach(s => stateSelectContact.innerHTML += `<option value="${s}">${s}</option>`);
    citySelectContact.innerHTML = `<option value=""> Select City </option>`;
    updateSearchButton();
  });

  stateSelectContact.addEventListener("change", () => {
    const selectedState = stateSelectContact.value;
    const filtered = allContactsDestination.filter(c => c.states?.some(s => s.state_name === selectedState));
    const cities = [...new Set(filtered.map(c => c.city).filter(Boolean))];
    citySelectContact.innerHTML = `<option value=""> Select City </option>`;
    cities.forEach(c => citySelectContact.innerHTML += `<option value="${c}">${c}</option>`);
    updateSearchButton();
  });

  [citySelectContact, tagsSelectContact].forEach(sel => sel.addEventListener("change", updateSearchButton));

  function updateSearchButton() {
    const anySelected = countrySelectContact.value || stateSelectContact.value || citySelectContact.value || tagsSelectContact.value;
    btnSearchContact.disabled = !anySelected;
  }

  // === Tombol Search  Destination===
  btnSearchContact.addEventListener("click", () => {
    const countryContact = countrySelectContact.value;
    const stateContact = stateSelectContact.value;
    const cityContact = citySelectContact.value;
    const tag = tagsSelectContact.value;

    filteredResults = allContactsDestination.filter(c =>
      (!countryContact || c.countries?.some(ct => ct.country_name === countryContact)) &&
      (!stateContact || c.states?.some(s => s.state_name === stateContact)) &&
      (!cityContact || c.city === cityContact) &&
      (!tag || c.tags?.some(t => t.tag_name === tag))
    );

    currentPage = 1;
    renderResults(filteredResults);
  });

  // === Render Hasil ===
  function renderResults(results) {
    resultsContainerContact.innerHTML = "";
    if (!results.length) {
      resultsContainerContact.innerHTML = `<div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <i class="fa-solid fa-exclamation"></i>
                                    <div>
                                      No agents found.
                                    </div>
                                  </div>`;
      document.getElementById("pagination-controls")?.remove();
      return;
    }

    const totalPages = Math.ceil(results.length / itemsPerPageDestination);
    const start = (currentPage - 1) * itemsPerPageDestination;
    const end = start + itemsPerPageDestination;
    const pageResults = results.slice(start, end);

    pageResults.forEach(agent => {
      const disabled = selectedAgentsDestination.has(agent.id) ? "disabled" : "";
      const waLink = agent.phone
        ? `<a href="https://wa.me/${agent.phone.replace(/\D/g, '')}" target="_blank" class="btn btn-sm btn-outline-success w-100 mt-1">
             <i class="fa-brands fa-whatsapp"></i> WhatsApp
           </a>` : "";

      resultsContainerContact.innerHTML += `
        <div class="col-md-6 mb-3">
          <div class="card shadow-sm">
            <div class="card-body">
              <h6>${agent.name}</h6>
              <p class="mb-1"><i class="fa fa-envelope"></i> ${agent.email ?? "-"}</p>
              <p class="mb-2"><i class="fa fa-phone"></i> ${agent.phone ?? "-"}</p>
              ${waLink}
              <button class="btn btn-sm btn-outline-primary w-100 mt-2 select-agent-btn" data-id="${agent.id}" ${disabled}>
                <i class="fa fa-plus"></i> Select
              </button>
            </div>
          </div>
        </div>`;
    });

    attachSelectButtonsDestination();
    renderPaginationControlsDestination(totalPages);
  }

    function renderPaginationControlsDestination(totalPages) {
    document.getElementById("pagination-controls")?.remove();

    if (totalPages <= 1) return;

    const pagination = document.createElement("div");
    pagination.id = "pagination-controls";
    pagination.className = "d-flex justify-content-center mt-3";
    pagination.innerHTML = `
      <button class="btn btn-sm btn-outline-secondary me-2" id="prev-page" ${currentPage === 1 ? "disabled" : ""}>
        <i class="fa fa-chevron-left"></i> Prev
      </button>
      <span class="align-self-center">Page ${currentPage} of ${totalPages}</span>
      <button class="btn btn-sm btn-outline-secondary ms-2" id="next-page" ${currentPage === totalPages ? "disabled" : ""}>
        Next <i class="fa fa-chevron-right"></i>
      </button>
    `;
    resultsContainerContact.after(pagination);

    document.getElementById("prev-page").addEventListener("click", () => {
      if (currentPage > 1) {
        currentPage--;
        renderResults(filteredResults);
      }
    });
    document.getElementById("next-page").addEventListener("click", () => {
      if (currentPage < totalPages) {
        currentPage++;
        renderResults(filteredResults);
      }
    });
  }

  function attachSelectButtonsDestination() {
    document.querySelectorAll(".select-agent-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = parseInt(btn.dataset.id);
        const agent = allContactsDestination.find(a => a.id === id);
        if (!selectedAgentsDestination.has(id)) {
          selectedAgentsDestination.add(id);
          renderSelectedDestination();
          btn.disabled = true;
        }
      });
    });
  }


    function renderSelectedDestination() {
    selectedListContact.innerHTML = "";
    selectedAgentsDestination.forEach(id => {
      const agent = allContactsDestination.find(a => a.id === id);
      if (agent) {
        selectedListContact.innerHTML += `
          <li class="list-group-item d-flex justify-content-between align-items-center">
            ${agent.name} (${agent.email ?? "-"})
            <button class="btn btn-sm btn-danger remove-agent-btn" data-id="${id}">
              <i class="fa fa-trash"></i>
            </button>
          </li>`;
      }
    });
    attachRemoveButtonsDestination();
    updateSendEmailButtonDestination();
  }

  function attachRemoveButtonsDestination() {
    document.querySelectorAll(".remove-agent-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = parseInt(btn.dataset.id);
        selectedAgentsDestination.delete(id);
        renderSelectedDestination();
        renderResults(filteredResults);
      });
    });
  }

  
  
// start code tombol send email destination
  // --- Fungsi untuk Menghapus Email Kontak di Modal Email ---
function attachRemoveEmailContactButtons() {
    document.querySelectorAll(".remove-email-contact").forEach(btn => {
        btn.addEventListener("click", () => {
            const agentId = parseInt(btn.dataset.id);
            selectedAgentsDestination.delete(agentId);
            btn.closest(".email-chip").remove();
            renderSelectedDestination();
            renderResults(filteredResults);
        });
    });
}


// --- Kode untuk Menghilangkan Backdrop Sisa Saat Modal Send Email Ditutup ---
const modalSendEmailEl = document.getElementById('modalSendEmailDestination');
modalSendEmailEl.addEventListener('hidden.bs.modal', function () {
    const openModals = document.querySelectorAll('.modal.show');
    if (openModals.length === 0) {
        document.body.classList.remove('modal-open'); 
        document.querySelector('.modal-backdrop')?.remove(); 
    }

    // Optional: Pastikan modal pertama (modal-destination-agent) dibuka kembali
    // agar user bisa memilih agen lagi, jika mereka hanya menutup modal email
    const destinationAgentModalInstance = bootstrap.Modal.getInstance(document.getElementById("modal-destination-agent"));
    if (destinationAgentModalInstance) {
         destinationAgentModalInstance.show();
    }
});


  //  Tombol Send Email 
  const btnSendOfferDestination = document.createElement("button");
  btnSendOfferDestination.className = "btn btn-primary mt-3 w-100";
  btnSendOfferDestination.id = "btn-open-send-email-destination";
  btnSendOfferDestination.innerHTML = `<i class="fa fa-paper-plane"></i> Send Offer Email To Agent Destination`;
  btnSendOfferDestination.disabled = true;
  document.getElementById("selectedListContact").after(btnSendOfferDestination);

  function updateSendEmailButtonDestination() {
    btnSendOfferDestination.disabled = selectedAgentsDestination.size === 0;
  }

  btnSendOfferDestination.addEventListener("click", () => {
    if (selectedAgentsDestination.size === 0) return;
    const openModalEl = document.querySelector('.modal.show');
    if (openModalEl) {
      const openModal = bootstrap.Modal.getInstance(openModalEl);
      if (openModal) openModal.hide();
    }

    const emailList = document.getElementById("emailSelectedListDestination");
    emailList.innerHTML = "";

    selectedAgentsDestination.forEach(id => {
      const agent = allContactsDestination.find(a => a.id === id);
      if (agent && isValidEmail(agent.email)) {
        emailList.innerHTML += `
          <div class="email-chip d-flex align-items-center me-2 mb-2">
            <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(agent.name)}&background=random&color=fff" 
                 class="rounded-circle me-2" width="28" height="28" alt="avatar">
            <span class="me-2">${agent.email}</span>
            <button class="btn-close btn-close-white remove-email-contact" data-id="${agent.id}" aria-label="Remove"></button>
          </div>`;
      }
    });
    

     
    attachRemoveEmailContactButtons();
    const emailModal = new bootstrap.Modal(document.getElementById("modalSendEmailDestination"));
    emailModal.show();
  });

  //  Input CC dengan Validasi Email RFC 2822 
  const ccInputDestination = document.getElementById("ccInputDestination");
  const ccListDestination = document.getElementById("ccSelectedListDestination");
  const ccEmailsDestination = new Set();

  function isValidEmail(email) {
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/;
    return re.test(email);
  }


  ccInputDestination.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    e.preventDefault();
    let email = e.target.value.trim();

    // Hapus tanda kurung siku atau kutip di awal/akhir
    email = email.replace(/^[\[\]"']+|[\[\]"']+$/g, "").trim();

    // Cek jika email valid
    if (!isValidEmail(email)) {
        Swal.fire({
          icon: "error",
          title: "Invalid Email",
          text: `Email format is not valid: ${email}`,
          confirmButtonText: "OK",
        });
        e.target.value = "";
        return;
      }

    if (email && !ccEmailsDestination.has(email)) {
      ccEmailsDestination.add(email);
      const chip = document.createElement("div");
      chip.className = "email-chip";
      chip.innerHTML = `
        <div class="avatar">${email[0].toUpperCase()}</div>
        <span>${email}</span>
        <button class="remove-btn" aria-label="Remove">
          <i class="fa fa-times"></i>
        </button>
      `;
      chip.querySelector(".remove-btn").addEventListener("click", () => {
        ccEmailsDestination.delete(email);
        chip.remove();
      });
      ccListDestination.appendChild(chip);
      e.target.value = "";
    }
  }
});


  // logic kirim email
  document.getElementById("btnSendEmailDestinationNow").addEventListener("click", async () => {
    const subject = document.getElementById("emailSubjectDestination").value.trim();
    const message = document.getElementById("emailMessageDestination").value.trim();
    const attachmentInput = document.getElementById("emailAttachmentDestination");
      if (!subject || !message) {
          Swal.fire({
          icon: "warning",
          title: "Oops...",
          text: "Please fill subject and message before sending!",
          confirmButtonText: "OK",
        });
        return;
      }

    if (selectedAgentsDestination.size === 0) {
 
      Swal.fire({
          icon: "warning",
          title: "Oops...",
          text: "Please select at least one contact.!",
          confirmButtonText: "OK",
        });
      return;
    }

    // Pastikan semua email valid
    const contactsToSend = Array.from(selectedAgentsDestination)
      .map(id => allContactsDestination.find(c => c.id === id))
      .filter(a => a && isValidEmail(a.email))
      .map(a => ({ name: a.name, email: a.email }));

    if (!contactsToSend.length) {
      // alert("No valid email addresses to send.");
      Swal.fire({
          icon: "warning",
          title: "Oops...",
          text: "No valid email addresses to send.!",
          confirmButtonText: "OK",
        });
      return;
    }

    const formData = new FormData();
    formData.append("subject", subject);
    formData.append("message", message);
    formData.append("cc", JSON.stringify([...ccEmailsDestination]));
    formData.append("contacts", JSON.stringify(contactsToSend));

    if (attachmentInput.files.length > 0) {
      formData.append("attachment", attachmentInput.files[0]);
    }

    //  TAMPILKAN SWEETALERT LOADING
    Swal.fire({
        title: 'Sending Email...',
        text: 'Please wait, this may take a moment.',
        icon: 'info',
        allowOutsideClick: false, // Memblokir interaksi user lain
        didOpen: () => {
            Swal.showLoading(); // Menampilkan spinner
        }
    });

    try {
      const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      const response = await fetch("/api/send-offer-email-destination", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": token || "" },
        body: formData,
      });

      const result = await response.json();
       Swal.close(); 
     
      if (response.ok && result.success) {
        Swal.fire({
          title: "Success!",
          text: "The offer email was sent successfully.",
          icon: "success",
          confirmButtonText: "OK",
          timer: 2500 // Opsi: menutup otomatis setelah 2.5 detik
          }).then(() => {
            
            // Sembunyikan modal kedua (modalSendEmailDestination)
            bootstrap.Modal.getInstance(document.getElementById("modalSendEmailDestination")).hide();

            // Sembunyikan modal pertama modal-destination-agent)
            const destinationAgentModalElement = document.getElementById("modal-destination-agent");
            const destinationAgentModalInstance = bootstrap.Modal.getInstance(destinationAgentModalElement);
            if (destinationAgentModalInstance) {
                destinationAgentModalInstance.hide();
            }

            // Hapus paksa backdrop yang tersisa
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();

            document.getElementById("emailSubjectDestination").value = "";
            document.getElementById("emailMessageDestination").value = "";
            document.getElementById("emailAttachmentDestination").value = "";
            ccEmailsDestination.clear();
            ccListDestination.innerHTML = "";
            });
      } else {
        Swal.fire({
        title: "Error!",
        text: result.message || "Failed to send email. Please check the server log.",
        icon: "error",
        confirmButtonText: "Tutup"
        });
      }
    } catch (error) {
      console.error("Error sending email:", error);
      Swal.fire({
      title: "Connection Error!",
      text: "An error occurred while sending the request to the server.",
      icon: "warning",
      confirmButtonText: "OK"
      });
    }
  });

  });
</script>



{{-- batas --}}




























{{-- code js --}}
<script>
  //  start code logic untuk pickup  
document.addEventListener("DOMContentLoaded", () => {
  const countrySelect = document.getElementById("country_destination");
  const stateSelect = document.getElementById("state_destination");
  const citySelect = document.getElementById("city_destination");
  const tagsSelect = document.getElementById("tags_destination");
  const btnSearch = document.getElementById("btn-search-agent");
  const resultsContainer = document.getElementById("agent-search-results-destination");
  const selectedList = document.getElementById("selectedList");

  // --- Tombol Reset ---
  let btnReset = document.getElementById("btn-reset-agent");
  if (!btnReset) {
    btnReset = document.createElement("button");
    btnReset.className = "btn btn-outline-danger ms-2";
    btnReset.id = "btn-reset-agent";
    btnReset.innerHTML = `<i class="fa fa-rotate-left"></i> Reset`;
    btnSearch.parentElement.appendChild(btnReset);
  }



  let allContacts = [];
  const selectedAgents = new Set();

  let filteredResults = [];
  let currentPage = 1;
  const itemsPerPage = 6;

  // === Fetch Data Agent ===
  fetch("http://127.0.0.1:8000/api/contacts")
    .then(res => res.json())
    .then(data => {
      allContacts = data.data || [];

      // country
      const countries = [...new Set(allContacts.flatMap(c => c.countries?.map(ct => ct.country_name) || []))];
      countries.forEach(c => countrySelect.innerHTML += `<option value="${c}">${c}</option>`);

      // tags
      const allTags = [...new Set(allContacts.flatMap(c => c.tags?.map(t => t.tag_name) || []))];
      allTags.forEach(tag => {
        tagsSelect.innerHTML += `<option value="${tag}">${tag}</option>`;
      });
    })
    .catch(err => console.error("Error fetching contacts:", err));

  // === Filter dropdown chain ===
  countrySelect.addEventListener("change", () => {
    const selectedCountry = countrySelect.value;
    const filtered = allContacts.filter(c => c.countries?.some(ct => ct.country_name === selectedCountry));
    const states = [...new Set(filtered.flatMap(c => c.states?.map(s => s.state_name) || []))];
    stateSelect.innerHTML = `<option value=""> Select State </option>`;
    states.forEach(s => stateSelect.innerHTML += `<option value="${s}">${s}</option>`);
    citySelect.innerHTML = `<option value=""> Select City </option>`;
    updateSearchButton();
  });

  stateSelect.addEventListener("change", () => {
    const selectedState = stateSelect.value;
    const filtered = allContacts.filter(c => c.states?.some(s => s.state_name === selectedState));
    const cities = [...new Set(filtered.map(c => c.city).filter(Boolean))];
    citySelect.innerHTML = `<option value="">-- Select City --</option>`;
    cities.forEach(c => citySelect.innerHTML += `<option value="${c}">${c}</option>`);
    updateSearchButton();
  });

  [citySelect, tagsSelect].forEach(sel => sel.addEventListener("change", updateSearchButton));

  function updateSearchButton() {
    const anySelected = countrySelect.value || stateSelect.value || citySelect.value || tagsSelect.value;
    btnSearch.disabled = !anySelected;
  }

  // === Tombol Search ===
  btnSearch.addEventListener("click", () => {
    const country = countrySelect.value;
    const state = stateSelect.value;
    const city = citySelect.value;
    const tag = tagsSelect.value;

    filteredResults = allContacts.filter(c =>
      (!country || c.countries?.some(ct => ct.country_name === country)) &&
      (!state || c.states?.some(s => s.state_name === state)) &&
      (!city || c.city === city) &&
      (!tag || c.tags?.some(t => t.tag_name === tag))
    );

    currentPage = 1;
    renderResults(filteredResults);
  });

  // === Render Hasil ===
  function renderResults(results) {
    resultsContainer.innerHTML = "";
    if (!results.length) {
      resultsContainer.innerHTML = `<div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <i class="fa-solid fa-exclamation"></i>
                                    <div>
                                      No agents found.
                                    </div>
                                  </div>`;
      document.getElementById("pagination-controls")?.remove();
      return;
    }

    const totalPages = Math.ceil(results.length / itemsPerPage);
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const pageResults = results.slice(start, end);

    pageResults.forEach(agent => {
      const disabled = selectedAgents.has(agent.id) ? "disabled" : "";
      const waLink = agent.phone
        ? `<a href="https://wa.me/${agent.phone.replace(/\D/g, '')}" target="_blank" class="btn btn-sm btn-outline-success w-100 mt-1">
             <i class="fa-brands fa-whatsapp"></i> WhatsApp
           </a>` : "";

      resultsContainer.innerHTML += `
        <div class="col-md-6 mb-3">
          <div class="card shadow-sm">
            <div class="card-body">
              <h6>${agent.name}</h6>
              <p class="mb-1"><i class="fa fa-envelope"></i> ${agent.email ?? "-"}</p>
              <p class="mb-2"><i class="fa fa-phone"></i> ${agent.phone ?? "-"}</p>
              ${waLink}
              <button class="btn btn-sm btn-outline-primary w-100 mt-2 select-agent-btn" data-id="${agent.id}" ${disabled}>
                <i class="fa fa-plus"></i> Select
              </button>
            </div>
          </div>
        </div>`;
    });

    attachSelectButtons();
    renderPaginationControls(totalPages);
  }

  function renderPaginationControls(totalPages) {
    document.getElementById("pagination-controls")?.remove();

    if (totalPages <= 1) return;

    const pagination = document.createElement("div");
    pagination.id = "pagination-controls";
    pagination.className = "d-flex justify-content-center mt-3";
    pagination.innerHTML = `
      <button class="btn btn-sm btn-outline-secondary me-2" id="prev-page" ${currentPage === 1 ? "disabled" : ""}>
        <i class="fa fa-chevron-left"></i> Prev
      </button>
      <span class="align-self-center">Page ${currentPage} of ${totalPages}</span>
      <button class="btn btn-sm btn-outline-secondary ms-2" id="next-page" ${currentPage === totalPages ? "disabled" : ""}>
        Next <i class="fa fa-chevron-right"></i>
      </button>
    `;
    resultsContainer.after(pagination);

    document.getElementById("prev-page").addEventListener("click", () => {
      if (currentPage > 1) {
        currentPage--;
        renderResults(filteredResults);
      }
    });
    document.getElementById("next-page").addEventListener("click", () => {
      if (currentPage < totalPages) {
        currentPage++;
        renderResults(filteredResults);
      }
    });
  }

  function attachSelectButtons() {
    document.querySelectorAll(".select-agent-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = parseInt(btn.dataset.id);
        const agent = allContacts.find(a => a.id === id);
        if (!selectedAgents.has(id)) {
          selectedAgents.add(id);
          renderSelected();
          btn.disabled = true;
        }
      });
    });
  }

  function renderSelected() {
    selectedList.innerHTML = "";
    selectedAgents.forEach(id => {
      const agent = allContacts.find(a => a.id === id);
      if (agent) {
        selectedList.innerHTML += `
          <li class="list-group-item d-flex justify-content-between align-items-center">
            ${agent.name} (${agent.email ?? "-"})
            <button class="btn btn-sm btn-danger remove-agent-btn" data-id="${id}">
              <i class="fa fa-trash"></i>
            </button>
          </li>`;
      }
    });
    attachRemoveButtons();
    updateSendEmailButton();
  }

  function attachRemoveButtons() {
    document.querySelectorAll(".remove-agent-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = parseInt(btn.dataset.id);
        selectedAgents.delete(id);
        renderSelected();
        renderResults(filteredResults);
      });
    });
  }


  // --- Fungsi untuk Menghapus Email Kontak di Modal Email ---
function attachRemoveEmailContactButtons() {
    document.querySelectorAll(".remove-email-contact").forEach(btn => {
        btn.addEventListener("click", () => {
            const agentId = parseInt(btn.dataset.id);
            selectedAgents.delete(agentId);
            btn.closest(".email-chip").remove();
            renderSelected();
            renderResults(filteredResults);
        });
    });
}


// --- Kode untuk Menghilangkan Backdrop Sisa Saat Modal Send Email Ditutup ---
const modalSendEmailEl = document.getElementById('modalSendEmail');
modalSendEmailEl.addEventListener('hidden.bs.modal', function () {
    const openModals = document.querySelectorAll('.modal.show');
    if (openModals.length === 0) {
        document.body.classList.remove('modal-open'); 
        document.querySelector('.modal-backdrop')?.remove(); 
    }

    // Optional: Pastikan modal pertama (modal-pickup-agent) dibuka kembali
    // agar user bisa memilih agen lagi, jika mereka hanya menutup modal email
    const pickupAgentModalInstance = bootstrap.Modal.getInstance(document.getElementById("modal-pickup-agent"));
    if (pickupAgentModalInstance) {
         pickupAgentModalInstance.show();
    }
});

  btnReset.addEventListener("click", () => {
    countrySelect.value = "";
    stateSelect.innerHTML = `<option value="">-- Select State --</option>`;
    citySelect.innerHTML = `<option value="">-- Select City --</option>`;
    tagsSelect.value = "";
    selectedAgents.clear();
    filteredResults = [];
    resultsContainer.innerHTML = "";
    selectedList.innerHTML = "";
    btnSearch.disabled = true;
    document.getElementById("pagination-controls")?.remove();
  });

  //  Tombol Send Email 
  const btnSendOffer = document.createElement("button");
  btnSendOffer.className = "btn btn-primary mt-3 w-100";
  btnSendOffer.id = "btn-open-send-email";
  btnSendOffer.innerHTML = `<i class="fa fa-paper-plane"></i> Send Offer Email To Agent Pickup`;
  btnSendOffer.disabled = true;
  document.getElementById("selectedList").after(btnSendOffer);

  function updateSendEmailButton() {
    btnSendOffer.disabled = selectedAgents.size === 0;
  }

  btnSendOffer.addEventListener("click", () => {
    if (selectedAgents.size === 0) return;
    const openModalEl = document.querySelector('.modal.show');
    if (openModalEl) {
      const openModal = bootstrap.Modal.getInstance(openModalEl);
      if (openModal) openModal.hide();
    }

    const emailList = document.getElementById("emailSelectedList");
    emailList.innerHTML = "";

    selectedAgents.forEach(id => {
      const agent = allContacts.find(a => a.id === id);
      if (agent && isValidEmail(agent.email)) {
        emailList.innerHTML += `
          <div class="email-chip d-flex align-items-center me-2 mb-2">
            <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(agent.name)}&background=random&color=fff" 
                 class="rounded-circle me-2" width="28" height="28" alt="avatar">
            <span class="me-2">${agent.email}</span>
            <button class="btn-close btn-close-white remove-email-contact" data-id="${agent.id}" aria-label="Remove"></button>
          </div>`;
      }
    });
    

     
    attachRemoveEmailContactButtons();
    const emailModal = new bootstrap.Modal(document.getElementById("modalSendEmail"));
    emailModal.show();
  });

  //  Input CC dengan Validasi Email RFC 2822 
  const ccInput = document.getElementById("ccInput");
  const ccList = document.getElementById("ccSelectedList");
  const ccEmails = new Set();

  function isValidEmail(email) {
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/;
    return re.test(email);
  }


  ccInput.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    e.preventDefault();
    let email = e.target.value.trim();

    // Hapus tanda kurung siku atau kutip di awal/akhir
    email = email.replace(/^[\[\]"']+|[\[\]"']+$/g, "").trim();

    // Cek jika email valid
    if (!isValidEmail(email)) {
        Swal.fire({
          icon: "error",
          title: "Invalid Email",
          text: `Email format is not valid: ${email}`,
          confirmButtonText: "OK",
        });
        e.target.value = "";
        return;
      }

    if (email && !ccEmails.has(email)) {
      ccEmails.add(email);
      const chip = document.createElement("div");
      chip.className = "email-chip";
      chip.innerHTML = `
        <div class="avatar">${email[0].toUpperCase()}</div>
        <span>${email}</span>
        <button class="remove-btn" aria-label="Remove">
          <i class="fa fa-times"></i>
        </button>
      `;
      chip.querySelector(".remove-btn").addEventListener("click", () => {
        ccEmails.delete(email);
        chip.remove();
      });
      ccList.appendChild(chip);
      e.target.value = "";
    }
  }
});


  // logic kirim email
  document.getElementById("btnSendEmailNow").addEventListener("click", async () => {
    const subject = document.getElementById("emailSubject").value.trim();
    const message = document.getElementById("emailMessage").value.trim();
    const attachmentInput = document.getElementById("emailAttachment");
      if (!subject || !message) {
          Swal.fire({
          icon: "warning",
          title: "Oops...",
          text: "Please fill subject and message before sending!",
          confirmButtonText: "OK",
        });
        return;
      }

    if (selectedAgents.size === 0) {
 
      Swal.fire({
          icon: "warning",
          title: "Oops...",
          text: "Please select at least one contact.!",
          confirmButtonText: "OK",
        });
      return;
    }

    // Pastikan semua email valid
    const contactsToSend = Array.from(selectedAgents)
      .map(id => allContacts.find(c => c.id === id))
      .filter(a => a && isValidEmail(a.email))
      .map(a => ({ name: a.name, email: a.email }));

    if (!contactsToSend.length) {
      // alert("No valid email addresses to send.");
      Swal.fire({
          icon: "warning",
          title: "Oops...",
          text: "No valid email addresses to send.!",
          confirmButtonText: "OK",
        });
      return;
    }

    const formData = new FormData();
    formData.append("subject", subject);
    formData.append("message", message);
    formData.append("cc", JSON.stringify([...ccEmails]));
    formData.append("contacts", JSON.stringify(contactsToSend));

    if (attachmentInput.files.length > 0) {
      formData.append("attachment", attachmentInput.files[0]);
    }

    //  TAMPILKAN SWEETALERT LOADING
    Swal.fire({
        title: 'Sending Email...',
        text: 'Please wait, this may take a moment.',
        icon: 'info',
        allowOutsideClick: false, // Memblokir interaksi user lain
        didOpen: () => {
            Swal.showLoading(); // Menampilkan spinner
        }
    });

    try {
      const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      const response = await fetch("/api/send-offer-email-pickup", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": token || "" },
        body: formData,
      });

      const result = await response.json();
       Swal.close(); 
      
      if (response.ok && result.success) {
        Swal.fire({
          title: "Success!",
          text: "The offer email was sent successfully.",
          icon: "success",
          confirmButtonText: "OK",
          timer: 2500 // Opsi: menutup otomatis setelah 2.5 detik
          }).then(() => {
            
            // Sembunyikan modal kedua (modalSendEmail)
            bootstrap.Modal.getInstance(document.getElementById("modalSendEmail")).hide();

            // Sembunyikan modal pertama (modal-pickup-agent)
            const pickupAgentModalElement = document.getElementById("modal-pickup-agent");
            const pickupAgentModalInstance = bootstrap.Modal.getInstance(pickupAgentModalElement);
            if (pickupAgentModalInstance) {
                pickupAgentModalInstance.hide();
            }

            // Hapus paksa backdrop yang tersisa
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();

            // Reset formulir
            document.getElementById("emailSubject").value = "";
            document.getElementById("emailMessage").value = "";
            document.getElementById("emailAttachment").value = "";
            ccEmails.clear();
            ccList.innerHTML = "";
            });
      } else {
        Swal.fire({
        title: "Error!",
        text: result.message || "Failed to send email. Please check the server log.",
        icon: "error",
        confirmButtonText: "Tutup"
        });
      }
    } catch (error) {
      console.error("Error sending email:", error);
      Swal.fire({
      title: "Connection Error!",
      text: "An error occurred while sending the request to the server.",
      icon: "warning",
      confirmButtonText: "OK"
      });
    }
  });
});
//  end code logic untuk pickup  
</script>



{{-- default inputan untuk pickup --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById('modalSendEmail');
  const messageField = document.getElementById('emailMessage');
  const subjectField = document.getElementById('emailSubject');
  const codeReq = document.getElementById('code_req');
  const fromPickup = document.getElementById('pickup_origin_s');
  // const termsPickup = document.getElementById('terms');
  const termsPickup = document.getElementById('termsPick');
  const tm = document.getElementById('tm'); 

  modal.addEventListener('shown.bs.modal', () => {
    const reqValue = codeReq.textContent.trim();
    const reqValuePickup = fromPickup.textContent.trim();
    const termsValue = termsPickup.textContent.trim();
    const tmValue = tm.textContent.trim();


    if (!subjectField.value) {
        subjectField.value = `Special Offer for Shipping Needs (Pickup Service) with No Request ${reqValue}`;
    }

    if (!messageField.value) {
      messageField.value = `Dear Pickup Partner,

We’re excited to share our latest pickup schedule and exclusive rates with you.  
Please find the attached quotation for your review.

These are the details of the pickup we offer.
No Request: ${reqValue}
Transportation Methode: ${tmValue}
Pickup Origin From: ${reqValuePickup}
Terms Condition: ${termsValue}


We look forward to your feedback and continued collaboration.

`;
    }
  });

});
</script>








{{-- default inputan untuk destination --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById('modalSendEmailDestination');
  const messageField = document.getElementById('emailMessageDestination');
  const subjectField = document.getElementById('emailSubjectDestination');
  
  const toDestination = document.getElementById('destination_origin_s');
  const codeReqDestination = document.getElementById('code_req_destination');
  const dmDestination = document.getElementById('dm');
  const termsDestination = document.getElementById('termsDest');

  modal.addEventListener('shown.bs.modal', () => {

    const reqValueToDestination = toDestination.textContent.trim();
    const reqValueCodeReqDestination = codeReqDestination.textContent.trim();
    const reqValueDmDestination = dmDestination.textContent.trim();
    const reqValueTermsDestination = termsDestination.textContent.trim();


    if (!subjectField.value) {
      
      subjectField.value = `Special Offers for Shipping Needs (Destination Services) with No Request ${reqValueCodeReqDestination}`;
    }

    if (!messageField.value) {
      messageField.value = `Dear Destination Partner,

We’re excited to share our latest shipping schedule and exclusive destination rates with you.  
Please find the attached quotation for your review.

No Request: ${reqValueCodeReqDestination}
Transportation Methode: ${reqValueDmDestination}
Pickup Origin From: ${reqValueToDestination}
Terms Condition: ${reqValueTermsDestination}


We look forward to your feedback and hope to continue our successful cooperation.

`;
    }
  });

});
</script>







<style>
  /* start Styles for email chips (pickup) */
  .email-chip {
  background-color: #0d6efd;
  color: #fff;
  border-radius: 50px;
  padding: 4px 10px;
  display: inline-flex;
  align-items: center;
  transition: background 0.2s;
}

.btn-close-white {
  filter: invert(1);
  opacity: 0.8;
  margin-left: 6px;
}
.btn-close-white:hover {
  opacity: 1;
}


#emailSelectedList {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 8px;
  width: 100%;
  justify-content: flex-start; /* rata kiri */
}

.email-chip {
  display: inline-flex;
  align-items: center;
  background-color: #0d6efd;
  color: #fff;
  border-radius: 25px;
  padding: 6px 12px;
  flex: 0 0 auto;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  transition: background 0.2s ease-in-out;
}

.email-chip:hover {
  background-color: #0b5ed7;
}

.email-chip .avatar {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background-color: #ffc107;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  color: #000;
  margin-right: 8px;
}

.email-chip span {
  overflow: hidden;
  text-overflow: ellipsis;
  font-size: 14px;
}

.email-chip .btn-close-white {
  filter: invert(1);
  opacity: 0.8;
  margin-left: 6px;
  cursor: pointer;
}

.email-chip .btn-close-white:hover {
  opacity: 1;
}


.email-chip {
  display: inline-flex;
  align-items: center;
  background: #0d6efd;
  color: #fff;
  border-radius: 50px;
  padding: 6px 10px;
  font-size: 14px;
  line-height: 1;
  max-width: 100%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  flex: 0 1 auto;
  transition: background 0.25s ease, transform 0.1s ease-in-out;
}

.email-chip:hover {
  background: #0b5ed7;
  transform: translateY(-1px);
}

.email-chip .avatar {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: #ffc107;
  color: #000;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 13px;
  margin-right: 8px;
  text-transform: uppercase;
}

.email-chip span {
  flex: 1;
  overflow: hidden;
  text-overflow: ellipsis;
}

.remove-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.2);
  border: none;
  color: white;
  border-radius: 50%;
  width: 22px;
  height: 22px;
  margin-left: 8px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.remove-btn:hover {
  background: rgba(255, 255, 255, 0.35);
  color: #fff;
  transform: scale(1.1);
}

.remove-btn i {
  font-size: 12px;
}

.ck-editor__editable_inline {
        min-height: 200px; /* lebih tinggi ke bawah */
    }
/* end Styles for email chips (pickup) */
</style>

@endsection
		
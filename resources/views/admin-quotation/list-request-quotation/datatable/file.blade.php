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



<!-- Search Agent Pickup Modal -->
<div class="modal modal-blur fade" id="modal-agent-searching-pickup" tabindex="-1" aria-labelledby="agentPickupLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-sm">
      
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title">Search Agent Pickup</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <!-- Filter Section -->
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label">Country</label>
            <select class="form-select">
              <option selected disabled>- Select -</option>
              <option>Indonesia</option>
              <option>Malaysia</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">State</label>
            <select class="form-select">
              <option selected disabled>- Select -</option>
              <option>Surabaya</option>
              <option>Penang</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Port / Airport / Other</label>
            <select class="form-select">
              <option selected disabled>- Select -</option>
              <option>Example Port A</option>
              <option>Example AirPort B</option>
            </select>
          </div>
        </div>

        <!-- Divider -->
        <hr class="text-muted">

        <!-- Search results -->
        <div>
          <h6 class="mb-3">Available Pickup Agents</h6>
          <div id="pickup-agent-search-results" class="row g-3"></div>
        </div>

        <!-- Selected list -->
        <div class="mt-4">
          <h6>Selected Pickup Agents</h6>
          <ul id="pickup-selected-agents-list" class="list-group small"></ul>
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button id="pickup-send-offer-btn" class="btn btn-primary" type="button">
          <i class="bi bi-envelope me-1"></i> Send Offer
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Compose Pickup Email -->
<div class="modal fade" id="pickup-modal-compose" tabindex="-1" aria-labelledby="pickupComposeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-sm">
      <div class="modal-header">
        <h5 class="modal-title" id="pickupComposeLabel">Compose Pickup Email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form id="pickup-compose-form">
          <!-- Recipients -->
          <div class="mb-3">
            <label class="form-label">Recipients</label>
            <input type="text" class="form-control" id="pickup-compose-recipients" readonly>
            <div class="form-text">Selected pickup agents will receive this email</div>
          </div>

          <!-- Subject -->
          <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" class="form-control" id="pickup-compose-subject" placeholder="Enter subject...">
          </div>

          <!-- Body -->
          <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea id="pickup-compose-body" class="form-control" rows="6" placeholder="Write your email..."></textarea>
          </div>

          <!-- Attachments -->
          <div class="mb-3">
            <label class="form-label">Attachment</label>
            <input type="file" class="form-control" id="pickup-compose-attachment" multiple>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="pickup-btn-send-email" class="btn btn-primary">Send Email</button>
      </div>
    </div>
  </div>
</div>





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
          <div class="col-md-4">
            <label class="form-label" for="country">Country</label>
             <select name="country_destination" id="country_destination" class="form-select">
                     <option value="">-- SELECT COUNTRY --</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">State</label>
              <select name="state_destination" id="state_destination" class="form-select">
                     <option value="">-- SELECT STATE --</option>
            </select>
          </div>


         <div class="col-md-4">
            <label class="form-label">Select Method</label>
            <select class="form-select">
              <option selected disabled>- Select -</option>
              <option>AIR</option>
              <option>OCEAN</option>
              <option>Air & Ocean</option>
              <option>Domistic Ground Transportation</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Port</label>
            <select class="form-select">
              <option selected disabled>- Select -</option>
              <option>Pelabuhan Tanjung Priok (IDTPP)</option>
              <option>Pelabuhan Sunda Kelapa (IDJKT)</option>
              <option>Pelabuhan Kali Adem (Muara Angke / UN/LOCODE)</option>
              <option>Pelabuhan Marunda (IDMRA)</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Airport</label>
            <select class="form-select">
              <option selected disabled>- Select -</option>
              <option>Soekarno–Hatta International Airport (CGK)</option>
              <option>Halim Perdanakusuma International Airport (HLP)</option>
            </select>
          </div>

           <div class="col-md-4">
            <label class="form-label">Other</label>
            <select class="form-select">
              <option selected disabled>- Select -</option>
              <option>Inland Port</option>
              <option>Freight Terminal</option>
              <option>Logistics Hub</option>
              <option>Stasiun Bus</option>
              <option>Customs Post</option>
              <option>Marina</option>
              <option>Heliport</option>
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


{{-- ini script real ambil api  --}}
<script>

$(document).ready(function () {
    let $countryDropdown = $("#country_destination");
    let $stateDropdown = $("#state_destination");

    // Load countries di awal
    $.ajax({
        url: "/external/api/countries",
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.success) {
                response.data.forEach(function (item) {
                    $countryDropdown.append(
                        $("<option>", {
                            value: item.id,
                            text: item.name + " (" + item.code + ")"
                        })
                    );
                });
            } else {
                alert("Gagal memuat countries");
            }
        },
        error: function () {
            alert("Server error saat fetch countries");
        }
    });

    // Load states berdasarkan country
    $countryDropdown.on("change", function () {
        let countryId = $(this).val();

        $stateDropdown.empty().append('<option value="">-- SELECT STATE --</option>');

        if (countryId) {
            $.ajax({
                url: "/external/api/states/" + countryId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    console.log("STATE RESPONSE", response);

                    if (response.success && Array.isArray(response.data)) {
                        if (response.data.length === 0) {
                            $stateDropdown.append('<option value="">(No states available)</option>');
                        } else {
                            response.data.forEach(function (item) {
                                $stateDropdown.append(
                                    $("<option>", {
                                        value: item.id,
                                        text: item.name
                                    })
                                );
                            });
                        }
                    } else {
                        console.error("Format response tidak sesuai", response);
                    }
                },
                error: function (xhr) {
                    console.error("STATE ERROR", xhr.responseText);
                }
            });
        }
    });
});

</script>


{{-- ini script statis untuk desain awal --}}
{{-- <script>
(function(){
  const resultsWrap = document.getElementById('agent-search-results');
  const selectedList = document.getElementById('selected-agents-list');
  const selectedAgents = new Map(); // id -> agent object

  // contoh data mock agent
  const agents = [
    {id:1, name:'Agus Santoso', email:'agus@company.id'},
    {id:2, name:'Rina Putri', email:'rina@company.id'},
    {id:3, name:'Budi Hartono', email:'budi@company.id'}
  ];

  // render results
  function renderResults(list){
    resultsWrap.innerHTML = '';
    list.forEach(agent=>{
      const col = document.createElement('div');
      col.className = 'col-md-6';

      const card = document.createElement('div');
      card.className = 'card h-100 border shadow-sm';

      const body = document.createElement('div');
      body.className = 'card-body d-flex align-items-start';

      const checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.className = 'form-check-input me-2 mt-1';
      checkbox.checked = selectedAgents.has(agent.id);

      checkbox.addEventListener('change', ()=>{
        if(checkbox.checked){
          selectedAgents.set(agent.id, agent);
        } else {
          selectedAgents.delete(agent.id);
        }
        renderSelected();
      });

      const info = document.createElement('div');
      info.innerHTML = `<div class="fw-semibold">${agent.name}</div><small class="text-muted">${agent.email}</small>`;

      body.appendChild(checkbox);
      body.appendChild(info);
      card.appendChild(body);
      col.appendChild(card);
      resultsWrap.appendChild(col);
    });
  }

  // render selected list
  function renderSelected(){
    selectedList.innerHTML = '';
    selectedAgents.forEach(agent=>{
      const li = document.createElement('li');
      li.className = 'list-group-item d-flex justify-content-between align-items-center';
      li.textContent = `${agent.name} (${agent.email})`;

      const removeBtn = document.createElement('button');
      removeBtn.className = 'btn btn-sm btn-outline-danger';
      removeBtn.textContent = 'x';
      removeBtn.onclick = ()=>{
        selectedAgents.delete(agent.id);
        renderResults(agents);
        renderSelected();
      };

      li.appendChild(removeBtn);
      selectedList.appendChild(li);
    });
  }

  // init data
  renderResults(agents);

  // ---- Compose Email ----
  const sendOfferBtn = document.getElementById('send-offer-btn');
  const composeRecipients = document.getElementById('compose-recipients');
  const btnSendEmail = document.getElementById('btn-send-email');

  sendOfferBtn.addEventListener('click', ()=>{
    const emails = Array.from(selectedAgents.values()).map(a => a.email);
    if(emails.length === 0){
      alert("Please select at least one agent.");
      return;
    }

    // isi recipients
    composeRecipients.value = emails.join(", ");

    // tutup modal destination
    const searchModalEl = document.getElementById('modal-agent-searching-destination');
    const searchModal = bootstrap.Modal.getOrCreateInstance(searchModalEl);
    searchModal.hide();

    // buka modal compose
    const composeModalEl = document.getElementById('modal-compose');
    const composeModal = bootstrap.Modal.getOrCreateInstance(composeModalEl);
    composeModal.show();
  });

  // Send Email button (dummy action)
  btnSendEmail.addEventListener('click', ()=>{
    const subject = document.getElementById('compose-subject').value;
    const body = document.getElementById('compose-body').value;

    if(!subject || !body){
      alert("Subject and body are required.");
      return;
    }

    alert("Email sent successfully to: " + composeRecipients.value);
  });
})();
</script>











<script>
(function(){
  const resultsWrap = document.getElementById('pickup-agent-search-results');
  const selectedList = document.getElementById('pickup-selected-agents-list');
  const selectedAgents = new Map(); // id -> agent object

  // contoh data mock agent pickup
  const agents = [
    {id:101, name:'Andi Pratama', email:'andi@pickup.id'},
    {id:102, name:'Siti Aminah', email:'siti@pickup.id'},
    {id:103, name:'Rahmat Hidayat', email:'rahmat@pickup.id'}
  ];

  function renderResults(list){
    resultsWrap.innerHTML = '';
    list.forEach(agent=>{
      const col = document.createElement('div');
      col.className = 'col-md-6';

      const card = document.createElement('div');
      card.className = 'card h-100 border shadow-sm';

      const body = document.createElement('div');
      body.className = 'card-body d-flex align-items-start';

      const checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.className = 'form-check-input me-2 mt-1';
      checkbox.checked = selectedAgents.has(agent.id);

      checkbox.addEventListener('change', ()=>{
        if(checkbox.checked){
          selectedAgents.set(agent.id, agent);
        } else {
          selectedAgents.delete(agent.id);
        }
        renderSelected();
      });

      const info = document.createElement('div');
      info.innerHTML = `<div class="fw-semibold">${agent.name}</div><small class="text-muted">${agent.email}</small>`;

      body.appendChild(checkbox);
      body.appendChild(info);
      card.appendChild(body);
      col.appendChild(card);
      resultsWrap.appendChild(col);
    });
  }

  function renderSelected(){
    selectedList.innerHTML = '';
    selectedAgents.forEach(agent=>{
      const li = document.createElement('li');
      li.className = 'list-group-item d-flex justify-content-between align-items-center';
      li.textContent = `${agent.name} (${agent.email})`;

      const removeBtn = document.createElement('button');
      removeBtn.className = 'btn btn-sm btn-outline-danger';
      removeBtn.textContent = 'x';
      removeBtn.onclick = ()=>{
        selectedAgents.delete(agent.id);
        renderResults(agents);
        renderSelected();
      };

      li.appendChild(removeBtn);
      selectedList.appendChild(li);
    });
  }

  // init
  renderResults(agents);

  // Compose Email (Pickup)
  const sendOfferBtn = document.getElementById('pickup-send-offer-btn');
  const composeRecipients = document.getElementById('pickup-compose-recipients');
  const btnSendEmail = document.getElementById('pickup-btn-send-email');

  sendOfferBtn.addEventListener('click', ()=>{
    const emails = Array.from(selectedAgents.values()).map(a => a.email);
    if(emails.length === 0){
      alert("Please select at least one pickup agent.");
      return;
    }

    composeRecipients.value = emails.join(", ");

    // tutup modal pickup search
    const searchModalEl = document.getElementById('modal-agent-searching-pickup');
    const searchModal = bootstrap.Modal.getOrCreateInstance(searchModalEl);
    searchModal.hide();

    // buka modal compose pickup
    const composeModalEl = document.getElementById('pickup-modal-compose');
    const composeModal = bootstrap.Modal.getOrCreateInstance(composeModalEl);
    composeModal.show();
  });

  btnSendEmail.addEventListener('click', ()=>{
    const subject = document.getElementById('pickup-compose-subject').value;
    const body = document.getElementById('pickup-compose-body').value;

    if(!subject || !body){
      alert("Subject and body are required.");
      return;
    }

    alert("Pickup Email sent successfully to: " + composeRecipients.value);
  });
})();
</script> --}}

@endsection
		
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
            <a href="" class="btn btn-outline-azure">
             <i class="fa fa-plus"> Create </i>
            </a>
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
            <table class="table card-table table-vcenter text-nowrap" id="QoutationTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th>Code Quotation</th>
                        <th>Date Request</th>
                        <th>Data Costumer</th>
                        <th>Trasportation Method</th>
                        <th>Data Quotation</th>
                        <th style="width: 5%">Agents Pickup</th>
                        <th style="width: 5%">Agents Destination</th>
                    </tr>
                </thead>
                <tbody>
                   <tr>
                        <td>1</td>
                        <td>Req00021</td>
                        <td>Sep 2023 09 03</td>
                        <td>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-costumers-quotation">
                         <i class="fas fa fa-users"> Data Costumer</i>
                        </button>
                        </td>
                        <td>AIR</td>
                        <td>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-quotation">
                         <i class="fas fa fa-file"> Data Quotation Request</i>
                        </button> 
                        <td>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-agent-searching">
                        <i class="fa fa-plane" aria-hidden="true"></i>
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <i class="fa fa-ship" aria-hidden="true"></i>
                        <i class="fas fa fa-user-secret"> Search Agent Pickup</i> 
                        </button> 
                        </td>

                        <td>
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-agent-searching-destination">
                        <i class="fa fa-plane" aria-hidden="true"></i>
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <i class="fa fa-ship" aria-hidden="true"></i>
                        <i class="fas fa fa-user-secret"> Search Agent Destination</i> 
                        </button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>




{{-- modal Data Cotumers Quotation --}}
<div class="modal modal-blur fade" id="modal-costumers-quotation" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
	<h5 class="modal-title">Data Costumers Request</h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="container">
        <article class="card">
            <header class="card-header"> Details Costumers Request  </header>
            <div class="card-body">
                <h2>Name Costumers: <span id="title"></span></h2>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Email:</strong> <br> <p id="email"></p> </div>
                        <div class="col"> <strong>Phone:</strong> <br> <p id="phonr"></p></div>
                    </div>
                </article>
                <hr>


                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>State Code:</strong> <br> <p id="state Code"></p></div>
                        <div class="col"> <strong>State:</strong> <br> <p id="state"></p> </div>
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



{{-- modal Data Quotation --}}
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
                <h2>Code Quotation Request: <span id="title"></span></h2>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Transportation Methode:</strong> <br> <p id="email"></p> </div>
                    </div>
                </article>
                <hr>


                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>pickup origin:</strong> <br> <p id="state Code"></p></div>
                        <div class="col"> <strong>pickup destination:</strong> <br> <p id="state"></p> </div>
                    </div>
                </article>
                <hr>


                <article class="card">
                    <div class="card-body row">
                    <div class="col"> <strong>terms condition:</strong> <br> <textarea class="form-control" id="content" cols="10" rows="5" readonly></textarea> </div>
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
<div class="modal modal-blur fade" id="modal-agent-searching" tabindex="-1" aria-labelledby="agentSearchLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-sm">
      <div class="modal-header">
        <h5 class="modal-title">Search Agent</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- search input -->
        <div class="mb-3">
          <input id="agent-search-input" type="search" class="form-control" placeholder="Search agent...">
        </div>

        <!-- search results -->
        <div id="agent-search-results" class="row g-3"></div>

        <!-- selected list -->
        <div class="mt-4">
          <h6>Selected Agents</h6>
          <ul id="selected-agents-list" class="list-group small"></ul>
        </div>
      </div>

      <div class="modal-footer">
       <button id="send-offer-btn" class="btn btn-primary" type="button">Send Offer</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Compose Email Pickup-->
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





{{-- code script untuk pickup --}}
<script>
(function(){
  const resultsWrap = document.getElementById('agent-search-results');
  const selectedList = document.getElementById('selected-agents-list');
  const selectedAgents = new Map(); // id -> agent object

  // contoh data mock
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
      col.className = 'col-12 col-md-6';

      const card = document.createElement('label');
      card.className = 'd-flex align-items-center border rounded p-2 w-100';
      card.style.cursor='pointer';

      const checkbox = document.createElement('input');
      checkbox.type='checkbox';
      checkbox.className='form-check-input me-2';
      checkbox.checked = selectedAgents.has(agent.id);

      checkbox.addEventListener('change',()=>{
        if(checkbox.checked){
          selectedAgents.set(agent.id, agent);
        } else {
          selectedAgents.delete(agent.id);
        }
        renderSelected();
      });

      const info = document.createElement('div');
      info.innerHTML = `<div class="fw-semibold">${agent.name}</div><div class="small text-muted">${agent.email}</div>`;

      card.appendChild(checkbox);
      card.appendChild(info);
      col.appendChild(card);
      resultsWrap.appendChild(col);
    });
  }

  // render selected list
  function renderSelected(){
    selectedList.innerHTML = '';
    selectedAgents.forEach(agent=>{
      const li = document.createElement('li');
      li.className='list-group-item d-flex justify-content-between align-items-center';
      li.textContent = `${agent.name} (${agent.email})`;
      const removeBtn = document.createElement('button');
      removeBtn.className='btn btn-sm btn-outline-danger';
      removeBtn.textContent='x';
      removeBtn.onclick=()=>{
        selectedAgents.delete(agent.id);
        renderResults(agents);
        renderSelected();
      };
      li.appendChild(removeBtn);
      selectedList.appendChild(li);
    });
  }

  // init with mock data
  renderResults(agents);

  // ---- Compose Email ----
  const sendOfferBtn = document.getElementById('send-offer-btn');
  const composeRecipients = document.getElementById('compose-recipients');
  const btnSendEmail = document.getElementById('btn-send-email');

  // ketika klik "Send Offer"
  sendOfferBtn.addEventListener('click', ()=>{
    const emails = Array.from(selectedAgents.values()).map(a => a.email);
    if(emails.length === 0){
      alert("Please select at least one agent.");
      return;
    }

    // isi recipients di modal compose
    composeRecipients.value = emails.join(", ");

    // tutup modal search agent
    const searchModalEl = document.getElementById('modal-agent-searching');
    const searchModal = bootstrap.Modal.getInstance(searchModalEl);
    if (searchModal) {
      searchModal.hide();
    }

    // buka modal compose
    const composeModalEl = document.getElementById('modal-compose');
    const composeModal = new bootstrap.Modal(composeModalEl);
    composeModal.show();
  });

  // ketika klik "Send Email"
  btnSendEmail.addEventListener('click', async ()=>{
    const subject = document.getElementById('compose-subject').value;
    const body = document.getElementById('compose-body').value;
    const files = document.getElementById('compose-attachment').files;
    const recipients = composeRecipients.value.split(",").map(e => e.trim());

    if(!subject || !body){
      alert("Subject and body are required.");
      return;
    }

    const formData = new FormData();
    formData.append("subject", subject);
    formData.append("body", body);
    recipients.forEach(r => formData.append("recipients[]", r));
    for(let f of files){
      formData.append("attachments[]", f);
    }

    // contoh fetch ke Laravel route
    const res = await fetch("/send-offer-email", {
      method: "POST",
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });

    if(res.ok){
      alert("Email sent successfully!");
      location.reload();
    } else {
      alert("Failed to send email.");
    }
  });
})();
</script>
{{-- end code untuk pickup --}}
@endsection
		
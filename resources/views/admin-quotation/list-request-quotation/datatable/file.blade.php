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



{{-- modal Search Data Pickup contact --}}
{{-- modal Search Data Pickup contact --}}
<div class="modal fade" id="modal-pickup-agent" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Search Agent Pickup</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <article class="card">
          <div class="card-body row">
            <div class="col"> <strong>No Request:</strong> <br> <p id="code_req"></p> </div>
            <div class="col"> <strong>Methode Transportation:</strong> <br> <p id="tm"></p> </div>
            <div class="col"> <strong>Pickup Origin:</strong> <br> <p id="pickup_origin_s"></p> </div>
          </div>
        </article>

        <hr>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Country</label>
            <select id="country_destination" class="form-select">
              <option value="">-- Select Country --</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">State</label>
            <select id="state_destination" class="form-select">
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
            <label class="form-label">Tags</label>
            <select id="tags_destination" class="form-select">
              <option value="">-- Select Tags --</option>
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
          <h6 class="mb-3">Available Agents</h6>
          <div class="row" id="agent-search-results-destination"></div>
        </div>

        <hr>

        <div class="mt-4">
          <h6>Selected Agents</h6>
          <ul id="selectedList" class="list-group small"></ul>
        </div>

      </div>

      <div class="modal-footer">
        {{-- <button id="send-offer-btn" class="btn btn-outline-primary" type="button">
          <i class="fa fa-envelope me-1"></i> Send Offer
        </button> --}}
      </div>
    </div>
  </div>
</div>



{{-- modal kirim email pickup --}}


<!-- Modal: Send Offer Email -->
<div class="modal fade" id="modalSendEmail" tabindex="-1" aria-labelledby="modalSendEmailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalSendEmailLabel">
          <i class="fa fa-envelope"></i> Send Offer Email
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
  <!-- Selected Contacts -->
  <div class="mb-3">
    <label class="form-label fw-bold">To</label>
    <div id="emailSelectedList" class="d-flex flex-wrap gap-2"></div>
  </div>

  <!-- CC -->
  <div class="mb-3">
    <label class="form-label fw-bold">Cc</label>
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
    <label for="emailSubject" class="form-label fw-bold">Subject</label>
    <input 
      type="text" 
      class="form-control" 
      id="emailSubject" 
      placeholder="Enter subject"
    />
  </div>

  <!-- Message -->
  <div class="mb-3">
    <label for="emailMessage" class="form-label fw-bold">Message</label>
    <textarea 
      id="emailMessage" 
      class="form-control" 
      rows="6" 
      placeholder="Write your message..."
    ></textarea>
  </div>

  <!-- Attachment -->
  <div class="mb-3">
    <label for="emailAttachment" class="form-label fw-bold">Attachment</label>
    <input type="file" class="form-control" id="emailAttachment">
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


<script>
document.addEventListener("DOMContentLoaded", () => {
  const countrySelect = document.getElementById("country_destination");
  const stateSelect = document.getElementById("state_destination");
  const citySelect = document.getElementById("city_destination");
  const tagsSelect = document.getElementById("tags_destination");
  const btnSearch = document.getElementById("btn-search-agent");
  const resultsContainer = document.getElementById("agent-search-results-destination");
  const selectedList = document.getElementById("selectedList");

  // Tombol reset otomatis kalau belum ada
  let btnReset = document.getElementById("btn-reset-agent");
  if (!btnReset) {
    btnReset = document.createElement("button");
    btnReset.className = "btn btn-outline-danger ms-2";
    btnReset.id = "btn-reset-agent";
    btnReset.innerHTML = `<i class="fa fa-rotate-left"></i> Reset`;
    btnSearch.parentElement.appendChild(btnReset);
  }

  let allContacts = [];
  let selectedAgents = new Set();
  let filteredResults = [];

  // Pagination variables
  let currentPage = 1;
  const itemsPerPage = 6;

  // ✅ Ambil data dari API
  fetch("http://127.0.0.1:8000/api/contacts")
    .then(res => res.json())
    .then(data => {
      allContacts = data.data || [];

      // --- isi dropdown country ---
      const countries = [...new Set(allContacts.flatMap(c => c.countries?.map(ct => ct.country_name) || []))];
      countries.forEach(c => countrySelect.innerHTML += `<option value="${c}">${c}</option>`);

      // --- isi dropdown tags global ---
      const allTags = [...new Set(allContacts.flatMap(c => c.tags?.map(t => t.tag_name) || []))];
      allTags.forEach(tag => {
        tagsSelect.innerHTML += `<option value="${tag}">${tag}</option>`;
      });
    })
    .catch(err => console.error("Error fetching contacts:", err));

  // ✅ Event chain: Country → State
  countrySelect.addEventListener("change", () => {
    const selectedCountry = countrySelect.value;
    const filtered = allContacts.filter(c => c.countries?.some(ct => ct.country_name === selectedCountry));
    const states = [...new Set(filtered.flatMap(c => c.states?.map(s => s.state_name) || []))];
    stateSelect.innerHTML = `<option value="">-- Select State --</option>`;
    states.forEach(s => stateSelect.innerHTML += `<option value="${s}">${s}</option>`);
    citySelect.innerHTML = `<option value="">-- Select City --</option>`;
    updateSearchButton();
  });

  // ✅ Event chain: State → City
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

  // ✅ Tombol Search ditekan
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

  // ✅ Render hasil dengan pagination
  function renderResults(results) {
    resultsContainer.innerHTML = "";
    if (!results.length) {
      resultsContainer.innerHTML = `<p class="text-muted">No agents found.</p>`;
      document.getElementById("pagination-controls")?.remove();
      return;
    }

    // Pagination logic
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

  // ✅ Pagination control
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

  // ✅ Fungsi pilih agent
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

  // ✅ Render selected list
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
  }

  // ✅ Remove agent
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

  // ✅ Reset
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



  // code untuk  kirim email ke agent pickup

  // ✅ Tombol untuk kirim email (bisa dari modal select)
const btnSendOffer = document.createElement("button");
btnSendOffer.className = "btn btn-primary mt-3 w-100";
btnSendOffer.id = "btn-open-send-email";
btnSendOffer.innerHTML = `<i class="fa fa-paper-plane"></i> Send Offer Email`;
btnSendOffer.disabled = true;
document.getElementById("selectedList").after(btnSendOffer);

// Aktifkan tombol send email hanya jika ada agent terpilih
function updateSendEmailButton() {
  btnSendOffer.disabled = selectedAgents.size === 0;
}
const originalRenderSelected = renderSelected;
renderSelected = function() {
  originalRenderSelected();
  updateSendEmailButton();
};

// ✅ Ketika user klik "Send Offer Email"
btnSendOffer.addEventListener("click", () => {
  if (selectedAgents.size === 0) return;

  // Tutup modal Select Agent
  // Tutup modal aktif (otomatis cari modal yang terbuka)
const openModalEl = document.querySelector('.modal.show');
if (openModalEl) {
  const openModal = bootstrap.Modal.getInstance(openModalEl);
  if (openModal) openModal.hide();
}

  // Isi daftar kontak ke modal email
  const emailList = document.getElementById("emailSelectedList");
  emailList.innerHTML = "";


// emailList.innerHTML = ""; // reset dulu
selectedAgents.forEach(id => {
  const agent = allContacts.find(a => a.id === id);
  if (agent) {
    emailList.innerHTML += `
      <div class="email-chip d-flex align-items-center me-2 mb-2">
        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(agent.name)}&background=random&color=fff" 
             class="rounded-circle me-2" width="28" height="28" alt="avatar">
        <span class="me-2">${agent.email ?? agent.name}</span>
        <button class="btn-close btn-close-white remove-email-contact" data-id="${agent.id}" aria-label="Remove"></button>
      </div>
    `;
  }
});


  // aktifkan tombol remove di modal email
emailList.addEventListener("click", (e) => {
  if (e.target.closest(".remove-email-contact")) {
    const id = parseInt(e.target.closest(".remove-email-contact").dataset.id);
    selectedAgents.delete(id);
    e.target.closest(".email-chip").remove();
  }
});

  // Tampilkan modal kirim email
  const emailModal = new bootstrap.Modal(document.getElementById("modalSendEmail"));
  emailModal.show();
});

// // ✅ Proses kirim email (dummy dulu)
// document.getElementById("btnSendEmailNow").addEventListener("click", () => {
//   const subject = document.getElementById("emailSubject").value.trim();
//   const message = document.getElementById("emailMessage").value.trim();

//   if (!subject || !message) {
//     alert("Please fill subject and message before sending.");
//     return;
//   }

//   const data = {
//     subject,
//     message,
//     contacts: Array.from(selectedAgents).map(id => {
//       const a = allContacts.find(c => c.id === id);
//       return { name: a.name, email: a.email };
//     }),
//   };

//   console.log("📨 Sending email to:", data);

//   // TODO: Integrasikan dengan route backend kamu di sini
//   // misal:
//   // fetch('/api/send-offer', { method:'POST', body: JSON.stringify(data), headers:{'Content-Type':'application/json'} })

//   alert("Email sent successfully!");
//   bootstrap.Modal.getInstance(document.getElementById("modalSendEmail")).hide();
// });


// ✅ Proses kirim email (real logic)
document.getElementById("btnSendEmailNow").addEventListener("click", async () => {
  const subject = document.getElementById("emailSubject").value.trim();
  const message = document.getElementById("emailMessage").value.trim();
  const attachment = document.getElementById("emailAttachment").files[0];
  const cc = document.getElementById("emailCc")?.value.trim() || "";

  if (!subject || !message) {
    alert("⚠️ Please fill subject and message before sending.");
    return;
  }

  // Ambil kontak terpilih
  const contacts = Array.from(selectedAgents).map(id => {
    const a = allContacts.find(c => c.id === id);
    return { name: a.name, email: a.email };
  });

  // 🔧 Siapkan data form
  const formData = new FormData();
  formData.append("subject", subject);
  formData.append("message", message);
  formData.append("cc", cc);
  formData.append("contacts", JSON.stringify(contacts));
  if (attachment) formData.append("attachment", attachment);

  // 🔥 Kirim ke backend API kamu
  try {
    const res = await fetch("/api/send-offer", {
      method: "POST",
      body: formData,
    });

    if (!res.ok) throw new Error(`Server error: ${res.status}`);
    const result = await res.json();

    alert("✅ Email sent successfully!");
    console.log("📨 Response:", result);

    // Tutup modal & reset form
    const modal = bootstrap.Modal.getInstance(document.getElementById("modalSendEmail"));
    modal.hide();
    document.getElementById("emailSubject").value = "";
    document.getElementById("emailMessage").value = "";
    document.getElementById("emailCc").value = "";
    document.getElementById("emailAttachment").value = "";
    document.getElementById("emailSelectedList").innerHTML = "";
    selectedAgents.clear();

  } catch (err) {
    console.error("❌ Failed to send email:", err);
    alert("❌ Failed to send email. Please try again.");
  }
});





// ✅ Perbaikan bug backdrop agar layar tidak tetap gelap setelah close modal
document.addEventListener('hidden.bs.modal', function () {
  // Kalau tidak ada modal yang masih terbuka, hapus backdrop manual
  if (!document.querySelector('.modal.show')) {
    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    document.body.classList.remove('modal-open');
    document.body.style.overflow = ''; // supaya bisa scroll lagi
  }
});



// ✅ Reset semua data & tampilan kalau modal ditutup
document.addEventListener('hidden.bs.modal', function (event) {
  const modalId = event.target.id;

  // --- Jika modal select agent ditutup ---
  if (modalId === 'modal-pickup-agent') {
    selectedAgents.clear(); // hapus semua agent yang sudah dipilih
    document.getElementById('selectedList').innerHTML = '';
    document.getElementById('agent-search-results-destination').innerHTML = '';
    document.getElementById('country_destination').value = '';
    document.getElementById('state_destination').value = '';
    document.getElementById('city_destination').value = '';
    document.getElementById('tags_destination').value = '';
    document.getElementById('btn-search-agent').disabled = true;
  }

  // --- Jika modal kirim email ditutup ---
  if (modalId === 'modalSendEmail') {
    document.getElementById('emailSelectedList').innerHTML = '';
    document.getElementById('emailSubject').value = '';
    document.getElementById('emailMessage').value = '';
    document.getElementById('emailAttachment').value = '';
  }

  // --- Pastikan backdrop & scroll kembali normal ---
  if (!document.querySelector('.modal.show')) {
    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
  }
});



const ccInput = document.getElementById("ccInput");
const ccList = document.getElementById("ccSelectedList");
const ccEmails = new Set();

ccInput.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    e.preventDefault();
    const email = e.target.value.trim();
    if (email && !ccEmails.has(email)) {
      ccEmails.add(email);

      const initials = email[0].toUpperCase();
      const chip = document.createElement("div");
      chip.className = "email-chip";
      chip.innerHTML = `
        <div class="avatar">${initials}</div>
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


});
</script>



<style>
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

</style>

@endsection
		
@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header d-print-none mb-3">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <div class="page-pretitle text-uppercase">
          Overview
        </div>
        <h2 class="page-title fw-bold">
          Your Document
        </h2>
      </div>
      <div class="col-auto ms-auto d-print-none">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-report">
          <i class="fa fa-plus me-1"></i>
          Upload new document <span class="d-none d-sm-inline">on date (01-02-2026)</span>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Alert -->
<div class="container-xl mb-1">
 <div class="alert alert-warning alert-dismissible d-flex align-items-start" role="alert">
  <span class="me-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
      stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
      <path d="M12 9v2m0 4v.01" />
      <path d="M12 5a7 7 0 1 0 7 7a7 7 0 0 0 -7 -7" />
    </svg>
  </span>
  <div class="flex-fill">
    <h4 class="alert-heading fw-bold mb-1">⚠️ Dokumen Akan Expired</h4>
    <p class="mb-0">
      Document Anda akan <span class="fw-bold text-danger">Expired pada tanggal 12 Januari 2026</span>.  
      Segera persiapkan untuk memperbaharui dokumen ini.
    </p>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

</div>

<!-- Table -->
<div class="page-body">
  <div class="container-xl">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title fw-bold">Document Data</h3>
      </div>
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap">
          <thead class="table-light">
            <tr>
              <th class="w-1">No.</th>
              <th>Document Subject</th>
              <th>Document File</th>
              <th>Date Upload</th>
              <th>Date Expired</th>
              <th>Status</th>
              <th class="w-1">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Sample Subject</td>
              <td>Document xxxxxx</td>
              <td>12 Januari 2025</td>
              <td>12 Januari 2026</td>
              <td>
                <span class="badge bg-green-lt">Active</span>
              </td>
              <td>
                <div class="btn-list">
                  <a href="#" class="btn btn-sm btn-danger">
                    <i class="fa fa-file-pdf me-1"></i> Download Doc
                  </a>
                </div>
              </td>
            </tr>
            <!-- Tambah row dinamis di sini -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

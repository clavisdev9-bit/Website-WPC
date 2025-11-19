@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Overview</div>
                <h2 class="page-title">Data Commodity</h2>
            </div>

            <div class="col-auto ms-auto d-print-none">
                <button id="btnSync" class="btn btn-outline-primary">
                    <i class="fa fa-rotate"></i> Sync Commodity from External API
                </button>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
<div class="container-xl">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Commodity Data Result Sync</h3></div>
        <div class="table-responsive">
            <table  class="table card-table table-vcenter text-nowrap" id="commodityTable">
                <thead>
                    <tr>
                        <th style="width: 2%">No</th>
                        <th style="width: 5%">External ID</th>
                        <th>Name Commodity</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
let table;
document.addEventListener("DOMContentLoaded", function () {
    // INIT DATATABLE
    table = $('#commodityTable').DataTable({
        processing: true,
        ajax: {
            url: "/api/master-local-commodities",
            dataSrc: "data"
        },
        columns: [
            {
                data: null, 
                render: (data, type, row, meta) => meta.row + 1
            },
            { data: "external_id", defaultContent: "-" },
            { data: "name" }
        ]
    });

    // BUTTON SYNC
    document.getElementById("btnSync").addEventListener("click", function () {
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = `<i class="fa fa-spinner fa-spin"></i> Syncing...`;
        fetch("/api/sync/commodities", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        })
        .then(r => r.json())
        .then(res => {
            alert(res.message || "Sync selesai!");
            table.ajax.reload(null, false);

            btn.disabled = false;
            btn.innerHTML = `<i class="fa fa-rotate"></i> Sync Commodity from External API`;
        })
        .catch(err => {
            alert("Error sync");
            console.error(err);

            btn.disabled = false;
            btn.innerHTML = `<i class="fa fa-rotate"></i> Sync Commodity from External API`;
        });
    });
});
</script>

@endsection

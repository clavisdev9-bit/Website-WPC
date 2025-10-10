

document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="route-contact-sync-get-log"]');
    let requestUrlContactSyncLog = metaTag ? metaTag.content : null;

    if (!requestUrlContactSyncLog) {
        // console.error("Meta tag Route Not found.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let ContactSynclogTable = document.getElementById("contactSyncLogTable");
    if (!ContactSynclogTable) {
        // console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#contactSyncLogTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlContactSyncLog,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // **Pastikan ini ada**
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "sync_time", name: "sync_time" },
            { data: "total_records", name: "total_records" },
            { data: "status", name: "status" },
            { data: "message", name: "message" },
        ],
        responsive: true,
        autoWidth: false,
        language: {
            processing: "Loading Data...",
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries to show",
            infoFiltered: "(filtered from _MAX_ total entries)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous",
            },
            zeroRecords: "No matching records found",
        },
    });


    
});




document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="route-contact-sync-get"]');
    let requestUrlContactSync = metaTag ? metaTag.content : null;

    if (!requestUrlContactSync) {
        // console.error("Meta tag Route Not found.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let ContactSyncTable = document.getElementById("contactSyncTable");
    if (!ContactSyncTable) {
        // console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#contactSyncTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlContactSync,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // **Pastikan ini ada**
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name", name: "name" },
            { data: "email", name: "email" },
            { data: "phone", name: "phone" },
            { data: "tags", name: "tags" },
            { data: "country", name: "country" },
            { data: "state", name: "state" },
            { data: "details", name: "details", orderable: false, searchable: true },
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


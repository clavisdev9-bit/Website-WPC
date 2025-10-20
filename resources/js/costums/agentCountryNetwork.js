document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="route-agent-network-country-get"]');
    let requestUrlAgentNetworkTable = metaTag ? metaTag.content : null;

    if (!requestUrlAgentNetworkTable) {
        // console.error("Meta tag Route Not found.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let agentNetworkTable = document.getElementById("agentNetworkTable");
    if (!agentNetworkTable) {
        // console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#agentNetworkTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlAgentNetworkTable,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // **Pastikan ini ada**
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name_subcontinent", name: "name_subcontinent" },
            { data: "name", name: "name" },
            { data: "iso_code", name: "iso_code" },
            { data: "flag", name: "flag" },
            { data: "action", name: "action", orderable: false, searchable: true },
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


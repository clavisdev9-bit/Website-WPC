document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="route-agent-network-subcontinent-get"]');
    let requestUrlAgentNetworkSubContinentTable = metaTag ? metaTag.content : null;

    if (!requestUrlAgentNetworkSubContinentTable) {
        // console.error("Meta tag Route Not found.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let subcontinentAgentNetworkTable = document.getElementById("subcontinentAgentNetworkTable");
    if (!subcontinentAgentNetworkTable) {
        // console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#subcontinentAgentNetworkTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlAgentNetworkSubContinentTable,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // **Pastikan ini ada**
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "continent_name", name: "continent_name" },
            { data: "name", name: "name" },
            { data: "code", name: "code" },
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


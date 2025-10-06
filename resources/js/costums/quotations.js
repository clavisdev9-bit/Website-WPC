

document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="route-get-qoute"]');
    let requestUrlQuoate = metaTag ? metaTag.content : null;

    if (!requestUrlQuoate) {
        // console.error("Meta tag Route Not found.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let qoutationsTable = document.getElementById("qoutationsTable");
    if (!qoutationsTable) {
        // console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#qoutationsTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlQuoate,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // **Pastikan ini ada**
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name", name: "name" },
            { data: "date_request", name: "date_request" },
            { data: "data_customer", name: "data_customer" },
            { data: "transportation_method", name: "transportation_method" },
            { data: "data_quotation", name: "data_quotation" },
            { data: "agents_pickup", name: "agents_pickup" },
            { data: "agents_destination", name: "agents_destination" },
           
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


    // costumer
 $(document).on('click', '#sets', function() {
    let name_cust  = $(this).data('name_cust');
    let email      = $(this).data('email');
    let phone      = $(this).data('phone');
    let state      = $(this).data('state');
    let state_code = $(this).data('state_code');
    let no_reg = $(this).data('no_reg');

    // isi modal
    $('#name_cust').text(name_cust);
    $('#email').text(email);
    $('#phone').text(phone);
    $('#state').text(state);
    $('#state_code').text(state_code);
    $('#no_reg').text(no_reg);
});


// quotation
 $(document).on('click', '#quotation', function() {
    
    let no_request = $(this).data('no_request');
    let terms = $(this).data('terms');
    let pickup_origin = $(this).data('pickup_origin');
    let destination_origin = $(this).data('destination_origin');
    var transportation = ($(this).data('transportation_method') || '').toLowerCase();


     // mapping icons
    var icons = {
        'air': '<i class="fa fa-plane text-primary"></i> Air',
        'ocean': '<i class="fa fa-ship text-info"></i> Ocean',
        'air & ocean': '<i class="fa fa-plane text-primary"></i> + <i class="fa fa-ship text-info"></i> Air & Ocean',
        'domestic ground transportation': '<i class="fa fa-truck text-warning"></i> Domestic Ground Transportation'
    };

    // isi modal
    $('#no_request').text(no_request);
    $('#terms').text(terms);
    $('#pickup_origin').text(pickup_origin);
    $('#destination_origin').text(destination_origin);
   $('#transportation_method').html(icons[transportation] || transportation);
});


});


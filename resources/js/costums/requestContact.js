document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="route-get-data-request"]');
    let requestUrlrequestContact = metaTag ? metaTag.content : null;

    if (!requestUrlrequestContact) {
        console.error("Meta tag Route Not found.");
        return;
    }

    let requestContactTable = document.getElementById("requestContactTable");
    if (!requestContactTable) {
        console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#requestContactTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlrequestContact,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name", name: "name" },
            { data: "email", name: "email" },
            { data: "phone", name: "phone" },
            { data: "interested_in", name: "interested_in" },
            { data: "details", name: "details" },
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



       $(document).on('click', '#sets', function() {
       var nm = $(this).data('nm');
       var em = $(this).data('em');
       var phones = $(this).data('phones');
       var crte = $(this).data('crte');
       var sub = $(this).data('sub');
       var masage = $(this).data('masage');
      
    

      
      $('#nm').text(nm);  
      $('#em').text(em);  
      $('#phones').text(phones);  
      $('#crte').text(crte);  
      $('#sub').text(sub);  
      $('#masage').text(masage);  
     
      
    })

});



document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="route-user-get"]');
    let requestUrlUser = metaTag ? metaTag.content : null;

    if (!requestUrlUser) {
        // console.error("Meta tag Route Not found.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let userTable = document.getElementById("userTable");
    if (!userTable) {
        console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#userTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlUser,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // **Pastikan ini ada**
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "fullname", name: "fullname" },
            // { data: "username", name: "username" },
            { data: "email", name: "email" },
            { data: "name_group", name: "name_group" },
            // { data: "nama_divisi", name: "nama_divisi" },
            { data: "role", name: "role" },
            { data: "image", name: "image" },
            { data: "details", name: "details" },
            { data: "access", name: "access" },
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
    var fn = $(this).data('fn');
    var un = $(this).data('un');
    var pw = $(this).data('pw');
    var st = $(this).data('st');
  

   $('#fn').text(fn);  
   $('#un').text(un);  
   $('#pw').text(pw);  
   $('#st').text(st);  
  
 })

});



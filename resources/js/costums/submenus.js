document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="route-submenu-get"]');
    let requestUrlSubMenu = metaTag ? metaTag.content : null;

    if (!requestUrlSubMenu) {
        // console.error("Meta tag Route Not found.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let sbTable = document.getElementById("submenuTable");
    if (!sbTable) {
        // console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#submenuTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlSubMenu,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "menu", name: "menu" },
            { data: "title", name: "title" },
            { data: "parent_menu_name", name: "parent_menu_name" },
            { data: "url", name: "url" },
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
       var url = $(this).data('url');
       var title = $(this).data('title');
       var pmn = $(this).data('pmn');
       var noted = $(this).data('noted');
       var status = $(this).data('status');
       var menu = $(this).data('menu');
       var icon = $(this).data('icon');

      $('#url').text(url);  
      $('#title').text(title);  
      $('#pmn').text(pmn);  
      $('#noted').text(noted);  
      $('#status').text(status);  
      $('#menu').text(menu);  
      $('#icon').text(icon);  
    })

});


   





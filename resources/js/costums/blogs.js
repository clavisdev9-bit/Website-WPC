

document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="route-get-blogs"]');
    let requestUrlMenu = metaTag ? metaTag.content : null;

    if (!requestUrlMenu) {
        // console.error("Meta tag Route Not found.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let BlogsTable = document.getElementById("BlogsTable");
    if (!BlogsTable) {
        // console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#BlogsTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlMenu,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // **Pastikan ini ada**
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "title", name: "title" },
            { data: "name_category", name: "name_category" },
            { data: "image_blogs", name: "image_blogs" },
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
       var title = $(this).data('title');
       var slug = $(this).data('slug');
       var excerpt = $(this).data('excerpt');
       var name_category = $(this).data('name_category');
       var name_author = $(this).data('name_author');
       var content = $(this).data('content');
       var meta_title = $(this).data('meta_title');
       var meta_description = $(this).data('meta_description');
       var is_published = $(this).data('is_published');
       var created_at = $(this).data('created_at');
    

      
      $('#title').text(title);  
      $('#slug').text(slug);  
      $('#excerpt').text(excerpt);  
      $('#name_category').text(name_category);  
      $('#name_author').text(name_author);  
      $('#content').text(content);  
      $('#meta_title').text(meta_title);  
      $('#meta_description').text(meta_description);  
      $('#is_published').text(is_published);  
      $('#created_at').text(created_at);  
      
    })

});

 

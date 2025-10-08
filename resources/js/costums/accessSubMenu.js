$(document).ready(function () {
    // Ambil CSRF token dan route dari meta tag
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const routeChange = $('meta[name="route-submenu-change"]').attr('content');

    // Ketika checkbox diklik
    $('.form-check-input').on('click', function () {
        const submenu = $(this).data('submenu');
            const userId = $(this).data('user');

      

            $.ajax({
                url: routeChange, // Laravel route
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken // Laravel CSRF token
                },
                data: {
                    submenu: submenu,
                    userId: userId
                },
                success: function() {
                    window.location.href = '/Administrator/Users-management'; // Laravel URL helper
                },
                // error: function(xhr) {
                //     console.error('AJAX request failed:', xhr);
                // }
            });



    });

    // Inisialisasi DataTable
    $('#accessTable').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
    });
});
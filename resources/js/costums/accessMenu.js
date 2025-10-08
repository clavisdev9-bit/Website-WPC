// import $ from 'jquery';
// import 'datatables.net-bs5';



// $(document).ready(function () {
//     // Ambil CSRF token dan route dari meta tag
//     const csrfToken = $('meta[name="csrf-token"]').attr('content');
//     const routeChange = $('meta[name="route-menu-change"]').attr('content');

//     // Ketika checkbox diklik
//     $('.form-check-input').on('click', function () {
//         const menuId = $(this).data('menu');
//         const roleId = $(this).data('role');

//         $.ajax({
//             url: routeChange,
//             type: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': csrfToken
//             },
//             data: {
//                 menuId: menuId,
//                 roleId: roleId
//             },
//             success: function () {
//                 window.location.href = '/Administrator/Roles-management';
//             }
//         });
//     });

//     // Inisialisasi DataTable
//     $('#MenuRoleTable').DataTable({
//         paging: true,
//         lengthChange: true,
//         searching: false,
//         ordering: true,
//         info: true,
//         autoWidth: false,
//         responsive: true,
//     });
// });


import $ from 'jquery'
window.$ = $;
window.jQuery = $;

// import 'datatables.net-bs5'
// import 'datatables.net-bs5/css/dataTables.bootstrap5.css'

// Jalankan script kamu
$(document).ready(function () {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const routeChange = $('meta[name="route-menu-change"]').attr('content');

    $('.form-check-input').on('click', function () {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: routeChange,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: { menuId, roleId },
            success: function () {
                window.location.href = '/Administrator/Roles-management';
            }
        });
    });

    $('#MenuRoleTable').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        responsive: true,
    });
});

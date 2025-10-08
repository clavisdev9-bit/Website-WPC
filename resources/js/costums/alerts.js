// document.addEventListener('DOMContentLoaded', function () {
//     var flashMessage = document.getElementById('flash').dataset.flash;
//     if (flashMessage) {
//         Swal.fire({
//         icon: "success",
//         title: flashMessage,
//         showConfirmButton: false,
//         timer: 1500
//         });
//     }
// });

// document.addEventListener('DOMContentLoaded', function () {
//     var flashMessage = document.getElementById('flashError').dataset.flash;
//     if (flashMessage) {
//         Swal.fire({
//             title: 'Error!',
//             text: flashMessage,
//             icon: 'error',
//             confirmButtonText: 'OK'
//         });
//     }
// });


// document.addEventListener('DOMContentLoaded', function () {
//     var flashMessage = document.getElementById('flashInfo').dataset.flash;
//     if (flashMessage) {
//         Swal.fire({
//         title: "Warning?",
//         text: flashMessage,
//         icon: "question"
//         });
//     }
// });



document.addEventListener('DOMContentLoaded', function () {
    const flash = document.getElementById('flash');
    if (flash && flash.dataset.flash) {
        Swal.fire({
            icon: "success",
            title: flash.dataset.flash,
            showConfirmButton: false,
            timer: 1500
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const flashError = document.getElementById('flashError');
    if (flashError && flashError.dataset.flash) {
        Swal.fire({
            title: 'Error!',
            text: flashError.dataset.flash,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const flashInfo = document.getElementById('flashInfo');
    if (flashInfo && flashInfo.dataset.flash) {
        Swal.fire({
            title: "Warning?",
            text: flashInfo.dataset.flash,
            icon: "question"
        });
    }
});

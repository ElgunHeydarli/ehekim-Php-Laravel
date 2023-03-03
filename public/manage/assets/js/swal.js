'use strict';

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
})

document.querySelectorAll('.delete').forEach(del => {
    let url = del.getAttribute('href');
    del.addEventListener('click', function (e) {
        e.preventDefault();
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        if (data.code == 204) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                data.message,
                                'success'
                            );
                            setTimeout(() => {
                                window.location.reload();
                            }, 3000)
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Cancelled!',
                                data.message,
                                'error'
                            );
                        }
                    });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    })
})

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
$(document).ready(function() {
    $(document).on('click', '.add_product', function(e) {
        e.preventDefault();
        let name = $('#name').val();
        let price = $('#price').val();
        let description = $('#description').val();
        $.ajax({
            url: "{{ route('add.product') }}",
            method: 'post',
            data: {
                name: name,
                price: price,
                description: description
            },
            success: function(res) {
                if (res.status == 'success') {
                    $('#addModal').modal('hide');
                    $('#addProductForm')[0].reset();
                    $('.table').load(location.href + ' .table');

                    //toastr js code

                    Command: toastr["success"]("Product Added", "Success")

                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }

                    //toastr js code end




                }

            },
            error: function(err) {
                let error = err.responseJSON;
                $.each(error.errors, function(index, value) {
                    $('.errMsgContainer').append('<span class="text-danger">' +
                        value + '</span>' + '<br>');

                });

            }

        });
    })

    //show product value in update form
    $(document).on('click', '.update_product_form', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let description = $(this).data('description');
        let price = $(this).data('price');

        $('#up_id').val(id);
        $('#up_name').val(name);
        $('#up_description').val(description);
        $('#up_price').val(price);


    });

    //update product data 


    $(document).on('click', '.update_product', function(e) {
        e.preventDefault();
        let up_id = $('#up_id').val();
        let up_name = $('#up_name').val();
        let up_description = $('#up_description').val();
        let up_price = $('#up_price').val();

        $.ajax({
            url: "{{ route('update.product') }}",
            method: 'post',
            data: {
                up_id: up_id,
                up_name: up_name,
                up_price: up_price,
                up_description: up_description
            },
            success: function(res) {
                if (res.status == 'success') {
                    $('#updateModal').modal('hide');
                    $('#updateProductForm')[0].reset();
                    $('.table').load(location.href + ' .table');

                    //toastr js code

                    Command: toastr["success"]("Product Updated", "Success")

                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }

                    //toastr js code end



                }

            },
            error: function(err) {
                let error = err.responseJSON;
                $.each(error.errors, function(index, value) {
                    $('.errMsgContainer').append('<span class="text-danger">' +
                        value + '</span>' + '<br>');

                });

            }

        });
    })

    //delete product

    $(document).on('click', '.delete_product', function(e) {
        e.preventDefault();
        let product_id = $(this).data('id');
        swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                $.ajax({
                    url: "{{ route('delete.product') }}",
                    method: 'post',
                    data: {
                        product_id: product_id
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('.table').load(location.href + ' .table');

                            //toastr js code

                            Command: toastr["success"]("Product Deleted", "Success")

                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }

                            //toastr js code end




                        }

                    }
                });
            }
            })

    })
    // end delete part

    //pagination part start
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();

        let page = $(this).attr('href').split('page=')[1] //3 page a
        product(page) //2
    })

    function product(page) { //1
        $.ajax({
            url: "/pagination/paginate-data?page=" + page,
            success: function(res) {
                $('.table-data').html(res);

            }
        })

    }

    //pagination part end

    //search product
    $(document).on('keyup', function(e) {
        e.preventDefault();
        let search_string = $('#search').val();
        // console.log(search_string);
        $.ajax({
            url: "{{ route('search.product')}}",
            method: 'GET',
            data: {
                search_string: search_string
            },
            success: function(res) {
                $('.table-data').html(res);
                if (res.status == 'nothing_found') {
                    $('.table-data').html('<span class="text-danger">' + 'Nothing Found' +
                        '</span>');
                }
            }

        });

    });

    //search product end

});
</script>
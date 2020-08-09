const SITE_URL = 'http://lara-point-of-sales.sonjoy';

// Data table page script...
$(function () {

    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

});

// Select option script...
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4',
    });

});

// Status Active/Inactive Bootstrap Switch js...
$(function () {
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
});


// Form validation for Create User jQuery...
$(document).ready(function () {

    $('#inputForm').validate({
        rules: {
            user_type: {
                required: true,
            },
            name: {
                required: true,
            },
            email: {
                required: true,
                text: true,
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 15,
            },
            password_confirmation: {
                required: true,
                minlength: 6,
                maxlength: 15,
                equalTo: '#password',
            },
        },
        messages: {
            user_type: {
                required: "Please choose user type!",
            },
            name: {
                required: "Please enter a full name!",
            },
            email: {
                required: "Please enter a email address!",
                text: "Please enter a vaild email address!",
            },
            password: {
                required: "Please type a password!",
                minlength: "Your password must be at least 6 characters!",
                maxlength: "Your password must be less than 16 characters long!",
            },
            password_confirmation: {
                required: "Please again type same password!",
                minlength: "Your confirm password must be at least 6 characters!",
                maxlength: "Your confirm password must be less than 16 characters long!",
                equalTo: "The password & confirm password does not matched!",
            }
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

});


// Delete data using Sweetalert2 js...
$('body').on('click', '#deleteData', function (e) {
    e.preventDefault();
    var route = $(this).attr('href');
    // alert(route);

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            window.location.href = route;
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })

});

// Approved purchase status data using Sweetalert2 js...
$('body').on('click', '#approvedStatus', function (e) {
    e.preventDefault();
    var route = $(this).attr('href');
    // alert(route);

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to Approved this purchase!",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Approved it!'
    }).then((result) => {
        if (result.value) {
            window.location.href = route;
            Swal.fire(
                'Approved!',
                'Your purchase has been approved.',
                'success'
            )
        }
    })

});

// Pending purchase status data using Sweetalert2 js...
$('body').on('click', '#pendingStatus', function (e) {
    e.preventDefault();
    var route = $(this).attr('href');
    // alert(route);

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to Pending this purchase!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Pending it!'
    }).then((result) => {
        if (result.value) {
            window.location.href = route;
            Swal.fire(
                'Pending!',
                'Your purchase has been pending.',
                'success'
            )
        }
    })

});

// Return purchase status data using Sweetalert2 js...
$('body').on('click', '#returnStatus', function (e) {
    e.preventDefault();
    var route = $(this).attr('href');
    // alert(route);

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to Return this purchase!",
        icon: 'danger',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Return it!'
    }).then((result) => {
        if (result.value) {
            window.location.href = route;
            Swal.fire(
                'Returned!',
                'Your purchase has been returned.',
                'success'
            )
        }
    })

});


// Form validation for Edit/Change Password jQuery...
$(document).ready(function () {

    $('#passwordForm').validate({
        rules: {
            old_password: {
                required: true,
            },
            new_password: {
                required: true,
                minlength: 6,
                maxlength: 15,
            },
            again_new_password: {
                required: true,
                equalTo: '#new_password',
            },
        },
        messages: {
            old_password: {
                required: "Please type a old password!",

            },
            new_password: {
                required: "Please type a new password!",
                minlength: "Your new password must be at least 6 characters!",
                maxlength: "Your new password must be less than 16 characters long!",
            },
            again_new_password: {
                required: "Please again type a new password!",
                equalTo: "The new password & confirm new password does not matched!",
            }
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

});


// Form validation for Edit/Change Supplier jQuery...
$(document).ready(function () {
    $('#supplierCreateForm').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                text: true,
            },
            phone: {
                required: true,
            },
            address: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter supplier name!",
            },
            email: {
                required: "Please enter supplier email!",
                text: "Enter valid email address!",
            },
            phone: {
                required: "Please enter supplier phone!",
            },
            address: {
                required: "Please enter supplier address!",
            }
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

});

// Form validation for Edit/Change Customer Form jQuery...
$(document).ready(function () {
    $('#customerCreateForm').validate({
        rules: {
            name: {
                required: true,
            },
            phone: {
                required: true,
            },
            address: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter customer name!",
            },
            phone: {
                required: "Please enter customer phone!",
            },
            address: {
                required: "Please enter customer address!",
            }
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

});

// Form validation for Edit/Change Unit Form jQuery...
$(document).ready(function () {
    $('#unitCreateForm').validate({
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter Unit name!",
            },
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

});

// Form validation for Edit/Change Category Form jQuery...
$(document).ready(function () {
    $('#categoryCreateForm').validate({
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter Category name!",
            },
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

});

// Form validation for Edit/Change Sub Category Form jQuery...
$(document).ready(function () {
    $('#subCategoryCreateForm').validate({
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter Sub Category name!",
            },
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

});

// Form validation for Edit/Change Product Form jQuery...
$(document).ready(function () {
    $('#productCreateForm').validate({
        rules: {
            supplier_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            name: {
                required: true,
            },
            unit_id: {
                required: true,
            },
            qty: {
                required: true,
            },
        },
        messages: {
            supplier_id: {
                required: "Please Choose Supplier name!",
            },
            category_id: {
                required: "Please Choose Category name!",
            },
            name: {
                required: "Please enter Product name!",
            },
            unit_id: {
                required: "Please Choose Unit name!",
            },
            qty: {
                required: "Please enter quantity!",
            },
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

});

// Data retrived from database for Purchase & Invoice section using ajax call js...
$(document).ready(function() {
    // Supplier wise Category return Data ajax call using jquery...
    $(document).on('change', '#supplier_id', function() {
        var csrf_token = $("meta[name='csrf-token']").attr('content');
        var supplier_id = $(this).val();
        $.ajax({
            url: SITE_URL + '/home/purchases/supp-wise-cat',
            type: 'POST',
            data: {
                supplier_id: supplier_id, _token: csrf_token,
            },
            success: function(data) {
                var html = '<option value="">Choose Category Name</option>';
                $.each(data, function(key, val) {
                    html += '<option value="' + val.category_id + '">' + val.category.name + '</option>';
                });
                $('#category_id').html(html);
            },
            error: function() {
                alert('Error!');
            },
        });
    });
    // Category wise Sub category Data return ajax call using jquery...
    $(document).on('change', '#category_id', function() {
        var csrf_token = $("meta[name='csrf-token']").attr('content');
        var category_id = $(this).val();
        $.ajax({
            url: SITE_URL + '/home/purchases/cat-wise-subcat',
            type: 'POST',
            data: {
                category_id: category_id, _token: csrf_token,
            },
            success: function(data) {
                var html = '<option value="0">Choose Sub Category Name</option>';
                $.each(data, function(key, val) {
                    if(val.sub_category != null) {
                        html += '<option value="' + val.sub_category_id  + '">' + val.sub_category.name + '</option>';
                    }
                    // else {
                    //     html += '<option value="' + 0 + '">No Sub Category Found!</option>';
                    // }

                });
                $('#sub_category_id').html(html);
            },
            error: function() {
                alert('Error!');
            },
        });

    });

    // Category wise Unit Data return ajax call using jquery...
    $(document).on('change', '#category_id', function() {
        var csrf_token = $("meta[name='csrf-token']").attr('content');
        var category_id = $(this).val();
        $.ajax({
            url: SITE_URL + '/home/purchases/cat-wise-unit',
            type: 'POST',
            data: {
                category_id: category_id, _token: csrf_token,
            },
            success: function(data) {
                var html = '<option value="">Choose Unit Name</option>';
                $.each(data, function(key, val) {
                    html += '<option value="' + val.unit_id + '">' + val.unit.name  + '</option>';
                });
                $('#unit_id').html(html);
            },
            error: function() {
                alert('Error!');
            },
        });

    });

    // Category wise Product Data return ajax call using jquery...
    $(document).on('change', '#category_id', function() {
        var csrf_token = $("meta[name='csrf-token']").attr('content');
        var category_id = $(this).val();
        $.ajax({
            url: SITE_URL + '/home/purchases/cat-wise-product',
            type: 'POST',
            data: {
                category_id: category_id, _token: csrf_token,
            },
            success: function(data) {
                var html = '<option value="">Choose Product Name</option>';
                $.each(data, function(key, val) {
                    html += '<option value="' + val.id + '">' + val.name + '</option>';
                });
                $('#product_id').html(html);
            },
            error: function() {
                alert('Error!');
            },
        });

    });

    // Product wise Product Stock return ajax call using jquery...
    $(document).on('change', '#product_id', function() {
        var csrf_token = $("meta[name='csrf-token']").attr('content');
        var product_id = $(this).val();
        $.ajax({
            url: SITE_URL + '/home/invoices/product-wise-stock',
            type: 'POST',
            data: {
                product_id: product_id, _token: csrf_token,
            },
            success: function(data) {
                $('#qty').val(data);
            },
            error: function() {
                alert('Error!');
            },
        });

    });

});


// Form validation for Edit/Change Purchase Form jQuery...
// $(document).ready(function () {
//     $('#dateWiseInvoice').validate({
//         rules: {
//             start_date: {
//                 required: true,
//             },
//             end_date: {
//                 required: true,
//             },
//
//         },
//         messages: {
//             start_date: {
//                 required: "Please Enter Start Date!",
//             },
//             end_date: {
//                 required: "Please Enter End Date!",
//             },
//
//         },
//
//         errorElement: 'span',
//         errorPlacement: function (error, element) {
//             error.addClass('invalid-feedback');
//             element.closest('.form-group').append(error);
//         },
//         highlight: function (element, errorClass, validClass) {
//             $(element).addClass('is-invalid');
//         },
//         unhighlight: function (element, errorClass, validClass) {
//             $(element).removeClass('is-invalid');
//         }
//     });
//
// });

// DATETIME GIJGO PICKER START/END using js...
$('.datetimepicker').datetimepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd hh:MM',
    footer: true,
    modal: true
});

// Search start date wise Invoice using DATETIME GIJGO PICKER START/END js...
$('.datetimepicker1').datetimepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd',
    footer: true,
    modal: true
});
// Search end date wise Invoice using DATETIME GIJGO PICKER START/END js...
$('.datetimepicker2').datetimepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd',
    footer: true,
    modal: true
});

//




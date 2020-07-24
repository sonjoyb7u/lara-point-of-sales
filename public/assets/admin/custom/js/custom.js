
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


// Sweetalert2 js...
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

// Form validation for Edit/Change Purchase Form jQuery...
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

// DATETIME GIJGO PICKER START/END using js...
$('.datetimepicker').datetimepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd hh:MM TT',
    footer: true,
    modal: true
});




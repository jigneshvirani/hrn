// Author: Jigs Virani
// 28th july 2017
// This js file is only for login purpose.

var Login = function() {

    var handleLogin = function() {

        $('.signin-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
                remember: {
                    required: false
                }
            },
            messages: {
                email: {
                    required: "Email address is required.",
                    email: "Invalid email address."
                },
                password: {
                    required: "Password is required."
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.signin-form')).show();
            },
            highlight: function(element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function(error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            submitHandler: function(form) {
                //define form data
                var fd = new FormData();
                //append data                
                $.each($('.signin-form').serializeArray(), function(i, obj) {
                    fd.append(obj.name, obj.value)
                })

                console.log(fd);
                
                $.ajax({
                    url: BASEURL + 'dologin',
                    type: "post",
                    processData: false,
                    contentType: false,
                    data: fd,
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content');
                    // },
                    beforeSend: function() {
                       // App.startPageLoading({animate: true});
                        console.log('Show Loader');
                    },
                    success: function(res) {
                        if (res.status == '1')// in case genre added successfully
                        {
                            swal({
                                title: "Success!!",
                                text: res.message + ' Redirecting....',
                                type: "success",
                                showConfirmButton: false
                            });
                            $('.signin-form')[0].reset();
                            //redirect to dashboard
                            setTimeout(function() {//redirect to dashboard after 3 seconds
                                location.href = BASEURL + 'dashboard';
                            }, 2500);


                        } else { // in case error occuer
                            swal({
                                title: "Error!!",
                                text: res.message,
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Try Again!",
                            });
                            return false;
                        }
                    },
                    error: function(e) {

                       // App.stopPageLoading();
                        swal({
                            title: "Error!!",
                            text: e.statusText,
                            type: "error",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Try Again!",
                        });
                        //return false
                        return false;
                    },
                    complete: function() {
                       // App.stopPageLoading();
                    }
                }, "json");
                return false;

            }
        });
    }

    $('.signin-form input').keypress(function(e) {
        if (e.which == 13) {
            $('.signin-form').submit();
            return false;
        }
    });

    // forgot password code.
    var handleForgetPassword = function(e) {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email_fp: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email_fp: {
                    required: "Email address is required."
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit   

            },
            highlight: function(element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function(error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            submitHandler: function(form) {
                //define form data
                var fd = new FormData();
                //append data                
                $.each($('.forget-form').serializeArray(), function(i, obj) {
                    fd.append(obj.name, obj.value)
                });
                
                $.ajax({
                    url: BASEURL + 'forgotpassword',
                    type: "post",
                    processData: false,
                    contentType: false,
                    data: fd,
                    beforeSend: function() {
                        //App.startPageLoading({animate: true});
                    },
                    success: function(res) {
                        if (res.status == '1')// in case genre added successfully
                        {
                            //redirect to dashboard
                          //  App.stopPageLoading();
                            swal({
                                title: "Success!!",
                                text: res.message,
                                type: "success",
                                showConfirmButton: true,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "I Got It!!",
                            });
                            $('.forget-form')[0].reset();
                            return false;

                        } else { // in case error occue
                           // App.stopPageLoading();
                            swal({
                                title: "Error!!",
                                text: res.message,
                                type: "error",
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Try Again!",
                            });
                            return false;
                        }
                    },
                    error: function(e) {
                        //called when there is an error
                        //App.stopPageLoading();
                        swal({
                            title: "Error!!",
                            text: res.message,
                            type: "error",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Try Again!",
                        });
                        return false;
                    },
                    complete: function() {
                       // App.stopPageLoading();
                    }
                }, "json");
                return false;
            }
        });
    }

    $('.login-form input').keypress(function(e) {
        if (e.which == 13) {
            $('.login-form').submit();
            return false;
        }
    });
    $('.forget-form input').keypress(function(e) {
        if (e.which == 13) {
            $('.forget-form').submit();
            return false;
        }
    });

    return {
        //main function to initiate the module
        init: function() {

            handleLogin();
            handleForgetPassword();
        }

    };

}();

jQuery(document).ready(function() {
    Login.init();
});
$(document).ready(function(){

	$("#frmSignupStep1").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      search: "required",
      // lastname: "required",
      // email: {
      //   required: true,
      //   // Specify that email should be validated
      //   // by the built-in "email" rule
      //   email: true
      // },
      // password: {
      //   required: true,
      //   minlength: 5
      // }
    },
    // Specify validation error messages
    messages: {
      search: "Please select your address",
      // lastname: "Please enter your lastname",
      // password: {
      //   required: "Please provide a password",
      //   minlength: "Your password must be at least 5 characters long"
      // },
      // email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
    	search = $("#search").val(); 
              $("#search1").val(search);

    	$("#section1").hide();
    	$("#section2").show();
    	return false;
      form.submit();
    }
  });

	$("#frmSignupStep2").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      firstname: "required",
      lastname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 6
      },
      password_confirmation: {
        required: true,
        minlength: 6,
        equalTo: "#password"
      }
    },
    // Specify validation error messages
    messages: {
      firstname: "Please select your firstname",
      lastname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long"
      },

      password_confirmation: {
        required: "Please provide a confirm password",
        minlength: "Your confirm spassword must be at least 6 characters long",
        equalTo:"password and confirm password not match"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
    	// alert("form submitted successfully.");
    	// 
    	$("#email_alredy_registered").hide();

    	form_data = $("#frmSignupStep2").serialize();

    	url = API_BASE_URL+"user/register";

    	$.post(url,form_data,function(response){
    		//alert("response"+response);
    		window.location.href = BASE_URL+"/sign_up_success";

    	}).error(function(error) {
    		var array = $.map(error, function(value, index) {
			    return [value];
			});
    		
    		console.log(error.responseJSON.errors.email[0]);
	    	$("#email_alredy_registered").html(error.responseJSON.errors.email[0]);
	    	$("#email_alredy_registered").show();
		});
    	return false;

      form.submit();
    }
  });

	$("#signin").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        //minlength: 6
      },
     
    },
    // Specify validation error messages
    messages: {
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
    	// alert("form submitted successfully.");
    	// 
    	
    	$("#signin_error").hide();

    	form_data = $("#signin").serialize();

    	url = API_BASE_URL+"user/login";

    	$.post(url,form_data,function(response){
    		
    		form.submit();

    	}).error(function(error) {
    		var array = $.map(error, function(value, index) {
			    return [value];
			});
    		//alert(error);
    		//console.log(error.responseJSON.errors.email[0]);
	    	$("#signin_error").html(error.responseJSON.errors.email[0]);
	    	$("#signin_error").show();
		});

    	return false;

      
    }
  });

	// forgot password 

	

	$("#forgot_password").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      
     
    },
    // Specify validation error messages
    messages: {
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
    	// alert("form submitted successfully.");
    	// 
    	
    	$("#forgot_error").hide();
    	$("#forgot_success").hide();

    	form_data = $("#forgot_password").serialize();

    	url = API_BASE_URL+"user/resetpassword";

    	$.post(url,form_data,function(response){
    		$("#f_email").val('');
    		$("#forgot_success").html("Password reset link has been sent to your Email.");
	    	$("#forgot_success").show();
    	}).error(function(error) {
    		var array = $.map(error, function(value, index) {
			    return [value];
			});

         $("#forgot_error").html('Invalid email address.');
        $("#forgot_error").show();
    		//alert(error);
    		//console.log(error.responseJSON.errors.email[0]);
	    
		});

    	return false;

      
    }
  });

	$("#reselecte_address").click(function(){
		$("#section2").hide();
		$("#section1").show();
	});

	$("#forgot_password_btn").click(function(){
		$("#section_signin").hide();
		$("#section_forgot_password").show();
	});

	$("#signin_btn").click(function(){
		$("#section_forgot_password").hide();
		$("#section_signin").show();
		
	});

	
});
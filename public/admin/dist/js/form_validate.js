
// validator.resetForm();
$(function() {
  $("form[name='add-form-validate']").validate({
    rules : {
      type          : "required",
      first_name    : "required",
      last_name     : "required",
      email         : {
      	                required  : true,
                        email     : true
                      },
      password          : "required",
      confirm_password  : {
                            required      : true,
                            equalTo       : '#password'
                          },
      mobile_number     : {
                            required      : true,
                            digits        : true,
                            minlength     : 10
                          },
      user_name         : {
                            required        : true,
                            minlength       : 5,
                            remote          : {
                                                  url         : $("#meta-url").attr('name')+"/admin/users/username-check",
                                                  type        : "post"
                                               }
                            // data            : {
                            //                     username: function() {
                            //                     return $( "#username" ).val();
                            //                   }
                          }
    },

    messages: {  
      type              :  "Salesman type is required",
      first_name        :  "First name is required",
      last_name         :  "Last name is required",
      email             :  "Enter Valid Email-Address",
      password          :  "Password is required",
      confirm_password  : {
                              required        : "Confirm-Password is required",
                              equalTo         : "Confirm-Password is not matching from password",
                          },
      mobile_number     : {
                              required        : "Please Enter Valid Mobile Number",
                              digits          : "Enter Only Digits(123)",
                              minlength       : "Your mobile should be at least 10 digits long"
                          },
      user_name         : {
                              required        : "User name is required",
                              minlength       : "Your User name should be at atleast 5 character",
                              remote          : "User-Name already in record"
                          }
    }

  });
});
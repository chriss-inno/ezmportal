var Script = function () {
        $().ready(function() {

            // validate the comment form when it is submitted
        $("#commentForm").validate();

          //Department Form
            $("#DepartmentForm").validate({
                rules: {
                    branch_id: "required",
                    status: "required",
                    department_name: "required"
                },
                messages: {
                    branch_id: "Please select name",
                    status: "Please enter status",
                    department_name: "Please enter department name"
                }
            });
            //Validate service log form
            $("#serviceStatusForm").validate({
                rules: {
                    start_time: "required",
                    service_id: "required",
                    log_title: "required",

                    status: "required"
                },
                messages: {
                    service_id: "Please select service name",
                    log_title: "Please enter title",
                    start_time: "Please enter start time",
                    status: "Please select status"
                }
            });
        // validate signup form on keyup and submit
        $("#adminUserform").validate({
                rules: {
                    first_name: "required",
                    last_name: "required",
                    department: "required",
                    branch: "required",
                    phone: "required",
                    username:"required",
                    status:"required",
                    right:"required",
                    email: {
                        required: true,
                        email: true
                    },
                    Password: {
                        required: true,
                        minlength: 5
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 5,
                        equalTo: "#Password"
                    },
                    designation:"required"

                },
                messages: {
                    first_name: "Please enter  first name",
                    last_name: "Please enter  last name",
                    department: "Please select  department",
                    branch: "Please select  branch",
                    username:"Please enter username",
                    phone:"Please enter phone number",
                    status:"Please select status",
                    right:"Please select user access level",
                    email: {
                        required: "Please provide a password",
                        email: "Enter valid email address"
                    },
                    Password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    password_confirmation: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    designation: "Please enter full details of your designation"
                }

            });


        $("#signupForm").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                department: "required",
                branch: "required",
                phone: "required",
                Password: {
                    required: true,
                    minlength: 5
                },
                password_confirmation: {
                    required: true,
                    minlength: 5,
                    equalTo: "#Password"
                },
                designation: {
                    required: "#newsletter:checked"

                }
            },
            messages: {
                first_name: "Please enter your firstname",
                last_name: "Please enter your lastname",
                department: "Please select your department",
                branch: "Please select your branch",
                phone:"Please select your phone number",
                Password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                password_confirmation: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                designation: "Please enter full details of your designation"
            }

        });

            //Validate branch form
          $("#branchForm").validate({
                rules: {
                    branch_code: "required",
                    branch_Name: "required",
                    status: "required"
                },
                messages: {
                    branch_code: "Please enter your branch_code",
                    branch_Name: "Please enter your branch_Name",
                    status: "Please enter your status"
                }
            });

            //Validate branch form
            $("#moduleForm").validate({
                rules: {
                    module_name: "required",
                    department: "required",
                    status: "required"
                },
                messages: {
                    module_name: "Please enter  module_name",
                    department: "Please select department",
                    status: "Please enter module status"
                }
            });

            //Validate user login
            $("#UserLogin").validate({
                rules: {
                    username: "required",
                    password: "required"
                },
                messages: {
                    username: "Please enter your username",
                    password: "Please enter your password"
                }
            });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();
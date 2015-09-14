var Script = function () {
        $().ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();

        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                uspass: {
                    required: true,
                    minlength: 5
                },
                confirmuspass: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                designation: {
                    required: "#newsletter:checked"

                }
            },
            messages: {
                first_name: "Please enter your firstname",
                last_name: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                uspass: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirmuspass: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
                designation: "Please enter full details of your designation"
            }
            ,
            submitHandler: function(form)
            {
                var postData = $('#signupForm').serializeArray();
                var formURL = $('#signupForm').attr("action");
                $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success:function(data)
                        {
                        },
                        error: function(data)
                        {
                        }
                    });
            }
        });
        //Validate user login

            $("#UserLogin").validate({
                rules: {
                    username: "required",
                    password: "required",
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
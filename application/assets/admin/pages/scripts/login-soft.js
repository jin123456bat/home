var Login = function () {

	var handleLogin = function() {
		$('.login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                username: {
	                    required: true,
	                    minlength:4,
	                    maxlength:16
	                },
	                password: {
	                    required: true,
	                    minlength:4,
	                    maxlength:16
	                },
	                remember: {
	                    required: false
	                }
	            },

	            messages: {
	                username: {
	                    required: "请输入用户名.",
	                    minlength:"用户名长度太短",
	                    maxlength:"用户名长度太长"
	                },
	                password: {
	                    required: "请输入密码.",
	                    minlength:"密码长度太短",
	                    maxlength:"密码长度太长"
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit
	                $('.alert-danger', $('.login-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                var url = form.action,
	                	username = $('input[name=username]',form).val(),
	                	password = $('input[name=password]',form).val();
	                $.post(url,{username:username,password:password},function(data){
	                	if(data.code == 1)
	                	{
	                		window.location = 'index.php?c=admin&a=dashboard';
	                	}
	                	else
	                	{
	                		$('.alert-danger', $('.login-form')).show().html(data.result);
	                	}
	                });
	                return false;
	            }
	        });

	        $('.login-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.login-form').validate().form()) {
	                    $('.login-form').submit();
	                }
	                return false;
	            }
	        });

	}


    return {
        //main function to initiate the module
        init: function () {
        	
            handleLogin();

        }

    };

}();
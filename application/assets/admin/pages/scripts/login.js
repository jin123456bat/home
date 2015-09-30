var Login = function () {

	var handleLogin = function() {

		$('.login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                username: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	                remember: {
	                    required: false
	                }
	            },

	            messages: {
	                username: {
	                    required: "必须填写手机号."
	                },
	                password: {
	                    required: "必须填写密码."
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
	                //form.submit(); // form validation success, call ajax form submit
					var telephone = $(form).find('input[name=telephone]').val();
					var password = $(form).find('input[name=password]').val();
					$.post('index.php?c=o2o&a=login',{telephone:telephone,password:password},function(response){
						if(response.code == 1)
						{
							window.location = 'index.php?c=o2ocenter&a=index';
						}
						else
						{
							alert(response.result);
						}
					});
					return false;
	            }
	        });

	        $('.login-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.login-form').validate().form()) {
	                    $('.login-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	}

	var handleForgetPassword = function () {
		$('.forget-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                email: {
	                    required: true,
	                    email: true
	                }
	            },

	            messages: {
	                email: {
	                    required: "Email is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   

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
					var code = $(form).data('code');
					if(code == '1')
					{
						var telephone = $.trim($(form).find('input[name=telephone]').val());
						$.post('index.php?c=index&a=code',{telephone:telephone},function(response){
							response = $.parseJSON(response);
							if(response.code == 1)
							{
								$(form).find('.display-none').removeClass('display-none');
								$(form).find('button[type=submit]').html('更改密码 <i class="m-icon-swapright m-icon-white"></i>');
								$(form).data('code',0);
							}
							else
							{
								alert(response.result);
							}
						});
					}
					else
					{
						var telephone = $.trim($(form).find('input[name=telephone]').val());
						var code = $.trim($(form).find('input[name=code]').val());
						var password = $.trim($(form).find('input[name=password]').val());
						$.post('index.php?c=user&a=forgetpwd',{telephone:telephone,code:code,password:password},function(response){
							response = $.parseJSON(response);
							if(response.code == 1)
							{
								alert('密码修改成功');
								$('#back-btn').trigger('click');
							}
							else
							{
								alert(response.result);
							}
						});
					}
	            }
	        });

	        $('.forget-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.forget-form').validate().form()) {
	                    $('.forget-form').submit();
	                }
	                return false;
	            }
	        });

	        jQuery('#forget-password').click(function () {
	            jQuery('.login-form').hide();
	            jQuery('.forget-form').show();
	        });

	        jQuery('#back-btn').click(function () {
	            jQuery('.login-form').show();
	            jQuery('.forget-form').hide();
	        });

	}

    
    return {
        //main function to initiate the module
        init: function () {
        	
            handleLogin();
            handleForgetPassword();
                
	       
        }

    };

}();
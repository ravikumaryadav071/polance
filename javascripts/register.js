$(document).ready(function(){

	$('#username').keyup(function(){

		var username = $(this).val();
		u_name_len = username.length;

		if(u_name_len > 3){

			$.ajax({

				url: 'php_response_to_ajax/register.php?username='+username,
				type: 'POST',
				data: false,
				cache: false,
				cantentType: false,
				processData: false,
				success: function(data){

					$('#username_msg').html(data);

				}

			});

		}else{

			$('#username_msg').html('Your username must contain more than 3 characters.');

		}

	});

	$('#email').keyup(function(){

		var email = $(this).val();

		$.ajax({

			url: 'php_response_to_ajax/register.php?email='+email,
			type: 'POST',
			data: false,
			cache: false,
			cantentType: false,
			processData: false,
			success: function(data){

				$('#email_msg').html(data);

			}

		});

	});

	$('#contact_no').keyup(function(){

		var contact_no = $(this).val();

		$.ajax({

			url: 'php_response_to_ajax/register.php?contact_no='+contact_no,
			type: 'POST',
			data: false,
			cache: false,
			cantentType: false,
			processData: false,
			success: function(data){

				$('#contact_no_msg').html(data);

			}

		});

	});

	$('#name').keyup(function(){

		var name_len = $(this).length;

		if(name_len < 3){

			$('#name_msg').html('Your name must contain more than 2 characters');

		}else{

			$('#name_msg').fadeOut(400);

		}

	});

	$('#password').keyup(function(){

		var pass = $(this).val();
		var pass_len = pass.length;

		if(pass_len < 6){

			$('#password_msg').html('Your password must be atleast 6 characters long.');

		}else{

			$('#password_msg').html('Your password is valid.');			

		}

	});

	$('#password_again').keyup(function(){

		var pass_a = $(this).val();
		var pass = $('#password').val();

		if(pass_a != pass){

			$('#password_again_msg').html('Your passwords are not matching.');

		}else{

			$('#password_again_msg').html('Passwords matched.');

		}

	});

});
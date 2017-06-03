$(document).ready(function(){

	$('body').on('click', '#send_invites', function(){

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		var post_id = $(this).find('#popup_p_post_id').val();
		var user = $(this).find('#popup_p_user').val();
		var col_name = $('body #col_name').val();

		$.ajax({

			url: 'php_response_to_ajax/col_invitables.php?col='+col_name,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){

				$('body #light').css({
					'display' : 'block', 
					'top' : light_top
				});
				$('body #fade').css({
					'display' : 'block',
					'top' : fade_top
				});
				$('body #popup_content').html(data);

			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});

	});

	$('body').on('click', '#send_invitation', function(){

		var i_user = $(this).parent().find('#i_user').val();
		var col_name = $('body #col_name').val();
		var myThis = $(this);

		if(i_user != undefined){

			$.ajax({

				url: 'php_response_to_ajax/send_invitation.php?user='+i_user+'&col='+col_name,
				type: 'POST',
				data: false,
				cache: false,
				processData: false,
				contentType: false,
				success: function(data){
					myThis.parent().slideUp();
					$('body #message').html(data).show().fadeOut(1500);
				},
				error: function(){
					$('body #message').html('Connection to server failed.').show().fadeOut(1500);
				}

			});

		}

	});

});
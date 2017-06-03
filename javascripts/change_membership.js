$(document).ready(function(){

	$('body').on('click', '#change_membership', function(){

		var col_name = $('body #col_name').val();
		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		
		$.ajax({

			url: 'php_response_to_ajax/show_cm_members.php?col='+col_name,
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
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
				$('body #message').html('Connection to server lost.').show().fadeOut(1500);
			}

		});

	});

	$('body').on('click', '#add_to_founder', function(){

		var m_user = $(this).parent().find('#m_user').val();
		var col_name = $('body #col_name').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/change_membership.php?col='+col_name+'&user='+m_user,
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				$('body #message').html(data).show().fadeOut(1500);
				myThis.parent().slideUp(500);
			},
			error: function(){
				$('body #message').html('Connection to server lost.').show().fadeOut(1500);
			}

		});

	});

});
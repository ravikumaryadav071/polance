$(document).ready(function(){

	$('body').on('click', '#show_members', function(){

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		var col_name = $('body #col_name').val();

		$.ajax({

			url: 'php_response_to_ajax/show_col_members.php?col='+col_name,
			type: 'POST',
			cache: false,
			data: false,
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

});
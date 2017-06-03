$(document).ready(function(){

	$('body').on('click', '#show_ad', function(){

		var ad_id = $(this).parent().find('#ad_id').val();
		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		$.ajax({
			url: 'php_response_to_ajax/ad_details.php?ad='+ad_id,
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
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}
		});

	});

});
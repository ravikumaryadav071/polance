$(document).ready(function(){

	$('body').on('click', '#popup_search', function(){

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		$('body #light').css({
			'display' : 'block', 
			'top' : light_top
		});
		$('body #fade').css({
			'display' : 'block',
			'top' : fade_top
		});
		$('body #popup_content').html('<div id="popup_search_form"><form id="search_form" action="search.php" method="post"><input type="text" name="search_text" id="popup_search_text" placeholder="Serach by Name or Username" autocomplete="off"><input type="submit" name="search" id="search" value="search"></form><div id="serach_results"></div></div>');

	});

	$('body').on('keyup', '#popup_search_text', function(){

		var st = $(this).val();
		st = st.trim();
		var myThis = $(this);
		if(st != ""){

			$.ajax({

				url: 'php_response_to_ajax/popup_user_search.php?text='+st,
				type: 'POST',
				data: false,
				cache: false,
				processData: false,
				contentType: false,
				success: function(data){
					myThis.parent().parent().find('#serach_results').html(data);
				},
				error: function(){
					$('body #message').html('Connection to server failed.').show().fadeOut(1500);
				}

			});

		}else{
			myThis.parent().parent().find('#serach_results').html('');
		}

	});

});
var prev_result = ''; //previous result
$(document).ready(function(){
	// alert("here");

	$('#load_more').hide();
	$('input[hidden="hidden"]').hide();
	$(window).scroll(function(){

		if ($(window).scrollTop() == ($(document).height() - $(window).height())){
			if(prev_result != 'No more posts.'){
				
				$("#load_more").fadeIn();
				var end_feed = $("#end_feed:last").val();
				var p_user = $("#profile").val();
				//alert(end_feed+' '+p_user);
				$.ajax({

					url: 'php_response_to_ajax/autoload_profile_feeds.php?end_feed='+end_feed+'&user='+p_user,
					type: 'POST',
					data: false,
					contentType: false,
					cache: false,
					processData: false,
					success: function(data){
						$("#load_more").fadeOut();
						$("#load_more").before(data);
						
						$('body #post').each(function(){

							if($(this).parent().find('#see_more').html() == undefined){

								if($(this).height() > 50){

									$(this).css({
										'height' : '50px',
										'overflow' : 'hidden'			
									});

									$(this).after('<div id="see_more"><a href="javascript: void(0)">Show More</a></div>');
								}
								
							}

						});

						if(data == 'No more posts.'){
							prev_result = data;
						}
						$('body #post').draggable({
							revert: function(event, ui){
								$('body #my_collection').slideUp(300);
								return true;
							}, 

							drag: function(event, ui){

								var cb_pos = $('body #collection_box').offset();
								var	cb_t = cb_pos.top;
								var	cb_l = cb_pos.left;
								var	cb_r = cb_l + $('body #collection_box').width();
								var	cb_b = cb_t + $('body #collection_box').height();

								var this_pos = $(this).offset();
								var tp_t = this_pos.top;
								var tp_l = this_pos.left;
								var tp_b = tp_t + $(this).height();
								var tp_r = tp_l + $(this).width();
								if(tp_t<cb_t && tp_l<cb_l && tp_r<cb_r && tp_b>cb_b){
									$('body #my_collection').slideDown(300);
								}
							}

						});
					},
					error: function(){
						$("#load_more").fadeOut();
						$("body #message").before('<p>There is some problem in loading the data.</p>');
					}

				});

				$('input[hidden="hidden"]').hide();

			}

		}
	
	});

});
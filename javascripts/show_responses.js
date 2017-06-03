$(document).ready(function(){

	$('body').on('click', '#up_count', function(){

		var user = $(this).parent().parent().parent().find('#user').val();
		var post_id = $(this).parent().parent().parent().find('#post_id').val();
		var post_type = $(this).parent().parent().parent().find('#post_type').val();

		if(user==undefined && post_id==undefined && post_type==undefined){
			user = $(this).parent().parent().parent().find('#col_name').val();
			post_id = $(this).parent().parent().parent().find('#col_post_id').val();
			post_type = 'COLLABORATION';
		}

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		$.ajax({
			url: 'php_response_to_ajax/show_responses.php?user='+user+'&post_id='+post_id+'&post_type='+post_type+'&list=UPVOTE',
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
				$('body #message').html('Connection to server lost.').show().fadeOut(1500);
			}
		});

	});

	$('body').on('click', '#share_count', function(){

		var user = $(this).parent().parent().parent().find('#user').val();
		var post_id = $(this).parent().parent().parent().find('#post_id').val();
		var post_type = $(this).parent().parent().parent().find('#post_type').val();

		if(user==undefined && post_id==undefined && post_type==undefined){
			user = $(this).parent().parent().parent().find('#col_name').val();
			post_id = $(this).parent().parent().parent().find('#col_post_id').val();
			post_type = 'COLLABORATION';
		}

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		$.ajax({
			url: 'php_response_to_ajax/show_responses.php?user='+user+'&post_id='+post_id+'&post_type='+post_type+'&list=SHARE',
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
				$('body #message').html('Connection to server lost.').show().fadeOut(1500);
			}
		});

	});

	$('body').on('click', '#varify_count', function(){

		var user = $(this).parent().parent().parent().find('#user').val();
		var post_id = $(this).parent().parent().parent().find('#post_id').val();
		var post_type = $(this).parent().parent().parent().find('#post_type').val();

		if(user==undefined && post_id==undefined && post_type==undefined){
			user = $(this).parent().parent().parent().find('#col_name').val();
			post_id = $(this).parent().parent().parent().find('#col_post_id').val();
			post_type = 'COLLABORATION';
		}

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;

		$.ajax({
			url: 'php_response_to_ajax/show_responses.php?user='+user+'&post_id='+post_id+'&post_type='+post_type+'&list=VARIFY',
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
				$('body #message').html('Connection to server lost.').show().fadeOut(1500);
			}
		});

	});

	$('body').on('click', '#collect_count', function(){

		var user = $(this).parent().parent().parent().find('#user').val();
		var post_id = $(this).parent().parent().parent().find('#post_id').val();
		var post_type = $(this).parent().parent().parent().find('#post_type').val();

		if(user==undefined && post_id==undefined && post_type==undefined){
			user = $(this).parent().parent().parent().find('#col_name').val();
			post_id = $(this).parent().parent().parent().find('#col_post_id').val();
			post_type = 'COLLABORATION';
		}

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		
		$.ajax({
			url: 'php_response_to_ajax/show_responses.php?user='+user+'&post_id='+post_id+'&post_type='+post_type+'&list=COLLECT',
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
				$('body #message').html('Connection to server lost.').show().fadeOut(1500);
			}
		});

	});

});
var clickCount = 0;

$(document).ready(function(){

	$('body').on('click', '#col_upvote', function(){

		var count = $(this).parent().parent().find('#counts');
		var up_count = parseInt(count.find('#up_count').html());
		var post_id = $(this).parent().find('#col_post_id').val();
		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/col_posts_responses.php?col='+col_name+'&post_id='+post_id+'&action=UPVOTE',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data != 'Failed'){
					up_count++;
					count.find('#up_count').html(up_count);
					myThis.hide();
					myThis.parent().find('#col_upvoted').show();
				}else{
					$('body #message').html(data).show().fadeOut(1500);
				}

				myThis.parent().find('#col_downvote').attr('disabled', 'disabled');
				myThis.parent().find('#col_downvoted').attr('disabled', 'disabled');

			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});


	});

	$('body').on('click', '#col_upvoted', function(){

		var count = $(this).parent().parent().find('#counts');
		var up_count = parseInt(count.find('#up_count').html());
		var post_id = $(this).parent().find('#col_post_id').val();
		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/col_posts_responses.php?col='+col_name+'&post_id='+post_id+'&action=UNUPVOTE',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data != 'Failed'){
					up_count--;
					count.find('#up_count').html(up_count);
					myThis.hide();
					myThis.parent().find('#col_upvote').show();
				}else{
					$('body #message').html(data).show().fadeOut(1500);
				}
				myThis.parent().find('#col_downvote').removeAttr('disabled');
				myThis.parent().find('#col_downvoted').removeAttr('disabled');
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});


	});

	$('body').on('click', '#col_downvote', function(){

		var count = $(this).parent().parent().find('#counts');
		var down_count = parseInt(count.find('#down_count').html());
		var post_id = $(this).parent().find('#col_post_id').val();
		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/col_posts_responses.php?col='+col_name+'&post_id='+post_id+'&action=DOWNVOTE',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data != 'Failed'){
					down_count++;
					count.find('#down_count').html(down_count);
					myThis.hide();
					myThis.parent().find('#col_downvoted').show();
				}else{
					$('body #message').html(data).show().fadeOut(1500);
				}
				myThis.parent().find('#col_upvote').attr('disabled', 'disabled');
				myThis.parent().find('#col_upvoted').attr('disabled', 'disabled');
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});


	});

	$('body').on('click', '#col_downvoted', function(){

		var count = $(this).parent().parent().find('#counts');
		var down_count = parseInt(count.find('#down_count').html());
		var post_id = $(this).parent().find('#col_post_id').val();
		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/col_posts_responses.php?col='+col_name+'&post_id='+post_id+'&action=UNDOWNVOTE',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data != 'Failed'){
					down_count--;
					count.find('#down_count').html(down_count);
					myThis.hide();
					myThis.parent().find('#col_downvote').show();
				}else{
					$('body #message').html(data).show().fadeOut(1500);
				}

				myThis.parent().find('#col_upvote').removeAttr('disabled');
				myThis.parent().find('#col_upvoted').removeAttr('disabled');

			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});


	});

	$('body').on('click', '#col_varify', function(){

		var count = $(this).parent().parent().find('#counts');
		var varify_count = parseInt(count.find('#varify_count').html());
		var post_id = $(this).parent().find('#col_post_id').val();
		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/col_posts_responses.php?col='+col_name+'&post_id='+post_id+'&action=VARIFY',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data != 'Failed'){
					varify_count++;
					count.find('#varify_count').html(varify_count);
					myThis.hide();
					myThis.parent().find('#col_varified').show();
				}else{
					$('body #message').html(data).show().fadeOut(1500);
				}
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});


	});

	$('body').on('click', '#col_varified', function(){

		var count = $(this).parent().parent().find('#counts');
		var varify_count = parseInt(count.find('#varify_count').html());
		var post_id = $(this).parent().find('#col_post_id').val();
		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/col_posts_responses.php?col='+col_name+'&post_id='+post_id+'&action=UNVARIFY',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data != 'Failed'){
					varify_count--;
					count.find('#varify_count').html(varify_count);
					myThis.hide();
					myThis.parent().find('#col_varify').show();
				}else{
					$('body #message').html(data).show().fadeOut(1500);
				}
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});


	});

	$('body').on('click', '#col_report', function(){

		var post_id = $(this).parent().find('#col_post_id').val();
		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/col_posts_responses.php?col='+col_name+'&post_id='+post_id+'&action=REPORT',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data != 'Failed'){
					myThis.hide();
					myThis.parent().find('#col_reported').show();
				}else{
					$('body #message').html(data).show().fadeOut(1500);
				}

			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});


	});

	$('body').on('click', '#col_reported', function(){

		var post_id = $(this).parent().find('#col_post_id').val();
		var col_name = $(this).parent().find('#col_name').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/col_posts_responses.php?col='+col_name+'&post_id='+post_id+'&action=UNREPORT',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data != 'Failed'){
					myThis.hide();
					myThis.parent().find('#col_report').show();
				}else{
					$('body #message').html(data).show().fadeOut(1500);
				}
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});


	});

	$('body').on('click', '#col_comment', function(){
		$(this).stop();
		clickCount++;
		if(clickCount == 1){
			$(this).parent().find('#comment_here').slideDown(500);
		}else{
			clickCount = 0;
			$(this).parent().find('#comment_here').slideUp(500);
		}

	});

	$('body').on('submit', '#col_comment_form', function(e){
		$(this).stop();
		e.preventDefault();
		var comment_box = $(this).find('#comment_text');
		var comment_text = comment_box.val();
		comment_text = comment_text.trim();
		var count = $(this).parent().parent().parent().find('#counts');
		var comment_count = count.find('#comment_count');
		var counter = parseInt(comment_count.html());
		myThis = $(this);

		if(comment_text == ""){
			$('body #message').html('Do not have any input.').show().fadeOut(1500);
		}else{
			
			$.ajax({

				url: 'php_response_to_ajax/submit_col_comment.php',
				type: 'POST',
				data: new FormData(this),
				cache: false,
				contentType: false,
				processData: false,
				success: function(data){

					$('body #message').html(data).show().fadeOut(1500);
					counter++;
					comment_count.html(counter);
					comment_box.val('');
					
				},
				error: function(){
					
					$('body #message').html('Connection to server failed.').show().fadeOut(1500);
					
				}

			});

		}

	});

	$('body').on('click', '#show_col_comments', function(){

		$(this).stop();
		var parent = $(this).parent().parent().parent();
		var post_id = parent.find('#col_post_id').val();
		var col_name = parent.find('#col_name').val();
		var last_seen = $(this).parent().find('#last_seen').val();
		var myThis = $(this);
		$(this).hide();

		if(last_seen == undefined){
			last_seen = 'UNDEFINED';
			$(this).after('<a href="javascript: void(0)" id="hide_comments">Hide</a>');
		}

		$.ajax({

			url: 'php_response_to_ajax/show_col_comments.php?post_id='+post_id+'&col_name='+col_name+'&last_seen='+last_seen,
			type: 'POST',
			data: false ,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){

				myThis.hide();
				myThis.after(data).slideDown(1500);
				myThis.remove();
			},
			error: function(){
				
				$('body #message').html('Connection to server failed').show().fadeOut(1800);

			}

		});

	});

	$('body').on('click', '#hide_comments', function(){

		$(this).parent().parent().slideUp(500);

	});

});
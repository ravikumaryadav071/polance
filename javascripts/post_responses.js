$(document).ready(function(){

	$('[hidden="hidden]"').hide();

	$('body').on('click', '#upvote', function(){

		$(this).stop();
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();
		var count = $(this).parent().parent().find('#counts');
		var up_count = count.find('#up_count');
		var counter = parseInt(up_count.html());
		var myThis = $(this);
		$.ajax({

			url: 'php_response_to_ajax/post_responses.php?post_id='+post_id+'&user='+user+'&post_type='+post_type+'&action=UPVOTE',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentTyype: false,
			success: function(data){

				if(data != 'Already upvoted.'){

					myThis.hide();
					myThis.parent().find('#upvoted').show();
					counter++;
					up_count.html(counter);
					
				}else{

					$('body #message').html(data).show().fadeOut(1500);
					myThis.hide();
					myThis.parent().find('#upvoted').show().fadeOut(1500);

				}

				myThis.parent().find('#downvote').attr('disabled', 'disabled');
				myThis.parent().find('#downvoted').attr('disabled', 'disabled');

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});

	});

	$('body').on('click', '#upvoted', function(){

		$(this).stop();
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();
		var count = $(this).parent().parent().find('#counts');
		var up_count = count.find('#up_count');
		var counter = parseInt(up_count.html());
		var myThis = $(this);
		
		$.ajax({

			url: 'php_response_to_ajax/post_responses.php?post_id='+post_id+'&user='+user+'&post_type='+post_type+'&action=UNUPVOTE',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentTyype: false,
			success: function(data){

				if(data != 'Have not upvoted.'){

					myThis.hide();
					myThis.parent().find('#upvote').show();
					counter--;
					up_count.html(counter);

				}else{

					$('body #message').html(data).show().fadeOut(1500);
					myThis.hide();
					myThis.parent().find('#upvote').show();

				}

				myThis.parent().find('#downvote').removeAttr('disabled');
				myThis.parent().find('#downvoted').removeAttr('disabled');

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
				
			}

		});

	});

	$('body').on('click', '#downvote', function(){

		$(this).stop();
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();
		var count = $(this).parent().parent().find('#counts');
		var down_count = count.find('#down_count');
		var counter = parseInt(down_count.html());
		var myThis = $(this);
		
		$.ajax({

			url: 'php_response_to_ajax/post_responses.php?post_id='+post_id+'&user='+user+'&post_type='+post_type+'&action=DOWNVOTE',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentTyype: false,
			success: function(data){

				if(data != 'Already downvoted.'){

					myThis.hide();
					myThis.parent().find('#downvoted').show();
					counter++;
					down_count.html(counter);

				}else{

					$('body #message').html(data).show().fadeOut(1500);
					myThis.hide();
					myThis.parent().find('#downvoted').show();

				}

				myThis.parent().find('#upvote').attr('disabled', 'disabled');
				myThis.parent().find('#upvoted').attr('disabled', 'disabled');

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);

			}

		});

	});

	$('body').on('click', '#downvoted', function(){

		$(this).stop();
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();
		var count = $(this).parent().parent().find('#counts');
		var down_count = count.find('#down_count');
		var counter = parseInt(down_count.html());
		var myThis = $(this);
		
		$.ajax({

			url: 'php_response_to_ajax/post_responses.php?post_id='+post_id+'&user='+user+'&post_type='+post_type+'&action=UNDOWNVOTE',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentTyype: false,
			success: function(data){

				if(data != 'Have not downvoted.'){

					myThis.hide();
					myThis.parent().find('#downvote').show();
					counter--;
					down_count.html(counter);

				}else{

					$('body #message').html(data).show().fadeOut(1500);
					myThis.hide();
					myThis.parent().find('#downvote').show();

				}

				myThis.parent().find('#upvote').removeAttr('disabled');
				myThis.parent().find('#upvoted').removeAttr('disabled');
				
			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
				
			}

		});

	});

	$('body').on('click', '#share', function(){

		$(this).stop();
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();
		var count = $(this).parent().parent().find('#counts');
		var share_count = count.find('#share_count');
		var counter = parseInt(share_count.html());
		var myThis = $(this);
		
		$.ajax({

			url: 'php_response_to_ajax/post_responses.php?post_id='+post_id+'&user='+user+'&post_type='+post_type+'&action=SHARE',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentTyype: false,
			success: function(data){

				if(data != 'Already shared.'){

					myThis.hide();
					myThis.parent().find('#shared').show();
					counter++;
					share_count.html(counter);
					
				}else{

					$('body #message').html(data).show().fadeOut(1500);
					myThis.hide();
					myThis.parent().find('#shared').show();

				}

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);

			}

		});

	});

	$('body').on('click', '#shared', function(){

		$(this).stop();
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();
		var count = $(this).parent().parent().find('#counts');
		var share_count = count.find('#share_count');
		var counter = parseInt(share_count.html());
		var myThis = $(this);
		
		$.ajax({

			url: 'php_response_to_ajax/post_responses.php?post_id='+post_id+'&user='+user+'&post_type='+post_type+'&action=UNSHARE',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentTyype: false,
			success: function(data){

				if(data != 'Have not shared.'){

					myThis.hide();
					myThis.parent().find('#share').show();
					counter--;
					share_count.html(counter);

				}else{

					$('body #message').html(data).show().fadeOut(1500);
					myThis.hide();
					myThis.parent().find('#share').show();

				}

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);

			}

		});

	});

	$('body').on('click', '#varify', function(){

		$(this).stop();
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();
		var count = $(this).parent().parent().find('#counts');
		var varify_count = count.find('#varify_count');
		var counter = parseInt(varify_count.html());
		var myThis = $(this);
		
		$.ajax({

			url: 'php_response_to_ajax/post_responses.php?post_id='+post_id+'&user='+user+'&post_type='+post_type+'&action=VARIFY',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentTyype: false,
			success: function(data){

				if(data != 'Already verified.'){

					myThis.hide();
					myThis.parent().find('#varified').show();
					counter++;
					varify_count.html(counter);

				}else{

					$('body #message').html(data).show().fadeOut(1500);
					myThis.hide();
					myThis.parent().find('#varified').show();

				}

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
				
			}

		});

	});

	$('body').on('click', '#varified', function(){

		$(this).stop();
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();
		var count = $(this).parent().parent().find('#counts');
		var varify_count = count.find('#varify_count');
		var counter = parseInt(varify_count.html());
		var myThis = $(this);
		
		$.ajax({

			url: 'php_response_to_ajax/post_responses.php?post_id='+post_id+'&user='+user+'&post_type='+post_type+'&action=UNVARIFY',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentTyype: false,
			success: function(data){

				if(data != 'Have not verified.'){

					myThis.hide();
					myThis.parent().find('#varify').show();
					counter--;
					varify_count.html(counter);

				}else{

					$('body #message').html(data).show().fadeOut(1500);
					myThis.hide();
					myThis.parent().find('#varify').show();

				}

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
				
			}

		});

	});

	$('body').on('click', '#report', function(){

		$(this).stop();
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();
		var myThis = $(this);
		$.ajax({

			url: 'php_response_to_ajax/post_responses.php?post_id='+post_id+'&user='+user+'&post_type='+post_type+'&action=REPORT',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentTyype: false,
			success: function(data){

				if(data != 'Already reported.'){

					myThis.hide();
					myThis.parent().find('#reported').show();

				}else{

					$('body #message').html(data);
					myThis.hide();
					myThis.parent().find('#reported').show();

				}

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});

	});

	$('body').on('click', '#reported', function(){

		$(this).stop();
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();
		var myThis = $(this);
		$.ajax({

			url: 'php_response_to_ajax/post_responses.php?post_id='+post_id+'&user='+user+'&post_type='+post_type+'&action=UNREPORT',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentTyype: false,
			success: function(data){

				if(data != 'Have not reported.'){

					myThis.hide();
					myThis.parent().find('#report').show();
					
				}else{

					$('body #message').html(data).show().fadeOut(1500);
					myThis.hide();
					myThis.parent().find('#report').show();

				}

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});

	});

	$('body').on('click', '#comment', function(){

		$(this).parent().find('#comment_here').slideDown(500);

	});

	$('body').on('submit', '#comment_form', function(e){
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

				url: 'php_response_to_ajax/submit_comment.php',
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

	$('body').on('click', '#show_comments', function(){

		$(this).stop();
		var parent = $(this).parent().parent().parent();
		var post_id = parent.find('#post_id').val();
		var user = parent.find('#user').val();
		var post_type = parent.find('#post_type').val();
		var last_seen = $(this).parent().find('#last_seen').val();
		var myThis = $(this);
		$(this).hide();

		if(last_seen == undefined){
			last_seen = 'UNDEFINED';
			$(this).after('<a href="javascript: void(0)" id="hide_comments">Hide</a>');
		}

		$.ajax({

			url: 'php_response_to_ajax/show_comments.php?post_id='+post_id+'&post_type='+post_type+'&user='+user+'&last_seen='+last_seen,
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

		$(this).parent().parent().slideUp(1000);

	});

});
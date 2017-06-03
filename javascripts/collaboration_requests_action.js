var clickCount = 0;
$(document).ready(function(){

	$('body').on('click', '#show_requests', function(){

		clickCount++;
		if(clickCount == 1){

			var col_name = $(this).parent().find('#col_name').val();
			myThis = $(this);
			$.ajax({

				url: 'php_response_to_ajax/show_collaboration_requests.php?col='+col_name,
				type: 'POST',
				data: false,
				cache: false,
				processData: false,
				contentType: false,
				success: function(data){
					myThis.parent().find('#display_requests').html(data).slideDown(500);
				},
				error: function(){
					$('body #message').html('Connection to server failed.').show().fadeOut(1500);
				}

			});

		}else{

			clickCount = 0;
			$(this).parent().find('#display_requests').slideUp(500);

		}

	});

	$('body').on('click', '#accept', function(){

		var col_name = $(this).parent().find('#col_name').val();
		var user = $(this).parent().find('#user').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/collaboration_request_action.php?col='+col_name+'&user='+user+'&type=ACCEPT',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				myThis.parent().slideUp(500);
				setTimeout(function(){
					myThis.parent().remove();
				}, 500);
			},
			error: function(){
				$('body message').html('Connection to server failed').show().fadeOut(1500);
			}


		});

	});

	$('body').on('click', '#reject', function(){

		
		var col_name = $(this).parent().find('#col_name').val();
		var user = $(this).parent().find('#user').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/collaboration_request_action.php?col='+col_name+'&user='+user+'&type=REJECT',
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				myThis.parent().slideUp(500);
				setTimeout(function(){
					myThis.parent().remove();
				}, 500);
			},
			error: function(){
				$('body message').html('Connection to server failed').show().fadeOut(1500);
			}


		});

	});

	setInterval(function(){

		var col_name = $('body #col_name:first').val();

		$.ajax({

			url: 'php_response_to_ajax/collaboration_requests_counter.php?col='+col_name,
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				if(data != '0'){
					$('body #request_count').html(data);
				}
			},

		});

	}, 5000);

});
$(document).ready(function(){

	$('body').on('click', '#unblock', function(){

		var f_user = $(this).parent().find('#f_user').val();
		var myThis = $(this);

		$.ajax({
			url: 'php_response_to_ajax/unblock_feeders.php?user='+f_user,
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				myThis.parent().slideUp(300);
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}
		});

	});

});
$(document).ready(function(){

	$('body').on('click', '#post', function(){
		
		var post_id = $(this).parent().find('#post_id').val();
		var user = $(this).parent().find('#user').val();
		var post_type = $(this).parent().find('#post_type').val();

		if(post_id != undefined && user != undefined && post_type != undefined){

			var win = window.open();
			win.location = 'interests.php?post='+post_id+'&user='+user+'&type='+post_type;

		}else{
			
			user = $(this).parent().find('#col_name').val();
			post_id = $(this).parent().find('#col_post_id').val();
			post_type = 'COLLABORATION';
			if(post_id != undefined && user != undefined && post_type != undefined){

				var win = window.open();
				win.location = 'collaboration.php?col='+user+'&post_id='+post_id;
				
			}

		}
		
	});

});
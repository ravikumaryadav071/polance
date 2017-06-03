$(document).ready(function(){

	$('body').on('keyup', '#col_text', function(){

		var col_name = $(this).val();
		col_name = col_name.trim();

		if(col_name != ""){
			$.ajax({
				url: 'php_response_to_ajax/collaboration_sugsn.php?col_name='+col_name,
				type: 'POST',
				data: false,
				cache: false,
				processData: false,
				contentType: false ,
				success: function(data){
					var str = data;
					var show = str.split(",");
					$("#col_text").autocomplete({
						source: show
					});
				}
			});

		}

	});

});
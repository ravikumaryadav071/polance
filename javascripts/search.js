$(document).ready(function(){

	$('#search_text').keyup(function(){
		var search_text = $(this).val();
		$.ajax({
			url: 'php_response_to_ajax/search.php?search_text='+search_text,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){

				var str = data;
				var show = str.split(",");

				$("#search_text").autocomplete({
					source: show
				});

			}
		});
	});

});
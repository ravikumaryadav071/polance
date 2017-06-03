$(document).ready(function(){

	$('body').on('click', '#replace_file', function(){

		//var check = $(this).attr('checked');
		var check = $(this).prop('checked');
		if(check){
			
			$(this).parent().append('<input type="file" id="file" name="file[]">');

		}else{

			$(this).parent().find('#file').remove();

		}

	});

	$('body').on('click', '#add_files', function(){

		$(this).before('<div><input type="file" id="file" name="file[]"></div><textarea name="read_text[]"></textarea>');

	});

});
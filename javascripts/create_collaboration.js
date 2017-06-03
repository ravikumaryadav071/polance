$(document).ready(function(){

	$('body').on('keyup', '#add_tags', function(){

		var search_text = $(this).val();

		$.ajax({

			url: 'php_response_to_ajax/posts_interests_suggestions.php?search='+search_text,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){
				$('body #suggested_tags').html(data).slideDown(1000);
			},
			error: function(){

				$('body #message').html('Connection to server failed').show().fadeOut(1500);

			}

		});

	});

	$('body').on('click', '#add_interest', function(){

		$(this).parent().find('#interest_id').attr('name', 'interest_id[]');
		$(this).parent().find('#interest_name').attr('name', 'interest_name[]');
		$(this).parent().find('#search_id').attr('name', 'search_id[]');
		$(this).parent().find('#catagory_id').attr('name', 'catagory_id[]');
		$(this).hide();
		var content = $(this).parent().html();
		removeThis = $(this).parent();
		$(this).parent().slideUp(500);
		setTimeout(function(){
			removeThis.remove();
		},500);

		var append = true;
		$('body #added_tags div').each(function(){
			if($(this).html() == content){
				append = false;
				return false;
			}
		});

		if(append){

			appendHere = $('body #added_tags div:first').html();

			if(appendHere==undefined){
				$('body #added_tags').append('<div>'+content+'</div>').slideDown(500);
			}else{
				$('body #added_tags div:first').after('<div>'+content+'</div>').slideDown(500);
			}

		}else{

			$('body #message').html('This tag already added.').show().fadeOut(2000);

		}

	});

	$('body').on('submit', '#create_col_form', function(e){

		var added_tags = $('body #added_tags').html();
		added_tags = added_tags.trim();
		if(added_tags == ""){
			e.preventDefault();
			$('body #message').html('Select at least one interest.').show().fadeOut(1800);
		}

		var col_name = $('body #col_name').val();

		if(col_name == ""){
			e.preventDefault();
			$('body #message').html('Enter collaboration name.').show().fadeOut(1800);	
		}

		if(col_name != undefined && col_name != ""){
			var textExp = /^[a-zA-Z\s]+$/i;
			var passed = textExp.test(col_name);
		}

		if(!passed && col_name != ""){
			e.preventDefault();
			$('body #message').html('Name must contain only alphabets/spaces.').show().fadeOut(2000);
		}

	});

	$('body').on('keyup', '#col_name', function(){

		var col_name = $(this).val();
		if(col_name != undefined && col_name != ""){
			var textExp = /^[a-zA-Z\s]+$/i;
			var passed = textExp.test(col_name);
		}

		if(!passed && col_name != ""){
			$('body #message').html('Name must contain only alphabets/spaces.').show().fadeOut(2000);
		}

	});

	$('body').on('keyup', '#col_name', function(){

		var col_name = $(this).val();
		col_name = col_name.trim();
		myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/collaboration_name_sugsn.php?name='+col_name,
			type: 'POST',
			data: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data){
				myThis.parent().find('#col_name_sugsn').html(data);
			}

		});

	});

});
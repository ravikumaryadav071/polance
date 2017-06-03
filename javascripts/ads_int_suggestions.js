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

});
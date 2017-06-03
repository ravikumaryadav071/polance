$(document).ready(function(){

	$('body').on('keyup', '#interests_input',function(){

		var search_text = $(this).val();
		search_text = search_text.trim();

		$.ajax({
			url: 'php_response_to_ajax/my_interests_suggestions.php?search='+search_text,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){

				// alert(data);
				$('body #suggestions').html(data).slideDown(500);

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(1500);

			}
		});

	});

	$('body').on('submit', '#add_interests_form', function(e){

		e.preventDefault();
		var search_text = $(this).find('#interests_input').val();
		$(this).remove();
		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;	
		
		$('body #light').css({
			'display' : 'block', 
			'top' : light_top
		});
		$('body #fade').css({
			'display' : 'block',
			'top' : fade_top
		});

		$('body #suggestions').before('<form id="add_interests_form" action="" method="POST"><input type="text" id="interests_input" name="interests_input" value="" placeholder="Add Existing/New Interest(s)"><input type="submit" id="add_new_interest" value="Add New"></form>');
		$('body #popup_content').html('<div id="popup_inerest">Add New Interest<form id="popup_inerest_form" action="" method="POST"><label for="add_to_interests">Interest</label><input type="text" id="add_to_interests" name="add_to_interests" value="'+search_text+'"><label for="main_domain">Main Interest Domain:</label><select id="main_domain" name="main_domains[]" multiple="multiple" size="3"><option name="None" selected="selected">None<option name="Business">Business<option name="Corporate World">Corporate World<option name="Education">Education<option name="Finance">Finance<option name="Philosophy">Philosophy<option name="Politics">Politics<option name="Social">Social<option name="Sports">Sports</select><div><input type="text" id="sub_domian_text" value="" placeholder="Add Sub-domain to help us in accurate page location (Optional)."><div id="popup_suggestions"></div><input type="submit" value="Submit"><div id="added_sudomains"></div></form></div>').show();
	
	});
	
	//////////////////////

	$('body').on('click', '#popup_add_interest', function(){

		var int_id = $(this).parent().find('#interest_id').val();
		var interest_name = $(this).parent().find('#interest_name').val();
		var search_id = $(this).parent().find('#search_id').val();
		var show_name = $(this).parent().find('p').html();
		var init_char = interest_name.trim().substring(0, 1);
		$(this).parent().slideUp(500);
		//var exists = false;
		//var checkIt = {int_id1: int_id, int_name1: interest_name, s_id1: search_id};
		
		var exists = checkIt(int_id, interest_name, search_id);
		if(!exists){
			$('body #added_sudomains').append('<div><p>'+show_name+'<input type="hidden" id="interest_id" name="sub_interests_db_id[]" value="'+int_id+'"><input type="hidden" name="sub_interests_init[]" value="'+init_char+'"><input type="hidden" id="interest_name" value="'+interest_name+'"><input type="hidden" id="search_id" name="sub_interests_st_id[]" value="'+search_id+'"><a href="javascript: void(0)" id="remove_added_subdomain">Remove</a></p></div>');
		}else{
			$('body #message').html('Already added this interest.').show().fadeOut(1800);
		}

	});

	$('body').on('click', '#remove_added_subdomain', function(){

		$(this).parent().parent().remove();

	});

	$('body').on('keyup', '#sub_domian_text', function(){

		var search_text = $(this).val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/popup_interests_suggestions.php?search='+search_text,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){

				//alert('here');
				$('body #popup_content #popup_suggestions').html(data);

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(332500);

			}
		});

	});

	$('body').on('submit', '#popup_inerest_form', function(e){

		e.preventDefault();
		var select = $('body #main_domain').val();
		var int_name = $('body #add_to_interests').val();
		if(int_name != undefined){
			var init_char = int_name.trim().substring(0, 1);
			var textExp = /^[a-zA-Z\s]+$/i;
			var passed = textExp.test(int_name);
		}
		
		if(select != 'None'){

			if(passed){
				$.ajax({

					url: 'php_response_to_ajax/add_new_interest.php',
					type: 'POST',
					data: new FormData(this),
					cache: false,
					contentType: false,
					processData: false,
					success: function(data){
						$('body #message').html(data).show();
						//$('body #message').html(data);
						$('body #light').css('display', 'none');
						$('body #fade').css('display', 'none');
						$('body #popup_content').hide();

					},
					error: function(){

						$('body #message').html('Connection to server failed.').show().fadeOut(332500);

					}

				});
			}else{
				
				$('body #message').html('Your interest must have alphabets and spaces only.').show().fadeOut(333000);

			}

		}else{

			$('body #message').html('Select at least one interest domain.').show().fadeOut(333000);

		}

	});

	$('body').on('click', '#add_interest', function(){

		$(this).stop();
		var int_id = $(this).parent().find('#interest_id').val();
		var interest_name = $(this).parent().find('#interest_name').val();
		var search_id = $(this).parent().find('#search_id').val();
		var init_char = interest_name.substring(0,1);
		var content = $(this).parent();
		//permission = false;
		var remove = "<input type='button' id='remove_interest' value='Remove'>";
		var moveHere = $('body #all_interests');
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/edit_my_interests.php?int_id='+int_id+'&interest='+interest_name+'&action=ADD&search_id='+search_id,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){
				
				if(data!='Interest already added.'){
				
					prevEntry = moveHere.find('div:first');
					if(prevEntry.html() != ''){
						content.hide();
						myThis.after(remove);
						content.find('#add_interest').remove();
						var add_content = content.html();
						if(prevEntry != undefined){
							prevEntry.before("<div>"+add_content+"</div>");
							prevEntry.parent().find('div:first').hide().slideDown(1000);
						}else{
							moveHere.append("<div>"+content.html()+"</div>");	
							moveHere.hide().slideDown(1000);
						}
						myThis.remove();

					}else{

						content.hide();
						myThis.after(remove);
						content.find('#add_interest').remove();
						moveHere.append("<div>"+content.html()+"</div>").slideDown(1000);
						myThis.remove();

					}

				}else{
					
					//alert('here');
					content.hide();
					myThis.remove();
					$('body #message').html(data).show().fadeOut(1500);
				}

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(332500);

			}
		});

	});

	$('body').on('click', '#remove_interest', function(){

		var int_id = $(this).parent().find('#interest_id').val();
		var interest_name = $(this).parent().find('#interest_name').val();
		var search_id = $(this).parent().find('#search_id').val();
		var content = $(this).parent();

		$.ajax({

			url: 'php_response_to_ajax/edit_my_interests.php?int_id='+int_id+'&interest='+interest_name+'&action=REMOVE&search_id='+search_id,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){

				content.slideUp(1000);

			},
			error: function(){

				$('body #message').html('Connection to server failed.').show().fadeOut(332500);

			}
		});

	});

});

function checkIt(int_id, interest_name, search_id){

	var exists = false;
	$('body #added_sudomains div').each(function(){

		var int_id1 = $(this).find('#interest_id').val();
		var interest_name1 = $(this).find('#interest_name').val();
		var search_id1 = $(this).find('#search_id').val();
		if(int_id1 == int_id && interest_name1==interest_name && search_id1==search_id){
			exists = true;
			return false;
		}

	});

	return exists;

}
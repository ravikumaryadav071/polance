$(document).ready(function(){

	$('[hidden]').hide();
	var totFiles = 0;
	var totEditors = 1;
	var fileSource = '';
	
	$("#add_files").on('click', function(){

		totFiles++;
		$(this).before($("<div/>", {id: 'file_container'}).fadeIn('slow').append(
			$("<input/>", {name: 'file[]', type: 'file', id: 'file'}),
			$("<input/>", {type: 'hidden', id: 'file_no', name: 'file_no[]', value: totFiles}),
			$("<input/>", {type: 'button', id: 'add_text_above', value: 'Add Text Above'}),
			$("<input/>", {type: 'button', id: 'add_text_below', value: 'Add Text Below'})
		));

		totEditors++;
		$(this).parent().parent().find('#post_preview').append('<div id="read_text_'+totEditors+'"><pre></pre><input type="hidden" id="preview_no" value="'+totEditors+'"><div id="file_preview"></div></div>');

	});

	$('body').on('keyup', '#read_text', function(){

		msg_text = $(this).val();
		var newLen = msg_text.length;
		var editor = $(this).parent().find('#text_editor').val();
		$('#post_preview #read_text_'+editor+' pre').html(msg_text);
		
	});

	$('body').on('click', '#add_text_above', function(){

		var pos = $(this).parent().find('#file_no').val();
		var exists = $(this).parent().parent().find('#editor_'+pos).html();

		if(exists == null){

			totEditors++;

			$('div[id^="editor_"]').hide();
			$(this).parent().before($("<div/>", {id: 'editor_'+pos}).fadeIn('slow').append(
				$("<textarea/>", {name: 'read_text[]', id: 'read_text', placeholder: 'Write Down Your Post'}),
				$("<input/>", {name: 'editor_pos[]', type: 'hidden', id: 'text_editor', value: pos})
			));

		}else{

			$(this).parent().parent().find('div[id^="editor_"]').hide();
			$(this).parent().parent().find('#editor_'+pos).show();

		}

	});

	$('body').on('click', '#add_text_below', function(){

		var pos = $(this).parent().find('#file_no').val();
		pos++;
		var exists = $(this).parent().parent().find('#editor_'+pos).html();

		if(exists == null){

			totEditors++;
			$('div[id^="editor_"]').hide();
			$(this).parent().after($("<div/>", {id: 'editor_'+pos}).fadeIn('slow').append(
				$("<textarea/>", {name: 'read_text[]', id: 'read_text', placeholder: 'Write Down Your Post'}),
				$("<input/>", {name: 'editor_pos[]', type: 'hidden', id: 'text_editor', value: pos})
			));

		}else{

			$(this).parent().parent().find('div[id^="editor_"]').hide();
			$(this).parent().parent().find('#editor_'+pos).show();

		}

	});

	$('body').on('change', '#file', function(){

		var filePos = $(this).parent().find('#file_no').val();
		var numPos = parseInt(filePos);
		var file = this.files[0];
		var file_type = file.type;
		var valid_img_formats = ["image/jpeg", "image/jpg", "image/png"];
		var valid_ado_formats = ['audio/mp3', 'audio/ogg', 'audio/wav'];
		var valid_vdo_formats = ['video/3gpp', 'video/avi', 'video/mp4', 'video/3gp', 'video/webm', 'video/ogg'];
		var valid_file_formats = ['application/octet-stream', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint.presentation.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];


		if(file){

			if((file_type == valid_img_formats[0])||(file_type == valid_img_formats[1])||(file_type == valid_img_formats[2])){

				validation = true;
				var reader = new FileReader();
				reader.onload = fileIsLoaded;
				reader.readAsDataURL(file);

				//$('#read_text_'+filePos).find("#file_preview").html('<img src="'+fileSource+'">');
				
			}else if((file_type == valid_ado_formats[0])||(file_type == valid_ado_formats[1])||(file_type == valid_ado_formats[2])){

				validation = true;
				var reader = new FileReader();
				reader.onload = fileIsLoaded;
				reader.readAsDataURL(file);

				//$('#read_text_'+filePos).find("#file_preview").html('<img src="'+fileSource+'">');

			}else if((file_type == valid_vdo_formats[0])||(file_type == valid_vdo_formats[1])||(file_type == valid_vdo_formats[2])||(file_type == valid_vdo_formats[3])||(file_type == valid_vdo_formats[4])||(file_type == valid_vdo_formats[5])){
				
				validation = true;
				var reader = new FileReader();
				reader.onload = fileIsLoaded;
				reader.readAsDataURL(file);

				//$('#read_text_'+filePos).find("#file_preview").html('<img src="'+fileSource+'">');

			}else if((file_type == valid_file_formats[0])||(file_type == valid_file_formats[1])||(file_type == valid_file_formats[2]||file_type == valid_file_formats[3])||(file_type == valid_file_formats[4])||(file_type == valid_file_formats[5])||(file_type == valid_file_formats[6])||(file_type == valid_file_formats[7]) ){
				
				validation = true;
				var reader = new FileReader();
				reader.onload = fileIsLoaded;
				reader.readAsDataURL(file);

				//$('#read_text_'+filePos).find("#file_preview").html('<img src="'+fileSource+'">');

			}else{

				var strPos = '';
				switch(numPos){
					case 1:
					strPos = '1st';
					break
					case 2:
					strPos = '2nd';
					break
					case 3:
					strPos = '3rd';
					break
					default:
					strPos = filePos+'th';

				}
				$("#error").html("<p>Your "+strPos+" file do not have valid format.</p>").show().fadeOut(20000);
				var validation = false;		

			}

		}

		function fileIsLoaded(e){

			//alert('here baad me :(');
			fileSource = e.target.result;

			if((file_type == valid_img_formats[0])||(file_type == valid_img_formats[1])||(file_type == valid_img_formats[2])){

				$('#read_text_'+filePos).find("#file_preview").html('<img src="'+fileSource+'">');
				
			}else if((file_type == valid_ado_formats[0])||(file_type == valid_ado_formats[1])||(file_type == valid_ado_formats[2])){

				$('#read_text_'+filePos).find("#file_preview").html('<audio src="'+fileSource+'" controls></audio>');

			}else if((file_type == valid_vdo_formats[0])||(file_type == valid_vdo_formats[1])||(file_type == valid_vdo_formats[2])||(file_type == valid_vdo_formats[3])||(file_type == valid_vdo_formats[4])||(file_type == valid_vdo_formats[5])){
				
				$('#read_text_'+filePos).find("#file_preview").html('<video src="'+fileSource+'" controls></video>');

			}else if((file_type == valid_file_formats[0])||(file_type == valid_file_formats[1])||(file_type == valid_file_formats[2])||(file_type == valid_file_formats[3])||(file_type == valid_file_formats[4])||(file_type == valid_file_formats[5])||(file_type == valid_file_formats[6])||(file_type == valid_file_formats[7])){
				
				$('#read_text_'+filePos).find("#file_preview").html('<a href="'+fileSource+'" download>Download File</a>');

			}

		}

	});

	$('body').on('keyup', '#sugst_contri_user', function(){

		var sugst_user = $(this).val();
		sugst_user = sugst_user.trim();

		if(sugst_user != ''){

			$.ajax({

				url: 'php_response_to_ajax/contributors_suggestions.php?search_user='+sugst_user,
				type: 'POST',
				data: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data){

					if(data == 'No user of this name in your list.'){
						$('body #contri_sugsn_area').html(data).slideDown(500);
						setTimeout(function(){
							$('body #contri_sugsn_area').html(data).slideUp(500);
						}, 1500);
						
					}else{
						$('body #contri_sugsn_area').html(data).slideDown(500);
					}

				},
				error: function(){
					$('body #message').html('Connection to server failed').show().fadeOut(2500);
				}

			});

		}else{
			$('body #contri_sugsn_area').slideUp(500);
		}

	});

	$('body').on('click', '#add_contri', function(){

		var user = $(this).parent();
		user.find('#add_contri').hide();
		user_html = user.html();
		add_id = user.find('#userid').val();
		
		user.slideUp(500);
		var add_html = '<div id="user_info">'+user_html+'<input type="button" id="remove_contri" value="Remove"></div>';
		var passed = 'Pass';
		
		$('body #add_contributors #user_info').each(function(){

			var userid = $(this).find('#userid').val();

			if(userid == add_id){
				passed='Fail';
				return false;
			}else{
				passed = 'Pass';
			}

		});

		if(passed == 'Pass'){
			$('body #add_contributors').append(add_html).slideDown(500);
			//$('body #add_contributors div:last').hide().slideDown(500);
		}else{
			$('body #message').html('Already added.').show().fadeOut(2500);
		}
		$(this).remove();

	});

	$('body').on('click', '#remove_contri', function(){

		$(this).parent().slideUp(500);
		setTimeout(function(){
			$(this).parent().remove();
		}, 500)

	});

	$('body').on('click', '#add_refs_to_list', function(){

		var refs = $('body #add_refs').val();
		refs = refs.trim();
		
		if(refs != ''){
			
			$('body #add_refs').val('');
			var add_html = '<div id="reference_link"><a href="'+refs+'" target="_blank">'+refs+'</a><input type="hidden" name="references[]" value="'+refs+'"><input type="button" id="remove_refrence" value="Remove"></div>';
			var passed = 'Pass';
			
			prevEntry = $('body #add_references').find('#reference_link').html();
			if(prevEntry != undefined){
				
				$('body #add_references').find('#reference_link').each(function(){

					var check = $(this).html();

					if(check == add_html){
						passed='Fail';
						return false;
					}else{
						passed = 'Pass';
					}

				});

			}

			if(passed == 'Pass'){

				exists = $('body #add_references div:first').html();
				if(exists != undefined){
					$('body #add_references div:first').before(add_html).slideDown(500);
				}else{
					$('body #add_references').append(add_html).slideDown(500);
				}
			
			}else{
				$('body #message').html('Already added.').show().fadeOut(2500);
			}

		}

	});

	$('body').on('click', '#remove_refrence', function(){

		$(this).parent().remove();

	});

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
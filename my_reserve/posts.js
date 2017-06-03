$(document).ready(function(){

	$('[hidden]').hide();
	var totFiles = 0;
	var totEditors = 1;
	var fileSource = '';
	
	$("#add_files").on('click', function(){

		totFiles++;
		$(this).before($("<div/>", {id: 'file_container'}).fadeIn('slow').append(
			$("<input/>", {name: 'file[]', type: 'file', id: 'file'}),
			$("<input/>", {type: 'hidden', id: 'file_no', value: totFiles}),
			$("<input/>", {type: 'button', id: 'add_text_above', value: 'Add Text Above'}),
			$("<input/>", {type: 'button', id: 'add_text_below', value: 'Add Text Below'})
		));

		totEditors++;
		$('#post_preview #read_text_'+totEditors).after('<div id="read_text_'+totEditors+'"><pre></pre><input type="hidden" id="preview_no" value="'+totEditors+'"><div id="file_preview"></div></div>');

	});

	$('body').on('keyup', '#read_text', function(){

		msg_text = $(this).val();
		var newLen = msg_text.length;
		var editor = $(this).parent().find('#text_editor').val();
		$('#post_preview #read_text_'+editor+' pre').html(msg_text);
		
	});

	$('body').on('click', '#add_text_above', function(){

		var pos = $(this).parent().find('#file_no').val();
		var exists = $('#editor_'+pos).html();

		if(exists == null){

			totEditors++;

			$('div[id^="editor_"]').hide();
			$(this).before($("<div/>", {id: 'editor_'+pos}).fadeIn('slow').append(
				$("<textarea/>", {name: 'read_text[]', id: 'read_text', placeholder: 'Write Down Your Post'}),
				$("<input/>", {name: 'editor_pos', type: 'hidden', id: 'text_editor', value: pos})
			));

		}else{

			$('div[id^="editor_"]').hide();
			$('#editor_'+pos).show();

		}

	});

	$('body').on('click', '#add_text_below', function(){

		var pos = $(this).parent().find('#file_no').val();
		pos++;
		var exists = $('#editor_'+pos).html();

		if(exists == null){

			totEditors++;
			$('div[id^="editor_"]').hide();
			$(this).after($("<div/>", {id: 'editor_'+pos}).fadeIn('slow').append(
				$("<textarea/>", {name: 'read_text[]', id: 'read_text', placeholder: 'Write Down Your Post'}),
				$("<input/>", {name: 'editor_pos', type: 'hidden', id: 'text_editor', value: pos})
			));

		}else{

			$('div[id^="editor_"]').hide();
			$('#editor_'+pos).show();

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

});
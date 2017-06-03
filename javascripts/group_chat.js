var mps = 1; //messages page number
var path = '';

$(document).ready(function(){

	var time = new Date().toLocaleString();

	$("#file").on('change', function(){

		var file = this.files[0];
		var file_type = file.type;
		var valid_formats = ['image/jpeg', 'image/png', 'image/jpg', 'audio/mp3', 'video/x-ms-wmv', 'video/mp4', 'application/octet-stream', 'video/3gpp', 'video/3gp', 'video/ogv', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint.presentation.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
		if(file){

			if((file_type == valid_formats[0])||(file_type == valid_formats[1])||(file_type == valid_formats[2])||(file_type == valid_formats[3])||(file_type == valid_formats[4])||(file_type == valid_formats[5])||(file_type == valid_formats[6])||(file_type == valid_formats[7])||(file_type == valid_formats[8])||(file_type == valid_formats[9])||(file_type == valid_formats[10])||(file_type == valid_formats[11])||(file_type == valid_formats[12])||(file_type == valid_formats[13])||(file_type == valid_formats[14])||(file_type == valid_formats[15])||(file_type == valid_formats[16])){

				var reader = new FileReader();
				reader.onload = fileIsLoaded;
				reader.readAsDataURL(file);
				
			}else{

				$("#message").html("File Format is not valid.").show().fadeOut(2500);

			}

		}

	});

	$("#send_message").on('submit', function(e){

		e.preventDefault();
		$("#send").attr('disabled', 'disabled');

		$.ajax({

			url: "php_response_to_ajax/send_group_messages.php",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data)
			{
				$("#message").html(data).show().fadeOut(2500);
				$("#send").removeAttr('disabled');
				//var comments = parseInt($('#total_comments_'+post_id).html()) - 1;
				//$('#total_comments_'+post_id).html(likes);
			},
			error: function(){
				$("#message").html('Connection to server failed').show().fadeOut(2500);
			}

		});

		var msg = $("#text_message").val();
		
		if(path != ''){
		
			$(this).before("<div id='sent_msg_container' style='background-color: #CCCCFF'><a>Me: on "+time+"</a><p><pre>"+msg+"</pre><a href='"+path+"' id='sent_file' download>Download File</a></p></div>");
		
		}else{

			$(this).before("<div id='sent_msg_container' style='background-color: #CCCCFF'><a>Me: on "+time+"</a><p><pre>"+msg+"</pre></p></div>");			

		}

		$("#text_message").remove();
		$("#file").remove();
		$("#send").before("<textarea id='text_message' name='personal_msg_text' placeholder='Type your message' value=''></textarea><input type='file' id='file' name='file'>");

	});

	$("#load_more").on('click', function(){

		var group = $("#group_name").val();
		var last_id = $("#last_id").val();
		$("#last_id").remove();

		if(!isNaN(last_id)){
			
			$.ajax({

				url: 'php_response_to_ajax/load_more_group_messages.php?group='+group+'&last_id='+last_id,
				type: 'GET',
				data: false,
				contentType: false,
				cache: false,
				processData: false,
				success: function(data)
				{
					$("#load_more").after(data);
					mps++;
				}

			}); 

		}

	});

	function fileIsLoaded(e){

		//alert('here');
		path = e.target.result;

	}

	setInterval(load_response, 500);

});

function load_response(){

	var group_name = $("#group_name").val();
	var last_seen = $("#last_seen").val();
	$.ajax({

		url: 'php_response_to_ajax/load_group_chat_response.php?group='+group_name+'&last_seen='+last_seen,
		type: 'GET',
		data: false,
		contentType: false,
		cache: false,
		processData: false,
		success: function(data)
		{	
			if(data != ''){
				$("#last_seen").remove();
				$("#send_message").before(data);
			}
		},
		error: function(){
			$("#message").html('Connection to server failed');
		}

	});

}

function leave_group(group){

	$.ajax({

		url: 'php_response_to_ajax/leave_group.php?group='+group,
		type: 'GET',
		data: false,
		contentType: false,
		cache: false,
		processData: false,
		success: function(data)
		{
			if(data == 'SUCCESS'){
				window.location = "my_groups.php";
			}else{
				$('#message').html(data).show().fadeOut(255500);
			}
		},
		error: function(){
			$('#message').html('Connection to server failed. Try again!').show().fadeOut(2500);
		}

	});	

}
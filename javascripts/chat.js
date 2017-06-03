var mps = 1; //messages page number
var path = '';
var msgsHeightPrev = 0;

$(document).ready(function(){

	var time = new Date().toLocaleString();

	var scrollto = $('.chatFixedHeight div:last').offset();
	$('.chatFixedHeight').scrollTop(scrollto.top);

	$('.chatFixedHeight div').each(function(){
		msgsHeightPrev += $(this).height();
	});
	
	$("#file").on('change', function(){

		var file = this.files[0];
		var file_type = file.type;
		var valid_formats = ['image/jpeg', 'image/png', 'image/jpg', 'audio/mp3', 'video/x-ms-wmv', 'video/mp4', 'application/octet-stream', 'video/3gpp', 'video/3gp', 'video/ogv', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint.presentation.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
		alert(file_type);
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

			url: "php_response_to_ajax/send_personal_messages.php",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data)
			{
				$("#message").html(data).show().fadeOut(2500);
				$("#send").removeAttr('disabled');
				var msg_height = $(".chatFixedHeight div:last").height();
				var scrollto = $('.chatFixedHeight').scrollTop();
				//alert(scrollto);
				var scrollHere = msg_height+scrollto+15;
				$('.chatFixedHeight').scrollTop(scrollHere);
				//var comments = parseInt($('#total_comments_'+post_id).html()) - 1;
				//$('#total_comments_'+post_id).html(likes);
			}

		});

		var msg = $("#text_message").val();
		
		var msg = $("#text_message").val();
		
		if(path != ''){
		
			$(this).parent().parent().find('div:first').append("<div id='sent_msg_container' style='background-color: #CCCCFF'><a>Me: on "+time+"</a><p><pre>"+msg+"</pre><a href='"+path+"' id='sent_file' download>Download File</a></p></div>");
		
		}else{

			$(this).parent().parent().find('div:first').append("<div id='sent_msg_container' style='background-color: #CCCCFF'><a>Me: on "+time+"</a><p><pre>"+msg+"</pre></p></div>");

		}

		$("#text_message").remove();
		$("#file").remove();
		$("#send").before("<textarea id='text_message' name='personal_msg_text' placeholder='Type your message' value=''></textarea><input type='file' id='file' name='file'>");

	});

	$("#load_more").on('click', function(){

		var chat_id = $("#chat_userid").val();
		var start_id = $("#start_id").val();
		$("#start_id").remove();
		
		if(start_id != null){

			$.ajax({

				url: 'php_response_to_ajax/load_more_personal_messages.php?user='+chat_id+'&page='+mps+'&start_id='+start_id,
				type: 'GET',
				data: false,
				contentType: false,
				cache: false,
				processData: false,
				success: function(data)
				{
					$("#load_more").after(data);
					var  msgsHeightNow = 0;
					$('.chatFixedHeight div').each(function(){
						msgsHeightNow += $(this).height();
					});
					var scrollTo = msgsHeightNow - msgsHeightPrev;
					msgsHeightPrev = msgsHeightNow;
					$('.chatFixedHeight').scrollTop(scrollTo);
					mps++;
				}

			}); 

		}

	});

	setInterval(load_response, 500);

	function fileIsLoaded(e){

		//alert('here');
		path = e.target.result;

	}


});

function load_response(){

	var chat_id = $("#chat_userid").val();
	$.ajax({

		url: 'php_response_to_ajax/load_chat_response.php?user='+chat_id,
		type: 'GET',
		data: false,
		contentType: false,
		cache: false,
		processData: false,
		success: function(data)
		{
			var msg_height = $(".chatFixedHeight div:last").offset();
			$("#send_message").parent().parent().find('div:first').append(data);
			var last_msg_height = $(".chatFixedHeight div:last").offset();
			var scrollHeight = last_msg_height.top - msg_height.top;
			//$("#message").html(msg_height+' '+last_msg_height+' '+scrollHeight);
			var scrollto = $('.chatFixedHeight').scrollTop();
			var scrollHere = scrollto+scrollHeight;
			$('.chatFixedHeight').scrollTop(scrollHere);
				
		}

	});

	
}
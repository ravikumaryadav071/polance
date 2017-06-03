var msgsCC = 0; 	//messages click count
var rqstsCC = 0;	//requests click count
var gmCC = 0;
var ntfsCC = 0;

var mps = 1; //messages page number
var path = '';
var msgsHeightPrev = 0;

$(document).ready(function(){

	var time = new Date().toLocaleString();

	$('#msgs').stop().click(function(){

		msgsCC++;

		if(msgsCC==1){

			$.ajax({
				url: 'php_response_to_ajax/show_personal_messages.php',
				type: 'POST',
				data: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data){
					$('#msgs_dropdown').html(data).slideDown(500);
				}
			});

		}else{
			msgsCC = 0;
			$('#msgs_dropdown').slideUp(600);
		}
	
	});

	$('#rqsts').stop().click(function(){

		rqstsCC++;

		if(rqstsCC == 1){

			$.ajax({
				url: 'php_response_to_ajax/show_requests.php',
				type: 'POST',
				data: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data){
					$('#rqsts_dropdown').html(data).slideDown(500);
				}
			});

		}else{
			rqstsCC = 0;
			$('#rqsts_dropdown').slideUp(600);
		}

	});

	$('#group_msgs').stop().click(function(){

		gmCC++;

		if(gmCC==1){

			$.ajax({
				url: 'php_response_to_ajax/show_group_messages.php',
				type: 'POST',
				data: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data){
					$('#group_msgs_dropdown').html(data).slideDown(500);
				}
			});

		}else{
			gmCC = 0;
			$('#group_msgs_dropdown').slideUp(600);
		}
	
	});

	$('#ntfs').stop().click(function(){

		ntfsCC++;

		if(ntfsCC == 1){

			$.ajax({
				url: 'php_response_to_ajax/show_notifications.php',
				type: 'POST',
				data: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data){
					$('#ntfs_dropdown').html(data).slideDown(500);
				}
			});

		}else{
			ntfsCC = 0;
			$('#ntfs_dropdown').slideUp(600);
		}

	});

	$('body').on('click', '#users_post_ntf', function(){

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		var post_id = $(this).find('#popup_p_post_id').val();
		var user = $(this).find('#popup_p_user').val();

		$.ajax({

			url: 'php_response_to_ajax/show_popup_user_post.php?user='+user+'&post_id='+post_id,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){

				$('body #light').css({
					'display' : 'block', 
					'top' : light_top
				});
				$('body #fade').css({
					'display' : 'block',
					'top' : fade_top
				});
				$('body #popup_content').html(data);

			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});
	
	});

	$('body').on('click', '#col_post_ntf', function(){

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		var post_id = $(this).find('#popup_c_post_id').val();
		var user = $(this).find('#popup_c_user').val();

		$.ajax({

			url: 'php_response_to_ajax/show_popup_col_post.php?col='+user+'&post_id='+post_id,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){

				$('body #light').css({
					'display' : 'block', 
					'top' : light_top
				});
				$('body #fade').css({
					'display' : 'block',
					'top' : fade_top
				});
				$('body #popup_content').html(data);

			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});
	
	});

	$('body').on('click', '#col_invite', function(){

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		var col_name = $(this).find('#col_name').val();

		$.ajax({

			url: 'php_response_to_ajax/show_popup_col_invitation.php?col='+col_name,
			type: 'POST',
			data: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){

				$('body #light').css({
					'display' : 'block', 
					'top' : light_top
				});
				$('body #fade').css({
					'display' : 'block',
					'top' : fade_top
				});
				$('body #popup_content').html(data);

			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});
	
	});

	$('body').on('click', '#personal_message', function(){

		var fade_top = $(window).scrollTop();
		var wndw_height = $(window).height();
		var light_top = fade_top + (wndw_height)*0.125;
		var chat_user = $(this).parent().find('#chat_user').val();
		var myThis = $(this);

		$.ajax({

			url: 'php_response_to_ajax/chat.php?chat_user='+chat_user,
			type: 'POST',
			cache: false,
			data: false,
			contentType: false,
			processData: false,
			success: function(data){
				$('body #light').css({
					'display' : 'block', 
					'top' : light_top
				});
				$('body #fade').css({
					'display' : 'block',
					'top' : fade_top
				});
				$('body #popup_content').html(data);
				var scrollto = $('.chatFixedHeight div:last').offset();
				$('.chatFixedHeight').scrollTop(scrollto.top);

				$('.chatFixedHeight div').each(function(){
					msgsHeightPrev += $(this).height();
				});

			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}
		});

	});

	$("body").on('change', '#file', function(){

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

	$("body").on('submit', '#send_message', function(e){

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

	$("body").on('click', '#load_more', function(){

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

	setInterval(update_notification, 500);

});

function update_notification(){

	$.ajax({

		url: 'php_response_to_ajax/notifications.php',
		type: 'GET',
		data: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			
			var str = data;
			var source = str.split(",");

			if(source[0] != '0'){
				$('#rqsts_notify').html(source[0]);
			}else if(source[0] == '0'){
				$('#rqsts_notify').empty();
			}
			if(source[1] != '0'){
				$('#personal_msg_notify').html(source[1]);
			}else if(source[1] == '0'){
				$('#personal_msg_notify').empty();
			}
			if(source[2] != '0'){
				$('#group_msg_notify').html(source[2]);
			}else if(source[2] == '0'){
				$('#group_msg_notify').empty();
			}
			if(source[3] != '0'){
				$('#ntfs_notify').html(source[3]);
			}else{
				$('#ntfs_notify').empty();
			}

		}
		
	});

}

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
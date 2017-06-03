$(document).ready(function(){
	$('a[hidden="hidden"]').hide();
	$('input[hidden="hidden"]').hide();
});

function follow(id){

	$('#follow_'+id).attr('disabled', 'disabled');

	$.ajax({
		url: "php_response_to_ajax/user_connections.php?action=FOLLOW&user="+id,
		type: "GET",
		data: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			$('#follow_'+id).removeAttr('disabled').hide();
			$('#unfollow_'+id).show();
			$('#friend_'+id).show();
			$('#message').html(data).show();
			//$('#message').html(data).show().fadeOut(2500);
		},
		error: function(){
			$('#follow_'+id).removeAttr('disabled');
			$('#message').html('Connection to server failed. Try again.').fadeOut(2500);
		}
	});

}

function unfollow(id){

	$('#unfollow_'+id).attr('disabled', 'disabled');

	$.ajax({
		url: "php_response_to_ajax/user_connections.php?action=UNFOLLOW&user="+id,
		type: "GET",
		data: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			$('#unfollow_'+id).removeAttr('disabled').hide();
			$('#follow_'+id).show();
			$('#friend_'+id).hide();
			$('#delete_friend_req_'+id).hide();
			$('#message').html(data).show().fadeOut(2500);
		},
		error: function(){
			$('#unfollow_'+id).removeAttr('disabled');
			$('#message').html('Connection to server failed. Try again.').fadeOut(2500);
		}
	});

}

function friend(id){

	$('#friend_'+id).attr('disabled', 'disabled');

	$.ajax({
		url: "php_response_to_ajax/user_connections.php?action=FRIEND&user="+id,
		type: "GET",
		data: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			alert(data);
			$('#friend_'+id).removeAttr('disabled').hide();
			$('#delete_friend_req_'+id).show();
			$('#message').html(data).show().fadeOut(2500);
		},
		error: function(){
			$('#friend_'+id).removeAttr('disabled');
			$('#message').html('Connection to server failed. Try again.').fadeOut(2500);
		}
	});

}

function delete_friend_req(id){

	$('#delete_friend_req_'+id).attr('disabled', 'disabled');

	$.ajax({
		url: "php_response_to_ajax/user_connections.php?action=DELETE_FRIEND&user="+id,
		type: "GET",
		data: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			$('#delete_friend_req_'+id).removeAttr('disabled').hide();
			$('#friend_'+id).show();
			$('#message').html(data).show().fadeOut(2500);
		},
		error: function(){
			$('#delete_friend_req_'+id).removeAttr('disabled');
			$('#message').html('Connection to server failed. Try again.').fadeOut(2500);
		}
	});

}

function unfriend(id){

	$('#unfriend_'+id).attr('disabled', 'disabled');

	$.ajax({
		url: "php_response_to_ajax/user_connections.php?action=UNFRIEND&user="+id,
		type: "GET",
		data: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			$('#unfriend_'+id).removeAttr('disabled').hide();
			$('#friend_'+id).hide();
			$('#follow_'+id).hide();
			$('#unfollow_'+id).show();
			$('#message').html(data).show().fadeOut(250000);
		},
		error: function(){
			$('#unfriend_'+id).removeAttr('disabled');
			$('#message').html('Connection to server failed. Try again.').fadeOut(2500);
		}
	});

}

function block(id){

	$('#block_'+id).attr('disabled', 'disabled');

	$.ajax({
		url: "php_response_to_ajax/user_connections.php?action=BLOCK&user="+id,
		type: "GET",
		data: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			$('#block_'+id).removeAttr('disabled').hide();
			$('#unblock_'+id).show();
			$('#message').html(data).show().fadeOut(2500);
		},
		error: function(){
			$('#block_'+id).removeAttr('disabled');
			$('#message').html('Connection to server failed. Try again.').fadeOut(2500);
		}
	});

}

function unblock(id){

	$('#unblock_'+id).attr('disabled', 'disabled');

	$.ajax({
		url: "php_response_to_ajax/user_connections.php?action=UNBLOCK&user="+id,
		type: "GET",
		data: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			$('#unblock_'+id).removeAttr('disabled');
			$('#block_'+id).show();
			$('#message').html(data).show().fadeOut(2500);
		},
		error: function(){
			$('#unblock_'+id).removeAttr('disabled');
			$('#message').html('Connection to server failed. Try again.').fadeOut(2500);
		}
	});

}
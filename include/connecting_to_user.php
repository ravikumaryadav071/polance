<?php
if(!$uc->isFriend($f_user_data->id)){
	
	if(!$uc->isUserFollower($f_user_data->id)){
		
		?>
		<a href="javascript: void(0)" id="follow_<?php echo $f_user_data->id; ?>" onclick="follow(<?php echo $f_user_data->id; ?>)">Follow</a>
		<a href="javascript: void(0)" id="unfollow_<?php echo $f_user_data->id; ?>" onclick="unfollow(<?php echo $f_user_data->id; ?>)" hidden="hidden">Unfollow</a>
		<a href="javascript: void(0)" id="friend_<?php echo $f_user_data->id; ?>" onclick="friend(<?php echo $f_user_data->id; ?>)" hidden="hidden">Friend</a>
		<a href="javascript: void(0)" id="delete_friend_req_<?php echo $f_user_data->id; ?>" onclick="delete_friend_req(<?php echo $f_user_data->id; ?>)" hidden="hidden">Delete Friend Request</a>
		<?php
	}else{
		
		?>
		<a href="javascript: void(0)" id="follow_<?php echo $f_user_data->id; ?>" onclick="follow(<?php echo $f_user_data->id; ?>)" hidden="hidden">Follow</a>
		<a href="javascript: void(0)" id="unfollow_<?php echo $f_user_data->id; ?>" onclick="unfollow(<?php echo $f_user_data->id; ?>)">Unfollow</a>
		<?php
		if($uc->hasUserRequest($f_user_data->id)){
			
			?>
			<a href="javascript: void(0)" id="friend_<?php echo $f_user_data->id; ?>" onclick="friend(<?php echo $f_user_data->id; ?>)" hidden="hidden">Friend</a>
			<a href="javascript: void(0)" id="delete_friend_req_<?php echo $f_user_data->id; ?>" onclick="delete_friend_req(<?php echo $f_user_data->id; ?>)">Delete Friend Request</a>
			<?php
		}else{
			
			?>
			<a href="javascript: void(0)" id="friend_<?php echo $f_user_data->id; ?>" onclick="friend(<?php echo $f_user_data->id; ?>)">Friend</a>
			<a href="javascript: void(0)" id="delete_friend_req_<?php echo $f_user_data->id; ?>" onclick="delete_friend_req(<?php echo $f_user_data->id; ?>)" hidden="hidden">Delete Friend Request</a>
			<?php
		}
	}
}else{
	
	?>
	<a href="javascript: void(0)" id="friend_<?php echo $f_user_data->id; ?>" onclick="friend(<?php echo $f_user_data->id; ?>)" hidden="hidden">Friend</a>
	<a href="javascript: void(0)" id="unfriend_<?php echo $f_user_data->id; ?>" onclick="unfriend(<?php echo $f_user_data->id; ?>)">Unfriend</a>
	<a href="javascript: void(0)" id="delete_friend_req_<?php echo $f_user_data->id; ?>" onclick="delete_friend_req(<?php echo $f_user_data->id; ?>)" hidden="hidden">Delete Friend Request</a>
	<a href="javascript: void(0)" id="follow_<?php echo $f_user_data->id; ?>" onclick="follow(<?php echo $f_user_data->id; ?>)" hidden="hidden">Follow</a>
	<a href="javascript: void(0)" id="unfollow_<?php echo $f_user_data->id; ?>" onclick="unfollow(<?php echo $f_user_data->id; ?>)" hidden="hidden">Unfollow</a>
	<?php
}
if($uc->isBlocked($f_user_data->id)){
	?>
	<a href="javascript: void(0)" id="block_<?php echo $f_user_data->id; ?>" onclick="block(<?php echo $f_user_data->id; ?>)" hidden="hidden">Block</a>
	<a href="javascript: void(0)" id="unblock_<?php echo $f_user_data->id; ?>" onclick="unblock(<?php echo $f_user_data->id; ?>)">Unblock</a>
	<?php
}else{
	?>
	<a href="javascript: void(0)" id="block_<?php echo $f_user_data->id; ?>" onclick="block(<?php echo $f_user_data->id; ?>)">Block</a>
	<a href="javascript: void(0)" id="unblock_<?php echo $f_user_data->id; ?>" onclick="unblock(<?php echo $f_user_data->id; ?>)" hidden="hidden">Unblock</a>
	<?php
}
?>
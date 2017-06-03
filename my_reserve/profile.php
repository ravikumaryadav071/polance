<html>
	<head>
		<link href='bootstrap/jquery/smoothness/jquery-ui-1.10.1.custom.css' rel='stylesheet' type='text/css'>
		<link href='css/css_profile.css' rel='stylesheet' type='text/css'>
		<script src="bootstrap/jquery/jquery-1.9.1.js"></script>
		<script src="bootstrap/jquery/jquery-ui-1.10.1.custom.min.js"></script>
		<script src='bootstrap/js/bootstrap.js'></script>	
	</head>
	<body>
		<?php
		require_once 'core/init.php';

		$user = new user();

		if($user->isLoggedIn()){

			if (!$username = input::get('user')) {
				redirect::to('index.php');
			} else {
				//echo $username;
				if (session::exists('profile')) {
					echo '<p>' . session::flash('profile') . '</p>';	
				}
				$p_user = new user($username);		//profile user
				if (!$p_user->exists()) {
					redirect::to(404);
				} else {
					//echo "Exists";
					$p_user_data = $p_user->data();
				}

				$user_data = $user->data();
				$uc = user_connections::getInstance();

				?>
				<div id="user_info">
					<img src="<?php echo $p_user_data->profile_pic; ?>" alt="<?php echo escape($p_user_data->name); ?>">
					<h3><?php echo escape($p_user_data->username); ?></h3>
					<p>FULL Name : <?php echo escape($p_user_data->name); ?></p>
				</div>
				<div>
					<a href="followers.php?user=<?php echo $username; ?>">Followers</a>
					<a href="following.php?user=<?php echo $username; ?>">Following</a>
					<a href="friends.php?user=<?php echo $username; ?>">Friends</a>
					<?php
					if($p_user_data->id != $user_data->id){

						if(!$uc->isUserBlocked($p_user_data->id)){
							?>
							<div id="user_action">
								<?php
								if($uc->isFollowing($p_user_data->id)){
									?>
									<a href="javascript: void(0)" id="follow_<?php echo $p_user_data->id; ?>" onclick="follow(<?php echo $p_user_data->id; ?>)" hidden="hidden">Follow</a>
									<a href="javascript: void(0)" id="unfollow_<?php echo $p_user_data->id; ?>" onclick="unfollow(<?php echo $p_user_data->id; ?>)">Unfollow</a>
									<?php
									if($uc->isFriend($p_user_data->id)){
										?>
										<a href="javascript: void(0)" id="friend_<?php echo $p_user_data->id; ?>" onclick="friend(<?php echo $p_user_data->id; ?>)" hidden="hidden">Friend</a>
										<a href="javascript: void(0)" id="unfriend_<?php echo $p_user_data->id; ?>" onclick="unfriend(<?php echo $p_user_data->id; ?>)">Unfriend</a>
										<a href="javascript: void(0)" id="delete_friend_req_<?php echo $p_user_data->id; ?>" onclick="delete_friend_req(<?php echo $p_user_data->id; ?>)" hidden="hidden">Delete Friend Request</a>
										<a href="javascript: void(0)" id="personal_message_box">Personal Message</a>
										<form method="POST" action="" id="personal_inbox" enctype="multipart/form-data">
											<label for="personal_msg_text">Message: </label>
											<textarea id="personal_msg_text" name="personal_msg_text" placeholder="Personal chat."></textarea>
											<label for="file">Attach File</label>
											<input type="file" id="file" name="file" value="">
											<input type="submit" value="SUBMIT" id="send_personal_message">
											<input type="hidden" name="userid" value="<?php echo $p_user_data->id; ?>">
										</form>
										<?php
									}else{
										if($uc->hasUserRequest($p_user_data->id)){
											?>
											<a href="javascript: void(0)" id="friend_<?php echo $p_user_data->id; ?>" onclick="friend(<?php echo $p_user_data->id; ?>)" hidden="hidden">Friend</a>
											<a href="javascript: void(0)" id="delete_friend_req_<?php echo $p_user_data->id; ?>" onclick="delete_friend_req(<?php echo $p_user_data->id; ?>)">Delete Friend Request</a>
											<?php
										}else{
											?>
											<a href="javascript: void(0)" id="friend_<?php echo $p_user_data->id; ?>" onclick="friend(<?php echo $p_user_data->id; ?>)">Friend</a>
											<a href="javascript: void(0)" id="delete_friend_req_<?php echo $p_user_data->id; ?>" onclick="delete_friend_req(<?php echo $p_user_data->id; ?>)" hidden="hidden">Delete Friend Request</a>
											<?php
										}
									}
								}else{
									?>
									<a href="javascript: void(0)" id="follow_<?php echo $p_user_data->id; ?>" onclick="follow(<?php echo $p_user_data->id; ?>)">Follow</a>
									<a href="javascript: void(0)" id="unfollow_<?php echo $p_user_data->id; ?>" onclick="unfollow(<?php echo $p_user_data->id; ?>)" hidden="hidden">Unfollow</a>
									<a href="javascript: void(0)" id="friend_<?php echo $p_user_data->id; ?>" onclick="friend(<?php echo $p_user_data->id; ?>)" hidden="hidden">Friend</a>
									<a href="javascript: void(0)" id="delete_friend_req_<?php echo $p_user_data->id; ?>" onclick="delete_friend_req(<?php echo $p_user_data->id; ?>)" hidden="hidden">Delete Friend Request</a>
									<?php
								}
								if($uc->isBlocked($p_user_data->id)){
									?>
									<a href="javascript: void(0)" id="block_<?php echo $p_user_data->id; ?>" onclick="block(<?php echo $p_user_data->id; ?>)" hidden="hidden">Block</a>
									<a href="javascript: void(0)" id="unblock_<?php echo $p_user_data->id; ?>" onclick="unblock(<?php echo $p_user_data->id; ?>)">Unblock</a>
									<?php
								}else{
									?>
									<a href="javascript: void(0)" id="block_<?php echo $p_user_data->id; ?>" onclick="block(<?php echo $p_user_data->id; ?>)">Block</a>
									<a href="javascript: void(0)" id="unblock_<?php echo $p_user_data->id; ?>" onclick="unblock(<?php echo $p_user_data->id; ?>)" hidden="hidden">Unblock</a>
									<?php
								}
								?>
								<a href="javascript: void(0)" id="message_box">Inbox</a>
								<form method="POST" action="" id="inbox">
									<label for="msg_text">Message: </label>
									<textarea id="msg_text" name="msg_text" placeholder="Inbox this user."></textarea>
									<input type="hidden" name="userid" value="<?php echo $p_user_data->id; ?>">
									<input type="submit" value="SUBMIT" id="send_message">
								</form>
							</div>
							<?php
						}
					
					}else if($p_user_data->id == $user_data->id){

						?>
						<a href="inbox.php">Inbox</a>
						<a href="messages.php">Messages</a>
						<a href="blocked_list.php">Blocked Users</a>
						<?php
					
					}
					?>
				</div>
				<?php
			}

		}
		?>
		<div id="message"></div>
		<script src="javascripts/profile_user_connections.js"></script>
		<script src="javascripts/send_messages.js"></script>
		<script src="javascripts/send_personal_messages.js"></script>
	</body>
</html>

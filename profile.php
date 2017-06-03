<!DOCTYPE HTML> 
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
		// ini_set('display_error', 1);
		// error_reporting(-1);
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
					$p_user_data = $p_user->data();		//profile user data
				}


				$user_data = $user->data();
				$db = DB::getInstance();
				$uc = user_connections::getInstance();
				$db_uf = DBusers_feeds::getInstance();
				$db_up = DBusers_posts::getInstance();
				$db_upr = DBusers_posts_responses::getInstance();
				$db_ucl = DBusers_collections::getInstance();
				$no_posts_pp = 20;		//no of posts per page
				$all_main_tb = array(
					'1'=>'all_business_interests',
					'2'=>'all_corporate_world_interests',
					'3'=>'all_education_interests',
					'4'=>'all_finance_interests',
					'5'=>'all_philosophy_interests',
					'6'=>'all_politics_interests',
					'7'=>'all_social_interests',
					'8'=>'all_sports_interests'
				);

				$all_int_domains_db = array(
					'1'=>'interests_business', 
					'2'=>'interests_corporate_world', 
					'3'=>'interests_education', 
					'4'=>'interests_finance', 
					'5'=>'interests_philosophy', 
					'6'=>'interests_politics', 
					'7'=>'interests_social', 
					'8'=>'interests_sports'
				);		//all interests domains database

				$all_int_domains = array(
					'1'=>'Business', 
					'2'=> 'Corporate World', 
					'3'=> 'Education', 
					'4'=> 'Finance', 
					'5'=> 'Philosophy', 
					'6'=> 'Politics', 
					'7'=> 'Social', 
					'8'=> 'Sports'
				);

				$valid_img_formats = array('jpeg', 'jpg', 'png');
				$valid_ado_formats = array('mp3', 'ogg', 'wav');
				$valid_vdo_formats = array('3gpp', 'avi', 'mp4', '3gp', 'webm', 'ogg');
				$valid_file_formats = array('pdf', 'doc', 'docx', 'ppt', 'pptx', 'pptm', 'xlsx', 'zip', 'rar', 'cab');
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

						if(!$uc->isFriend($p_user_data->id)){
							
							if(!$uc->isUserFollower($p_user_data->id)){
								
								?>
								<a href="javascript: void(0)" id="follow_<?php echo $p_user_data->id; ?>" onclick="follow(<?php echo $p_user_data->id; ?>)">Follow</a>
								<a href="javascript: void(0)" id="unfollow_<?php echo $p_user_data->id; ?>" onclick="unfollow(<?php echo $p_user_data->id; ?>)" hidden="hidden">Unfollow</a>
								<a href="javascript: void(0)" id="friend_<?php echo $p_user_data->id; ?>" onclick="friend(<?php echo $p_user_data->id; ?>)" hidden="hidden">Friend</a>
								<a href="javascript: void(0)" id="delete_friend_req_<?php echo $p_user_data->id; ?>" onclick="delete_friend_req(<?php echo $p_user_data->id; ?>)" hidden="hidden">Delete Friend Request</a>
								<?php
							}else{
								
								?>
								<a href="javascript: void(0)" id="follow_<?php echo $p_user_data->id; ?>" onclick="follow(<?php echo $p_user_data->id; ?>)" hidden="hidden">Follow</a>
								<a href="javascript: void(0)" id="unfollow_<?php echo $p_user_data->id; ?>" onclick="unfollow(<?php echo $p_user_data->id; ?>)">Unfollow</a>
								<?php
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

						}else{
							
							?>
							<a href="javascript: void(0)" id="friend_<?php echo $p_user_data->id; ?>" onclick="friend(<?php echo $p_user_data->id; ?>)" hidden="hidden">Friend</a>
							<a href="javascript: void(0)" id="unfriend_<?php echo $p_user_data->id; ?>" onclick="unfriend(<?php echo $p_user_data->id; ?>)">Unfriend</a>
							<a href="javascript: void(0)" id="delete_friend_req_<?php echo $p_user_data->id; ?>" onclick="delete_friend_req(<?php echo $p_user_data->id; ?>)" hidden="hidden">Delete Friend Request</a>
							<a href="javascript: void(0)" id="follow_<?php echo $p_user_data->id; ?>" onclick="follow(<?php echo $p_user_data->id; ?>)" hidden="hidden">Follow</a>
							<a href="javascript: void(0)" id="unfollow_<?php echo $p_user_data->id; ?>" onclick="unfollow(<?php echo $p_user_data->id; ?>)" hidden="hidden">Unfollow</a>
							<?php
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
						}
						?>
						<a href="javascript: void(0)" id="message_box">Inbox</a>
						<form method="POST" action="" id="inbox">
							<label for="msg_text">Message: </label>
							<textarea id="msg_text" name="msg_text" placeholder="Inbox this user."></textarea>
							<input type="hidden" name="userid" value="<?php echo $p_user_data->id; ?>">
							<input type="submit" value="SUBMIT" id="send_message">
						</form>
						<?php
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

			?>
			<div id="collection_box">
				<a href="javascript: void(0)" id="show_collection">Collection</a>
				<div id="my_collection" hidden="hidden">
					<div id="clc_form_div">
						<form id="create_clc_form" method="POST" action="">
							<input type="text" id="clc_form_text" name="clc_name" value="" placeholder="Create New Collection">
							<input type="submit" value="Create">
							<div id="clc_name_sugsn"></div>
						</form>
					</div>
					<?php
					$db_ucl->query("SELECT * FROM {$user_data->username}_collections_lists", array(), 'SELECT *');
					$tot_clc = $db_ucl->count();
					if($tot_clc>0){
						$clcns = $db_ucl->results();
						for($i=0; $i<$tot_clc; $i++){
							$clcn = $clcns[$i];
							?>
							<div id="collection">
								<br><a href="collection.php?clc=<?php echo $clcn->id; ?>"><?php echo $clcn->collection_name; ?></a><br>
								<span id="clc_counter"><?php echo $clcn->tot_posts; ?></span>
								<input type="hidden" id="collection_id" value="<?php echo $clcn->id; ?>">
							</div>
							<?php
						}

					}else{
						?>
						<p>Collections list is empty. Create a new one.</p>
						<?php
					}

					?>
				</div>
			</div>
			<div>
				<?php
				if($p_user_data->id == $user_data->id){

					$p_user_data = $user_data;
					$db_uf->query("SELECT * FROM {$p_user_data->username}_feeds WHERE action='UPLOADED' ORDER BY id DESC LIMIT 0,{$no_posts_pp}", array(), 'SELECT *');
					$tot_posts = $db_uf->count();
					
					if($tot_posts>0){

						$posts = $db_uf->results();
						$show_posts = ($tot_posts>=$no_posts_pp)?$no_posts_pp:$tot_posts;
						
						for($i=0; $i<$show_posts; $i++){
							
							$post = $posts[$i];
							$db_up->get($p_user_data->username.'_posts', array('id', '=', $post->post_id));
							$post_info = $db_up->first();
							$show_sec_feeder = "";
							include 'include/all_posts_div.php';
						
						}

					}else{

						?>
						<div>You have not uploaded anything.</div>
						<?php

					}


				}else{

					if($uc->isFriend($p_user_data->id)){

						$db_uf->query("SELECT * FROM {$p_user_data->username}_feeds WHERE action='UPLOADED' AND (privacy='FRIENDS' OR privacy='FOLLOWERS' OR privacy='PUBLIC') ORDER BY id DESC LIMIT 0,{$no_posts_pp}", array(), 'SELECT *');
						$tot_posts = $db_uf->count();
							
						if($tot_posts>0){

							$posts = $db_uf->results();
							$show_posts = ($tot_posts>=$no_posts_pp)?$no_posts_pp:$tot_posts;
						
							for($i=0; $i<$show_posts; $i++){
								
								$post = $posts[$i];
								$db_up->get($p_user_data->username.'_posts', array('id', '=', $post->post_id));
								$post_info = $db_up->first();
								$show_sec_feeder = "";
								include 'include/all_posts_div.php';
							
							}

						}else{

							?>
							<div><?php echo $p_user_data->name; ?> has not uploaded anything.</div>
							<?php

						}

					}else if($uc->isUserFollowing($p_user_data->id)){

						$db_uf->query("SELECT * FROM {$p_user_data->username}_feeds WHERE action='UPLOADED' AND (privacy='FOLLOWERS' OR privacy='PUBLIC') ORDER BY id DESC LIMIT 0,{$no_posts_pp}", array(), 'SELECT *');
						$tot_posts = $db_uf->count();
						if($tot_posts>0){

							$posts = $db_uf->results();
							$show_posts = ($tot_posts>=$no_posts_pp)?$no_posts_pp:$tot_posts;
						
							for($i=0; $i<$show_posts; $i++){
								
								$post = $posts[$i];
								$db_up->get($p_user_data->username.'_posts', array('id', '=', $post->post_id));
								$post_info = $db_up->first();
								$show_sec_feeder = "";
								include 'include/all_posts_div.php';
							
							}

						}else{

							?>
							<div><?php echo $p_user_data->name; ?> has not uploaded anything.</div>
							<?php

						}

					}

				}

				if(isset($tot_posts)){
					if($tot_posts>0){
						?>
						<input type="hidden" id="end_feed" value="<?php echo $posts[($show_posts-1)]->id; ?>">
						<?php
					}
				}
				?>
				<img src="images/LoaderIcon.gif" id="load_more" alt="Loading...">
				<input type="hidden" id="profile" value="<?php echo $p_user_data->id; ?>">
			</div>
			<?php
		}
		?>
		<div id="message"></div>
		<script type="text/javascript" src="javascripts/collection.js"></script>
		<script type="text/javascript" src="javascripts/autoload_profile_feeds.js"></script>
		<script type="text/javascript" src="javascripts/post_responses.js"></script>
		<script src="javascripts/user_connections.js"></script>
		<script src="javascripts/send_messages.js"></script>
		<script src="javascripts/send_personal_messages.js"></script>
	</body>
</html>
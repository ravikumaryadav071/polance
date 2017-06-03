<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$post_id = $_GET['post_id'];
		$post_type = strtoupper($_GET['post_type']);
		$last_seen = $_GET['last_seen'];
		$p_userid = $_GET['user'];
		$user_data = $user->data();
		$no_cmnts_pp = 20;

		$db = DB::getInstance();
		$db_up = DBusers_posts::getInstance();
		$db_upc = DBusers_posts_comments::getInstance();
		$uc = user_connections::getInstance();

		if($user_data->id != $p_userid){
			$db->get('users', array('id', '=', $p_userid));
			$p_user_data = $db->first();
		}else{
			$p_user_data = $user_data;
		}

		if($post_type == "USER"){

			if($last_seen == 'UNDEFINED'){
				$db_upc->query("SELECT * FROM {$p_user_data->username}_{$post_id}_comments ORDER BY id DESC LIMIT 0,{$no_cmnts_pp}", array(), 'SELECT *');
				$tot_comments = $db_upc->count();
			}else if(is_numeric($last_seen)){
				$db_upc->query("SELECT * FROM {$p_user_data->username}_{$post_id}_comments WHERE id<{$last_seen} ORDER BY id DESC LIMIT 0,{$no_cmnts_pp}", array(), 'SELECT *');
				$tot_comments = $db_upc->count();
			}

			if($tot_comments>0){

				$comments = $db_upc->results();
				$show_comments = ($tot_comments>=$no_cmnts_pp)?$no_cmnts_pp:$tot_comments;

				for($i=0; $i<$show_comments; $i++){

					$comment = $comments[$i];
					$c_userid = $comment->userid;
					$date = strtotime($comment->date);
					
					if($c_userid != $p_userid && $c_userid != $user_data->id){
						$db->get('users', array('id', '=', $c_userid));
						$c_user_data = $db->first();
					}else if($c_userid == $p_userid){
						$c_user_data = $p_user_data;
					}else{
						$c_user_data = $user_data;
					}

					?>
					<div>
						<div id="user_info">
							<a href="profile.php?user=<?php echo $c_user_data->username; ?>">
								<img height="30px", width="35px" src="<?php echo $c_user_data->profile_pic_dg;?>" alt="<?php echo $c_user_data->name; ?>">
								<?php echo $c_user_data->name; ?>
							</a>
							<span><?php echo date('d/M/Y h:i A', $date); ?></span>
							<pre><?php echo $comment->comment; ?></pre>
						</div>
					</div>
					<?php

				}

				if($tot_comments>=$no_cmnts_pp){
					?>
					<a href="javascript: void(0)" id="show_comments">Show More</a>
					<input type="hidden" id="last_seen" value="<?php echo $comments[($show_comments-1)]->id; ?>">
					<?php
				}else{
					?>
					<div>No more comments.</div>
					<?php
				}

			}else{

				if($last_seen == 'UNDEFINED'){
					?>
					<div>No comments on this post.</div>
					<?php
				}else{
					?>
					<div>No more comments on this post.</div>
					<?php
				}

			}

		}

	}

}

?>
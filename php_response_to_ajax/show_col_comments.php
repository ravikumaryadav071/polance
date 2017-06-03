<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$unique_name = trim($_GET['col_name']);
		$post_id = $_GET['post_id'];
		$last_seen = trim($_GET['last_seen']);

		$user_data = $user->data();
		$db = DB::getInstance();
		$db_col = DBcollaborations::getInstance();
		$db_cp = DBcollaborations_posts::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
		$db_cpc = DBcollaborations_posts_comments::getInstance();
		$no_cmnts_pp = 20;		//number of comments per page

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0){

			$col_info = $db_col->first();
			$db_cm->get($unique_name.'_members', array('userid', '=', $user_data->id));
			if($db_cm->count()>0){

				if($last_seen == 'UNDEFINED'){
					$db_cpc->query("SELECT * FROM {$unique_name}_{$post_id}_comments ORDER BY id DESC LIMIT 0,{$no_cmnts_pp}", array(), 'SELECT *');
					//echo "SELECT * FROM {$unique_name}_{$post_id}_comments ORDER BY id DESC LIMIT 0,{$no_cmnts_pp}";
					$tot_comments = $db_cpc->count();
				}else if(is_numeric($last_seen)){
					$db_cpc->query("SELECT * FROM {$unique_name}_{$post_id}_comments WHERE id<{$last_seen} ORDER BY id DESC LIMIT 0,{$no_cmnts_pp}", array(), 'SELECT *');
					$tot_comments = $db_cpc->count();
				}

				if($tot_comments>0){

					$comments = $db_cpc->results();
					$show_comments = ($tot_comments>=$no_cmnts_pp)?$no_cmnts_pp:$tot_comments;

					for($i=0; $i<$show_comments; $i++){

						$comment = $comments[$i];
						$c_userid = $comment->userid;
						$date = strtotime($comment->date);
						
						if($c_userid != $user_data->id){
							$db->get('users', array('id', '=', $c_userid));
							$c_user_data = $db->first();
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
						<a href="javascript: void(0)" id="show_col_comments">Show More</a>
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

}

?>
<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	$user_data = $user->data();
	$db = DB::getinstance();
	$db_col = DBcollaborations::getInstance();
	$db_un = DBusers_notifications::getinstance();
	$db_cp = DBcollaborations_posts::getInstance();

	$db_un->get('notifications_settings', array('userid', '=', $user_data->id));
	$ntf_stngs = $db_un->first();
	$query = "";
	if($ntf_stngs->upvote == 'ON'){
		$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND action='UPVOTED' GROUP BY post_id, userid, ntf_type, action ORDER BY id DESC)";
	}

	if($ntf_stngs->comment == 'ON'){
		$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND action='COMMENTED' GROUP BY post_id, userid, ntf_type, action ORDER BY id DESC)";
	}

	if($ntf_stngs->varify == 'ON'){
		$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND action='VARIFIED' GROUP BY post_id, userid, ntf_type, action ORDER BY id DESC)";
	}

	if($ntf_stngs->collect == 'ON'){
		$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND action='COLLECTED' GROUP BY post_id, userid, ntf_type, action ORDER BY id DESC)";
	}

	$db_un->query("(SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND (action='GRANTED' OR action='EDITED') ORDER BY id DESC) UNION (SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND (action='REPORTED' OR action='CONTRIBUTED' OR action='INVITED' OR action='FOLLOWING') GROUP BY post_id, userid, ntf_type, action ORDER BY id DESC) {$query} ORDER BY id DESC", array(), 'SELECT *');
	$tot_ntfs = $db_un->count();
	if($tot_ntfs>0){

		$ntfs = $db_un->results();
		
		for($i=0; $i<$tot_ntfs; $i++){

			$ntf = $ntfs[$i];
			$action = $ntf->action;

			if($ntf->ntf_type == 'USER'){
				$db->get('users', array('id', '=', $ntf->sec_userid));
				$s_user_data = $db->first();
				$db->get('users', array('id', '=', $ntf->userid));
				if($db->count()>0){
					$n_user_data = $db->first();
				}
			
			}else{
				if($action == 'GRANTED'){
					$db_col->get('collaborations', array('id', '=', $ntf->sec_userid));
					$col_data = $db_col->first();
				}else if($action == 'INVITED'){
					$db_col->get('collaborations', array('id', '=', $ntf->sec_userid));
					$col_data = $db_col->first();
					$db->get('users', array('id', '=', $ntf->sec_userid));
					if($db->count()>0){
						$s_user_data = $db->first();
					}
				}else{
					$db_col->get('collaborations', array('id', '=', $ntf->userid));
					$col_data = $db_col->first();
					$db_cp->get($col_data->unique_name.'_posts', array('id', '=', $ntf->post_id));
					$post_info = $db_cp->first();
					$db->get('users', array('id', '=', $ntf->sec_userid));
					if($db->count()>0){
						$s_user_data = $db->first();
					}
					$db->get('users', array('id', '=', $post_info->posted_by));
					if($db->count()>0){
						$n_user_data = $db->first();
					}

				}
			}

			if($action != 'GRANTED' && $action != 'CONTRIBUTED' && $action != 'EDITED'){
			
				$db_un->query("SELECT DISTINCT sec_userid FROM {$user_data->username}_notifications WHERE sec_userid!={$ntf->sec_userid} AND post_id={$ntf->post_id} AND userid={$ntf->userid} AND ntf_type='{$ntf->ntf_type}' AND action='{$action}' ORDER BY id DESC", array(), 'SELECT');
				$o_ntfs = $db_un->count();
				
				if($o_ntfs>1){
					$first_res = $db_un->first();
					$db->get('users', array('id', '=', $first_res->sec_userid));
					$o_user_data = $db->first();		//other user data with similar action on same post
				}

			}

			if($action == 'UPVOTED'){

				if($ntf->ntf_type=='USER'){

					?>
					<div id="users_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
						<?php
						if(isset($o_user_data)){
							
							if($o_ntfs==1){
								?>
								 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> have upvoted 
								<?php
							}else if($o_ntfs>1){
								?>
								, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) have upvoted 
								<?php
							}
							
						}else{
							?>
							 has upvoted 
							<?php
						}
						if($n_user_data->id == $user_data->id){
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> post.
							<?php
						}else{
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> post.
							<?php
						}
						?>
						<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php

				}else if($ntf->ntf_type == 'COLLABORATION'){

					?>
					<div id="col_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
						<?php
						if(isset($o_user_data)){
							
							if($o_ntfs==1){
								?>
								 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> have upvoted 
								<?php
							}else if($o_ntfs>1){
								?>
								, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) have upvoted 
								<?php
							}
							
						}else{
							?>
							 has upvoted 
							<?php
						}
						if($n_user_data->id == $user_data->id){
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<?php
						}else{
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<?php
						}
						?>
						<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php

				}

			}else if($action == 'VARIFIED'){

				if($ntf->ntf_type=='USER'){

					?>
					<div id="users_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
						<?php
						if(isset($o_user_data)){
							
							if($o_ntfs==1){
								?>
								 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> have verified 
								<?php
							}else if($o_ntfs>1){
								?>
								, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) have verified 
								<?php
							}
							
						}else{
							?>
							 has verified 
							<?php
						}
						if($n_user_data->id == $user_data->id){
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> post.
							<?php
						}else{
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> post.
							<?php
						}
						?>
						<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php

				}else if($ntf->ntf_type=='COLLABORATION'){

					?>
					<div id="col_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
						<?php
						if(isset($o_user_data)){
							
							if($o_ntfs==1){
								?>
								 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> have verified 
								<?php
							}else if($o_ntfs>1){
								?>
								, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) have verified 
								<?php
							}
							
						}else{
							?>
							 has verified 
							<?php
						}
						if($n_user_data->id == $user_data->id){
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<?php
						}else{
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<?php
						}
						?>
						<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php

				}

			}else if($action == 'COMMENTED'){

				if($ntf->ntf_type=='USER'){

					?>
					<div id="users_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
						<?php
						if(isset($o_user_data)){
							
							if($o_ntfs==1){
								?>
								 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> commented on  
								<?php
							}else if($o_ntfs>1){
								?>
								, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) upvoted 
								<?php
							}
							
						}else{
							?>
							 commented on 
							<?php
						}
						if($n_user_data->id == $user_data->id){
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> post.
							<?php
						}else{
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> post.
							<?php
						}
						?>
						<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php
					
				}else if($ntf->ntf_type=='COLLABORATION'){

					?>
					<div id="col_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
						<?php
						if(isset($o_user_data)){
							
							if($o_ntfs==1){
								?>
								 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> commented on  
								<?php
							}else if($o_ntfs>1){
								?>
								, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) upvoted 
								<?php
							}
							
						}else{
							?>
							 commented on 
							<?php
						}
						if($n_user_data->id == $user_data->id){
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<?php
						}else{
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<?php
						}
						?>
						<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php
					
				}

			}else if($action == 'COLLECTED'){

				if($ntf->ntf_type=='USER'){

					?>
					<div id="users_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
						<?php
						if(isset($o_user_data)){
							
							if($o_ntfs==1){
								?>
								 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> collected  
								<?php
							}else if($o_ntfs>1){
								?>
								, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) collected 
								<?php
							}
							
						}else{
							?>
							 collected 
							<?php
						}
						if($n_user_data->id == $user_data->id){
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> post.
							<?php
						}else{
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> post.
							<?php
						}
						?>
						<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php
					
				}else if($ntf->ntf_type=='COLLABORATION'){

					?>
					<div id="col_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
						<?php
						if(isset($o_user_data)){
							
							if($o_ntfs==1){
								?>
								 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> collected  
								<?php
							}else if($o_ntfs>1){
								?>
								, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) collected 
								<?php
							}
							
						}else{
							?>
							 collected 
							<?php
						}
						if($n_user_data->id == $user_data->id){
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<?php
						}else{
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<?php
						}
						?>
						<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php
					
				}

			}else if($action == 'CONTRIBUTED'){

				if($ntf->ntf_type == 'USER'){
					?>
					<div id="users_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_balnk"><?php echo $s_user_data->name; ?></a> has added you as contributor in his post.
						<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php
				}else if($ntf->ntf_type == 'COLLABORATION'){
					?>
					<div id="col_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_balnk"><?php echo $s_user_data->name; ?></a> has added you as contributor in his <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
						<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php
				}

			}else if($action == 'EDITED'){

				if($ntf->ntf_type == 'USER'){
					?>
					<div id="users_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_balnk"><?php echo $s_user_data->name; ?></a> has edited 
						<?php
						if($n_user_data->id == $user_data->id){
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> post.
							<?php
						}else{
							?>
							<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> post.
							<?php
						}
						?>
						<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php
				}else if($ntf->ntf_type == 'COLLABORATION'){
					?>
					<div id="col_post_ntf">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_balnk"><?php echo $s_user_data->name; ?></a> has added you as contributor in his <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
						<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php
				}

			}else if($action == 'REPORTED'){

				if($ntf->ntf_type=='USER'){

					?>
					<div id="users_post_ntf">
						<?php if($o_ntfs>0){ echo $o_ntfs; }else{ echo '1'; } ?> report(s) on your post.
						<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php
					
				}else if($ntf->ntf_type=='COLLABORATION'){

					?>
					<div id="col_post_ntf">
						<?php if($o_ntfs>0){ echo $o_ntfs; }else{ echo '1'; } ?> report(s) on your <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
						<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
						<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
					</div>
					<?php
					
				}

			}else if($action == 'GRANTED'){

				if($ntf->ntf_type=='USER'){

					?>
					<div>
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a> is now your friend.
					</div>
					<?php
					
				}else if($ntf->ntf_type == 'COLLABORATION'){

					?>
					<div>
						<a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> has accepted your request.
					</div>
					<?php

				}

			}else if($action == 'FOLLOWING'){

				?>
				<div>
					<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
					<?php
					if(isset($o_user_data)){
						
						if($o_ntfs==1){
							?>
							 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> now following 
							<?php
						}else if($o_ntfs>1){
							?>
							, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) now following 
							<?php
						}
						
					}else{
						?>
						 is now following 
						<?php
					}
					
					?>
					<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">you</a>.
				</div>
				<?php

			}else if($action == "INVITED"){

				?>
				<div id="col_invite">
					<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
					<?php
					if(isset($o_user_data)){
						
						if($o_ntfs==1){
							?>
							 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> have invited you to join 
							<?php
						}else if($o_ntfs>1){
							?>
							, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) have invited you to join 
							<?php
						}
						
					}else{
						?>
						 has invited you to join 
						<?php
					}
					
					?>
					<a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a>.
					<input type="hidden" id="col_name" value="<?php echo $col_data->unique_name; ?>">
					<input type="hidden" id="ntf_type" value="INVITATION">
				</div>
				<?php

			}

			unset($o_user_data);

		}
		$db_un->query("UPDATE {$user_data->username}_notifications SET sorn='SEEN' WHERE sorn='NOT SEEN'", array(), 'UPDATE');

	}else{

		$query = "";
		if($ntf_stngs->upvote == 'ON'){
			$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE action='UPVOTED' GROUP BY post_id, userid, ntf_type, action ORDER BY id DESC)";
		}

		if($ntf_stngs->comment == 'ON'){
			$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE action='COMMENTED' GROUP BY post_id, userid, ntf_type, action ORDER BY id DESC)";
		}

		if($ntf_stngs->varify == 'ON'){
			$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE action='VARIFIED' GROUP BY post_id, userid, ntf_type, action ORDER BY id DESC)";
		}

		if($ntf_stngs->collect == 'ON'){
			$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE action='COLLECTED' GROUP BY post_id, userid, ntf_type, action ORDER BY id DESC)";
		}

		$db_un->query("(SELECT * FROM {$user_data->username}_notifications WHERE action='GRANTED' OR action='EDITED' ORDER BY id DESC) UNION (SELECT * FROM {$user_data->username}_notifications WHERE action='REPORTED' OR action='CONTRIBUTED' OR action='INVITED' OR action='FOLLOWING' GROUP BY post_id, userid, ntf_type, action ORDER BY id DESC) {$query} ORDER BY id DESC", array(), 'SELECT *');
		$tot_ntfs = $db_un->count();
		if($tot_ntfs>0){

			$ntfs = $db_un->results();

			for($i=0; $i<$tot_ntfs; $i++){

				$ntf = $ntfs[$i];
				$action = $ntf->action;

				if($ntf->ntf_type == 'USER'){
					$db->get('users', array('id', '=', $ntf->sec_userid));
					$s_user_data = $db->first();
					$db->get('users', array('id', '=', $ntf->userid));
					if($db->count()>0){
						$n_user_data = $db->first();
					}
				
				}else{
					if($action == 'GRANTED'){
						$db_col->get('collaborations', array('id', '=', $ntf->sec_userid));
						$col_data = $db_col->first();
					}else if($action == 'INVITED'){
						$db_col->get('collaborations', array('id', '=', $ntf->sec_userid));
						$col_data = $db_col->first();
						$db->get('users', array('id', '=', $ntf->sec_userid));
						if($db->count()>0){
							$s_user_data = $db->first();
						}
					}else{
						$db_col->get('collaborations', array('id', '=', $ntf->userid));
						$col_data = $db_col->first();
						$db_cp->get($col_data->unique_name.'_posts', array('id', '=', $ntf->post_id));
						$post_info = $db_cp->first();
						$db->get('users', array('id', '=', $ntf->sec_userid));
						if($db->count()>0){
							$s_user_data = $db->first();
						}
						$db->get('users', array('id', '=', $post_info->posted_by));
						if($db->count()>0){
							$n_user_data = $db->first();
						}

					}
				}

				if($action != 'GRANTED' && $action != 'CONTRIBUTED'){
				
					$db_un->query("SELECT DISTINCT sec_userid FROM {$user_data->username}_notifications WHERE sec_userid!={$ntf->sec_userid} AND post_id={$ntf->post_id} AND userid={$ntf->userid} AND ntf_type='{$ntf->ntf_type}' AND action='{$action}' ORDER BY id DESC", array(), 'SELECT');
					$o_ntfs = $db_un->count();
					
					if($o_ntfs>0){
						$first_res = $db_un->first();
						$db->get('users', array('id', '=', $first_res->sec_userid));
						$o_user_data = $db->first();
					}

				}

				if($action == 'UPVOTED'){

					if($ntf->ntf_type=='USER'){

						?>
						<div id="users_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
							<?php
							if(isset($o_user_data)){
								
								if($o_ntfs==1){
									?>
									 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> have upvoted 
									<?php
								}else if($o_ntfs>1){
									?>
									, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) have upvoted 
									<?php
								}
								
							}else{
								?>
								 has upvoted 
								<?php
							}
							if($n_user_data->id == $user_data->id){
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> post.
								<?php
							}else{
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> post.
								<?php
							}
							?>
							<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php

					}else if($ntf->ntf_type == 'COLLABORATION'){

						?>
						<div id="col_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
							<?php
							if(isset($o_user_data)){
								
								if($o_ntfs==1){
									?>
									 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> have upvoted 
									<?php
								}else if($o_ntfs>1){
									?>
									, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) have upvoted 
									<?php
								}
								
							}else{
								?>
								 has upvoted 
								<?php
							}
							if($n_user_data->id == $user_data->id){
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
								<?php
							}else{
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
								<?php
							}
							?>
							<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php

					}

				}else if($action == 'VARIFIED'){

					if($ntf->ntf_type=='USER'){

						?>
						<div id="users_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
							<?php
							if(isset($o_user_data)){
								
								if($o_ntfs==1){
									?>
									 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> have verified 
									<?php
								}else if($o_ntfs>1){
									?>
									, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) have verified 
									<?php
								}
								
							}else{
								?>
								 has verified 
								<?php
							}
							if($n_user_data->id == $user_data->id){
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> post.
								<?php
							}else{
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> post.
								<?php
							}
							?>
							<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php

					}else if($ntf->ntf_type=='COLLABORATION'){

						?>
						<div id="col_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
							<?php
							if(isset($o_user_data)){
								
								if($o_ntfs==1){
									?>
									 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> have verified 
									<?php
								}else if($o_ntfs>1){
									?>
									, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) have verified 
									<?php
								}
								
							}else{
								?>
								 has verified 
								<?php
							}
							if($n_user_data->id == $user_data->id){
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
								<?php
							}else{
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
								<?php
							}
							?>
							<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php

					}

				}else if($action == 'COMMENTED'){

					if($ntf->ntf_type=='USER'){

						?>
						<div id="users_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
							<?php
							if(isset($o_user_data)){
								
								if($o_ntfs==1){
									?>
									 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> commented on  
									<?php
								}else if($o_ntfs>1){
									?>
									, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) upvoted 
									<?php
								}
								
							}else{
								?>
								 commented on 
								<?php
							}
							if($n_user_data->id == $user_data->id){
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> post.
								<?php
							}else{
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> post.
								<?php
							}
							?>
							<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php
						
					}else if($ntf->ntf_type=='COLLABORATION'){

						?>
						<div id="col_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
							<?php
							if(isset($o_user_data)){
								
								if($o_ntfs==1){
									?>
									 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> commented on  
									<?php
								}else if($o_ntfs>1){
									?>
									, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) upvoted 
									<?php
								}
								
							}else{
								?>
								 commented on 
								<?php
							}
							if($n_user_data->id == $user_data->id){
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
								<?php
							}else{
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
								<?php
							}
							?>
							<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php
						
					}

				}else if($action == 'COLLECTED'){

					if($ntf->ntf_type=='USER'){

						?>
						<div id="users_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
							<?php
							if(isset($o_user_data)){
								
								if($o_ntfs==1){
									?>
									 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> collected  
									<?php
								}else if($o_ntfs>1){
									?>
									, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) collected 
									<?php
								}
								
							}else{
								?>
								 collected 
								<?php
							}
							if($n_user_data->id == $user_data->id){
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> post.
								<?php
							}else{
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> post.
								<?php
							}
							?>
							<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php
						
					}else if($ntf->ntf_type=='COLLABORATION'){

						?>
						<div id="col_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
							<?php
							if(isset($o_user_data)){
								
								if($o_ntfs==1){
									?>
									 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> collected  
									<?php
								}else if($o_ntfs>1){
									?>
									, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) collected 
									<?php
								}
								
							}else{
								?>
								 collected 
								<?php
							}
							if($n_user_data->id == $user_data->id){
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
								<?php
							}else{
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
								<?php
							}
							?>
							<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php
						
					}

				}else if($action == 'CONTRIBUTED'){

					if($ntf->ntf_type == 'USER'){
						?>
						<div id="users_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_balnk"><?php echo $s_user_data->name; ?></a> has added you as contributor in his post.
							<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php
					}else if($ntf->ntf_type == 'COLLABORATION'){
						?>
						<div id="col_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_balnk"><?php echo $s_user_data->name; ?></a> has added you as contributor in his <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php
					}

				}else if($action == 'EDITED'){

					if($ntf->ntf_type == 'USER'){
						?>
						<div id="users_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_balnk"><?php echo $s_user_data->name; ?></a> has edited 
							<?php
							if($n_user_data->id == $user_data->id){
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">your</a> post.
								<?php
							}else{
								?>
								<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank"><?php echo $n_user_data->name; ?></a> post.
								<?php
							}
							?>
							<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php
					}else if($ntf->ntf_type == 'COLLABORATION'){
						?>
						<div id="col_post_ntf">
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_balnk"><?php echo $s_user_data->name; ?></a> has added you as contributor in his <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php
					}

				}else if($action == 'REPORTED'){

					if($ntf->ntf_type=='USER'){

						?>
						<div id="users_post_ntf">
							<?php if($o_ntfs>0){ echo $o_ntfs; }else{ echo '1'; } ?> report(s) on your post.
							<input type="hidden" id="popup_p_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_p_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php
						
					}else if($ntf->ntf_type=='COLLABORATION'){
						?>
						<div id="col_post_ntf">
							<?php if($o_ntfs>0){ echo $o_ntfs; }else{ echo '1'; } ?> report(s) on your <a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> post.
							<input type="hidden" id="popup_c_user" value="<?php echo $ntf->userid; ?>">
							<input type="hidden" id="popup_c_post_id" value="<?php echo $ntf->post_id; ?>">
						</div>
						<?php
					}

				}else if($action == 'GRANTED'){

					if($ntf->ntf_type=='USER'){

						?>
						<div>
							<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a> is now your friend.
						</div>
						<?php
						
					}else if($ntf->ntf_type == 'COLLABORATION'){

						?>
						<div>
							<a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a> has accepted your request.
						</div>
						<?php

					}

				}else if($action == 'FOLLOWING'){

					?>
					<div>
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
						<?php
						if(isset($o_user_data)){
							
							if($o_ntfs==1){
								?>
								 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> now following 
								<?php
							}else if($o_ntfs>1){
								?>
								, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) now following 
								<?php
							}
							
						}else{
							?>
							 is now following
							<?php
						}
						
						?>
						<a href="profile.php?user=<?php echo $n_user_data->username; ?>" target="_blank">you</a>.
					</div>
					<?php

				}else if($action == "INVITED"){

					?>
					<div id="col_invite">
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank"><?php echo $s_user_data->name; ?></a>
						<?php
						if(isset($o_user_data)){
							
							if($o_ntfs==1){
								?>
								 and <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> have invited you to join 
								<?php
							}else if($o_ntfs>1){
								?>
								, <a href="profile.php?user=<?php echo $o_user_data->username; ?>" target="_blank"><?php echo $o_user_data->name; ?></a> and <?php echo ($o_ntfs-1); ?> other(s) have invited you to join 
								<?php
							}
							
						}else{
							?>
							 has invited you to join 
							<?php
						}
						
						?>
						<a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank"><?php echo $col_data->collaboration_name; ?></a>.
						<input type="hidden" id="col_name" value="<?php echo $col_data->unique_name; ?>">
						<input type="hidden" id="ntf_type" value="INVITATION">
					</div>
					<?php

				}

				unset($o_user_data);

			}

		}else{

			echo 'You have not have any notifications.';

		}

	}

}

?>
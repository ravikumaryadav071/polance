<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){
		
		$db_col = DBcollaborations::getInstance();
		$unique_name = trim($_GET['col']);

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
		if($db_col->count()>0){

			$user_data = $user->data();
			$col_info = $db_col->first();
			$db_cm = DBcollaborations_members::getInstance();
			$db_cm->get($unique_name.'_members', array('userid', '=', $user_data->id));
			if($db_cm->count()>0){

				$db = DB::getInstance();
				$db_uc = DBusers_connection::getInstance();

				$db_uc->query("(SELECT userid FROM {$user_data->username}_friends) UNION (SELECT userid FROM {$user_data->username}_followers)", array(), 'SELECT *');
				$tot_users = $db_uc->count();
				if($tot_users>0){

					$f_users = $db_uc->results();
					for($i=0; $i<$tot_users; $i++){

						$f_user = $f_users[$i];
						$db_cm->get("{$unique_name}_members", array('userid', '=', $f_user->userid));
						if($db_cm->count()==0){

							$db_cm->get("{$unique_name}_invitations", array('userid', '=', $f_user->userid));
							if($db_cm->count()==0){
								$db->get('users', array('id', '=', $f_user->userid));
								$f_user_data = $db->first();
								?>
								<div>
									<a href="profile.php?user=<?php echo $f_user_data->username; ?>" target="_blank">
										<img src="<?php echo $f_user_data->profile_pic_dg; ?>" height="30px" width="35px">
										<?php echo $f_user_data->name; ?>
									</a>
									<input type="hidden" id="i_user" value="<?php echo $f_user->userid; ?>">
									<input type="button" id="send_invitation" value="Invite">
								</div>
								<?php
							}

						}

					}

				}else{
					echo 'You do not have any user to invite.';
				}
			}

		}

	}

}

?>
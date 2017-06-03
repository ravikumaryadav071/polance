<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$unique_name = trim($_GET['col']);
		$db_col = DBcollaborations::getInstance();
		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0){

			$user_data = $user->data();
			$col_info = $db_col->first();
			$db_cm = DBcollaborations_members::getInstance();

			$db_cm->get("{$unique_name}_members", array('userid', '=', $user_data->id));
			if($db_cm->count()==0){

				$db_cm->get("{$unique_name}_invitations", array('userid', '=', $user_data->id));
				if($db_cm->count()>0){

					$db_col->get('collaborations', array('id', '=', $col_info->col_id));
					$col_data = $db_col->first();

					?>
					<div>
						<a href="collaboration.php?col=<?php echo $col_data->unique_name; ?>" target="_blank">
							<img src="<?php echo $col_data->profile_pic_dg; ?>" width="30px" height="25px">
							<?php echo $col_data->collaboration_name; ?>
						</a>
						<input type="hidden" id="col_name" value="<?php echo $col_data->unique_name; ?>">
						<input type="button" id="accept_invite" value="Accept">
						<input type="button" id="reject_invite" value="Reject">
					</div>
					<?php

				}
			}

		}

	}

}

?>
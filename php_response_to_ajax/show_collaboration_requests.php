<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$db = DB::getInstance();
		$db_col = DBcollaborations::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
		$unique_name = trim($_GET['col']);
		$user_data = $user->data();

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0){

			$db_cm->query("SELECT * FROM {$unique_name}_members WHERE userid={$user_data->id} AND member_type='ADMIN'", array(), 'SELECT *');

			if($db_cm->count()>0){

				$db_cm->query("SELECT * FROM {$unique_name}_requests", array(), 'SELECT *');
				$tot_requests = $db_cm->count();

				if($tot_requests>0){

					$requests = $db_cm->results();

					for($i=0; $i<$tot_requests; $i++){

						$request = $requests[$i];
						$db->get('users', array('id', '=', $request->userid));
						$r_user_data = $db->first();
						?>
						<div>
							<a href="profile.php?user=<?php echo $r_user_data->username; ?>" target="_blank">
								<img height="20px" width="25px" src="<?php echo $r_user_data->profile_pic_dg; ?>">
								<?php echo $r_user_data->name; ?>
							</a>
							<input type="button" id="accept" value="Accept">
							<input type="button" id="reject" value="Reject">
							<input type="hidden" id="user" value="<?php echo $r_user_data->id; ?>">
							<input type="hidden" id="col_name" value="<?php echo $unique_name; ?>">
						</div>
						<?php

					}

				}else{

					echo 'No requests.';

				}

			}

		}

	}

}

?>
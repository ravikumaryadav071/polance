<?php
require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	$db = DB::getInstance();
	$db_uc = DBusers_connection::getInstance();
	$user_data = $user->data();
	$db_uc->query('SELECT CURRENT_TIMESTAMP', array(), 'SELECT');
	$time = $db_uc->first();
	$time = $time->CURRENT_TIMESTAMP;
	$time = strtotime($time);
	$time = $time-30;
	//$time = localtime();
	$date = date('Y-m-d H:i:s', $time);
	
	$db_uc->query("SELECT * FROM {$user_data->username}_friends", array(), 'SELECT *');
	$tot_frnds = $db_uc->count();

	if($tot_frnds>0){

		$friends = $db_uc->results();
		for($i=0; $i<$tot_frnds; $i++){

			$friend = $friends[$i];
			$db->query("SELECT * FROM online_users WHERE userid={$friend->userid} AND date>'{$date}'");
			if($db->count()>0){
				$db->get('users', array('id', '=', $friend->userid));
				$f_user_data = $db->first();
				?>
				<div>
					<a href="javascript: void(0)" id="init_chat">
						<img src="<?php echo $f_user_data->profile_pic_dg; ?>">
						<?php echo $f_user_data->name; ?>
					</a>
					<p> Online </p>
					<input type="hidden" id="chat_user" value="<?php echo $f_user_data->id; ?>">
				</div>
				<?php
			}

		}

	}

}

?>
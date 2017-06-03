<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	$db = DB::getInstance();
	$db_uc = DBusers_connection::getInstance();
	$db_msgs = DBusers_messages::getInstance();
	$uc = user_connections::getInstance();

	if(isset($_GET) && !empty($_GET)){

		$c_userid = $_GET['user'];
		$userid = $_SESSION['user'];

		if(!$uc->isUserBlocked($c_userid)){

			$db->get('users', array('id', '=', $c_userid));
			$c_user_data = $db->first();
			$user_data = $user->data();

			$db_msgs->query("SELECT * FROM {$user_data->username}_messages WHERE userid = {$c_userid} AND sorr = 'RECEIVED' AND sorn = 'NOT SEEN' ORDER BY date ASC, id ASC", array(), 'SELECT *');
			$is_msgs = $db_msgs->count();

			if($is_msgs>0){

				$msgs = $db_msgs->assocresults();
				$db_msgs->update($user_data->username.'_messages', array('sorn'=>'SEEN'), array('userid', '=', $c_userid));

				for($i=0; $i<$is_msgs; $i++){

					$msg = $msgs[$i];
					$date = strtotime($msg['date']);

					?>
					<div id="received_msg_container" style="background-color: #99FFFF">
						<a><?php echo $c_user_data->name; ?>: on <?php echo date('d/m/Y h:i:s A', $date); ?></a>
						<p><pre><?php echo $msg['message']; ?></pre></p>
						<?php
						if($msg['extention'] != 'TEXT'){
							?>
							<a href="<?php echo $msg['path']; ?>" download>Download File</a>
							<?php
						}
						?>
					</div>
					<?php

				}

			}
		}

	}

}

?>
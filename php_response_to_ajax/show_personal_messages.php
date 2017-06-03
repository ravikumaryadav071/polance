<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	$db = DB::getInstance();
	$db_msgs = DBusers_messages::getInstance();
	$user_data = $user->data();

	$db_msgs->query("SELECT * FROM {$user_data->username}_messages ORDER BY date DESC, id DESC", array(), 'SELECT *');
	$is_msgs = $db_msgs->count();

	if($is_msgs > 0){

		$messages = $db_msgs->assocresults();
		$talked_ids = array();

		for($i=0; $i<$is_msgs; $i++){

			$msg = $messages[$i];
			$sec_user = $msg['userid'];
			$ext = $msg['extention'];

			if(($msg['sorn']=='NOT SEEN') && ($msg['sorr']=='RECEIVED')){

				$db_msgs->update($user_data->username.'_messages', array('sorn'=>'SEEN'), array('id', '=', $msg['id']));

			}

			if(!in_array($sec_user, $talked_ids)){

				$talked_ids[] = $sec_user;
				$db->get('users', array('id', '=', $sec_user));
				$sec_user_data = $db->first();
				$date = strtotime($msg['date']);

				if($ext == 'TEXT'){

					if($msg['sorr']=='SENT'){

						?>
						<div id="sent_message_container" style="background-color: #CCCCFF">
							<a href="javascript: void(0)" id="personal_message">
								<p>Me: at <?php echo date('d/m/y h:i:s A', $date); ?></p>
								<p><pre><?php echo $msg['message']; ?></pre></p>
							</a>
							<input type="hidden" id="chat_user" value="<?php echo $msg['userid']; ?>">
						</div>
						<?php

					}else{

						if($msg['sorr']=='RECEIVED'){

							?>
							<div id="received_message_container" style="background-color: #99FFFF">
								<a href="javascript: void(0)" id="personal_message">
									<p><?php echo $sec_user_data->name; ?> at <?php echo date('d/m/Y h:i:s A', $date); ?></p>
									<p><pre><?php echo $msg['message']; ?></pre></p>
								</a>
								<input type="hidden" id="chat_user" value="<?php echo $msg['userid']; ?>">
							</div>
							<?php

						}

					}

				}else{

					if($msg['sorr']=='SENT'){

						?>
						<div id="sent_message_container" style="background-color: #CCCCFF">
							<a href="javascript: void(0)" id="personal_message">
								<p>Me: at <?php echo date('d/m/y h:i:s A', $date); ?></p>
								<p><pre><?php echo $msg['message']; ?></pre></p>
							</a>
							<a href="<?php echo $msg['path']; ?>" download>File</a>
							<input type="hidden" id="chat_user" value="<?php echo $msg['userid']; ?>">
						</div>
						<?php

					}else{

						if($msg['sorr']=='RECEIVED'){

							?>
							<div id="received_message_container" style="background-color: #99FFFF">
								<a href="javascript: void(0)" id="personal_message">
									<p><?php echo $sec_user_data->name; ?> at <?php echo date('d/m/Y h:i:s A', $date); ?></p>
									<p><pre><?php echo $msg['message']; ?></pre></p>
								</a>
								<a href="<?php echo $msg['path']; ?>" download>Download File</a>
								<input type="hidden" id="chat_user" value="<?php echo $msg['userid']; ?>">
							</div>
							<?php

						}

					}					

				}


			}

		}

	}else{

		?>
		<p>Your inbox is empty.</p>
		<?php

	}

}

?>
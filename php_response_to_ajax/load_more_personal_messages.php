<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$c_user_id = $_GET['user'];
		$page_no = $_GET['page'];
		$start_chat_id = $_GET['start_id'];

		if(!empty($c_user_id) && !empty($page_no) && !empty($start_chat_id)){

			$db = DB::getInstance();
			$db_msgs = DBusers_messages::getInstance();
			$uc = user_connections::getInstance();
			$no_chats_pp = 20;		//number of chats per page

			$user_data = $user->data();
			$db->get('users', array('id', '=', $c_user_id));
			$c_user_data = $db->first();

			$db_msgs->query("SELECT * FROM {$user_data->username}_messages WHERE id<{$start_chat_id} AND userid = {$c_user_id} ORDER BY date DESC, id DESC LIMIT 0,{$no_chats_pp}", array(), 'SELECT *');
			$total_msgs = $db_msgs->count();
			
			if($total_msgs>0){
				$msgs = $db_msgs->assocresults();
			}

			$start = ($total_msgs>=$no_chats_pp)?$no_chats_pp:$total_msgs;

			for($i=$start-1; $i>=0; $i--){

				$msg = $msgs[$i];
				$date = strtotime($msg['date']);

				if($msg['sorr'] == 'RECEIVED'){

					?>
					<div id="received_msg_container" style="background-color: #99FFFF">
						<p><?php echo $c_user_data->name; ?> at <?php echo date('d/m/Y h:i:s A', $date); ?></p>
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

				if($msg['sorr'] == 'SENT'){

					?>
					<div id="sent_message_container" style="background-color: #CCCCFF">
						<p>Me: at <?php echo date('d/m/y h:i:s A', $date); ?></p>
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
			if($total_msgs > 0){

				?>
				<input type="hidden" id="start_id" value="<?php echo $msg[0]['id']; ?>">
				<?php

			}else{

				?>
				<p>No More Messages.</p>
				<?php

			}

		}

	}

}
?>
<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$userid = $_SESSION['user'];
		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$db_msgs = DBusers_messages::getInstance();
		$uc = user_connections::getInstance();
		$chat_userid = $_GET['chat_user'];
		$user_data = $user->data();

		if($uc->isFriend($chat_userid)){

			$db->get('users', array('id', '=', $chat_userid));
			$c_user_data = $db->first();
			$no_chats_pp = 20;		//number of chats per page

			$db_msgs->query("SELECT * FROM {$user_data->username}_messages WHERE userid = {$chat_userid} ORDER BY date DESC, id DESC LIMIT 0,{$no_chats_pp}", array(), 'SELECT *');
			$is_chat = $db_msgs->count();	

			?>
			<div class="col-lg-12 checkborder">
				<div class="col-lg-12 chatFixedHeight checkborder">
					<?php

					if($is_chat != 0){

						$chats = $db_msgs->assocresults();
						$db_msgs->update($user_data->username.'_messages', array('sorn' => 'SEEN'), array('userid', '=', $chat_userid));

						if($is_chat >= $no_chats_pp){
							?>
							<input type="button" id="load_more" value="LOAD MORE">
							<?php
						}

						$init_msgs = ($is_chat>=$no_chats_pp)? $no_chats_pp : $is_chat;		//initial messages to be shown

						for($i=$init_msgs-1; $i>=0; $i--){

							$chat = $chats[$i];
							$date = strtotime($chat['date']);
							$ext = $chat['extention'];
							$path = $chat['path'];

							if($chat['sorr']=='SENT'){

								?>
								<div id="sent_msg_container" style="background-color: #CCCCFF">
									<a>Me: on <?php echo date('d/m/Y h:i:s A', $date); ?></a>
									<p><pre><?php echo $chat['message']; ?></pre></p>
									<?php
									if($ext != 'TEXT'){
										?>
										<a href="<?php echo $path; ?>" download>Download File</a>
										<?php
									}
									?>
								</div>
								<?php

							}else{

								if($chat['sorr']=='RECEIVED'){

									?>
									<div id="received_msg_container" style="background-color: #99FFFF">
										<a><?php echo $c_user_data->name; ?>: on <?php echo date('d/m/Y h:i:s A', $date); ?></a>
										<p><pre><?php echo $chat['message']; ?></pre></p>
										<?php
										if($ext != 'TEXT'){
											?>
											<a href="<?php echo $path; ?>" download>Download File</a>
											<?php
										}
										?>
									</div>
									<?php

								}

							}

						}

					}else{

						echo "No chat with this user.";

					}
					?>
				</div>
					<?php
					if(!$uc->isUserBlocked($chat_userid)){

						?>
						<div class="col-lg-12 chatform checkborder">
							<div id="show_status"></div>
							<form id="send_message" action="" method="POST" enctype="multipart/form-data">
								<textarea id="text_message" name="personal_msg_text" placeholder="Type your message" value=""></textarea>
								<input type="hidden" id="chat_userid" name="userid" value="<?php echo $chat_userid; ?>">
								<input type="file" id="file" name="file">
								<input type="submit" id="send" value="SEND">
							</form>
							<?php
							if($is_chat != 0){
								?>
								<input type="hidden" id="start_id" value="<?php echo $chats[($no_chats_pp-1)]['id'];?>">
								<?php
							}
							?>
							<input type="button" id="block" value="Block" onClick="block(<?php echo $chat_userid?>)">
							<input type="button" id="chat_userid" value="Unblock" onClick="unblock(<?php echo $chat_userid?>)" hidden="hidden">
						</div>
						<?php

					}else{

						echo "You are blocked";

					}

				?>
			</div>
			<?php
		}

	}
}
?>
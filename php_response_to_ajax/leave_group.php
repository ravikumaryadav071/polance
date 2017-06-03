<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$user_data = $user->data();
		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$db_msgs = DBusers_messages::getInstance();
		$db_gm = DBgroups_messages::getInstance();
		$uc = user_connections::getInstance();
		
		$table_name = $_GET['group'];
		$db_gm->query("SELECT * FROM groups WHERE table_name='{$table_name}'", array(), 'SELECT *');

		if($db_gm->count()>0){
			
			$db_gm->get('members_'.$table_name, array('member_id', '=', $user_data->id));
			
			if($db_gm->count()>0){

				$user_group_info = $db_gm->first();

				$db_gm->delete('members_'.$table_name, array('member_id', '=', $user_data->id));
				if(!$db_gm->error()){	

					$db_msgs->get($user_data->username.'_chat_groups', array('chat_table', '=', $table_name));
					
					if(!$db_msgs->error()){
						
						$result = $db_msgs->first();						
						$db_msgs->delete($user_data->username.'_chat_groups', array('chat_table', '=', $table_name));
						
						if(!$db_msgs->error()){

							$db_msgs->insert($user_data->username.'_deleted_chat_groups', array('name'=>$result->name, 'chat_table'=>$result->chat_table));
							$db_gm->insert($table_name, array('sent_by'=>$user_data->id, 'message'=>"{$user_data->name} has left this group.", 'file_type'=>'TEXT_MESSAGE', 'extention'=>'TEXT'));
							session::flash('my_groups', "You have left {$result->name}.");
							echo 'SUCCESS';

						}else{
						
							$db_gm->insert('members_'.$table_name, array('member_id'=>$user_data->id));
							$db_msgs->insert($user_data->username.'_chat_groups', array('chat_table'=>$table_name, 'name'=>$result->name));
							$db_gm->query("ALTER TABLE {$table_name} ADD user_sorn_{$user_data->id} varchar(10) not null default 'SEEN' AFTER extention", array(), 'ALTER');
							$db_gm->query("ALTER TABLE {$table_name} MODIFY user_sorn_{$user_data->id} default 'NOT SEEN'", array(), 'ALTER');
							echo 'Failed to leave the group.1';
						}

					}else{
				
						$db_gm->insert('members_'.$table_name, array('member_id'=>$user_data->id));
						$db_gm->query("ALTER TABLE {$table_name} ADD user_sorn_{$user_data->id} varchar(10) not null default 'SEEN' AFTER extention", array(), 'ALTER');
						$db_gm->query("ALTER TABLE {$table_name} MODIFY user_sorn_{$user_data->id} default 'NOT SEEN'", array(), 'ALTER');	
						echo 'Failed to leave the group.2';
					}

				}else{
					
					$db_gm->insert('members_'.$table_name, array('member_id'=>$user_data->id));
								
					echo 'Failed to leave the group.4';
				}
			
			}

		}

	}

}

?>
<?php

require_once 'core/init.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$db_msgs = DBusers_messages::getInstance();
		$db_gm = DBgroups_messages::getInstance();
		$uc = user_connections::getInstance();
		$table_name = 'group_';
		$user_data = $user->data();
		$group_name = trim($_POST['group_name']);
		$tot_users = count($_POST['add_user']);

		if($tot_users>=2 && $tot_users<=30){

			$strs = explode(' ', $group_name);
			foreach ($strs as $key => $value) {
				if(is_numeric($value) || ctype_alpha($value) || ctype_alnum($value)){
					$table_name .= $value.'_';
				}
			}
			$table_name .= $user_data->username;
			$db_gm->query("SELECT * FROM groups WHERE table_name LIKE '%$table_name%'", array(), 'SELECT *');
			$pts = $db_gm->count();			//previous tables

			if($pts>0){
				$table_name .= '_'.$pts;
			}

			$db_gm->insert('groups', array('created_by'=>$user_data->id, 'group_name'=>$group_name, 'table_name'=>$table_name));

			$db_gm->query("CREATE TABLE {$table_name} (id int not null auto_increment primary key, message text not null, sent_by int not null, file_type varchar(200) not null default 'TEXT_MESSAGE', extention varchar(50) not null default 'TEXT', path varchar(500) not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
			$db_gm->query("CREATE TABLE members_{$table_name} (id int not null auto_increment primary key, member_id int not null)");
			
			if(!$db_gm->error()){

				mkdir("group_chats_data/{$table_name}");
				$db_gm->insert('members_'.$table_name, array('member_id'=>$user_data->id));
				$db_msgs->insert($user_data->username.'_chat_groups', array('name'=>$group_name, 'chat_table'=>$table_name, 'sorn'=>'SEEN', 'last_seen'=>1));
				for($i=0; $i<$tot_users; $i++){

					$au = $_POST['add_user'][$i];
					if($uc->isFriend($au)){

						$db->get('users', array('id', '=', $au));
						$f_user_data = $db->first();
						$db_gm->insert('members_'.$table_name, array('member_id'=>$f_user_data->id));
						$db_msgs->insert($f_user_data->username.'_chat_groups', array('name'=>$group_name, 'chat_table'=>$table_name, 'last_seen'=>0));

					}

				}

				$db_gm->insert($table_name, array('sent_by'=>$user_data->id, 'message'=>"{$user_data->name} has created this group. Enjoy the pleasure of polance. Make your interests more intersesting. :)"));
				redirect::to('group_chat.php?group='.$table_name);
			}

		}else{

			redirect::to('new_group.php');

		}

	}

}

?>
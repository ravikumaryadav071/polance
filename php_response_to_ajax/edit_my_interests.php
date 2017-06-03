<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$user_data = $user->data();
		$db_ui = DBusers_interests::getInstance(); 
		
		$id_in_db = trim($_GET['int_id']);
		$int_name = trim($_GET['interest']);
		$id_in_st = trim($_GET['search_id']);
		$action = trim($_GET['action']);
		$init_char = strtolower(substr($int_name, 0, 1));
		$db_pd = DBpolance_data::getInstance();
		
		$db_pd->get("interests_domain_{$init_char}", array('id', '=', $id_in_st));
		$s_int_info = $db_pd->first();		//interests info from search table
		$db_id = $s_int_info->db_id;

		$db_pd->get("main_interests_domain", array('id', '=', $db_id));
		$db_info = $db_pd->first();
		$db_temp = new DBtemp($db_info->db_name);

		$db_ui->query("SELECT * FROM {$user_data->username}_interests WHERE id_in_db={$id_in_db} AND db_id={$db_id} AND name_init='{$init_char}' AND id_in_st={$id_in_st}", array(), 'SELECT *');
		
		if($action == 'ADD'){

			if($db_ui->count()==0){
				
				$db_ui->insert($user_data->username.'_interests', array('id_in_db'=>$id_in_db, 'db_id'=>$db_id, 'name_init'=>$init_char, 'id_in_st'=>$id_in_st));
				$db_temp->get($db_info->interests_table, array('id', '=', $id_in_db));
				$int_info = $db_temp->first();
				$db_temp->get($int_info->table_name.'_subscribers', array('userid', '=', $user_data->id));
				if($db_temp->count()==0){
					$db_temp->insert($int_info->table_name.'_subscribers', array('userid'=>$user_data->id));
				}
				if(!$db_ui->error()){

					echo "Interest added.";

				}

			}else{

				echo "Interest already added.";

			}

		}else if($action == 'REMOVE'){

			if($db_ui->count()>0){

				$db_ui->query("DELETE FROM {$user_data->username}_interests WHERE id_in_db={$id_in_db} AND db_id={$db_id} AND name_init='{$init_char}' AND id_in_st={$id_in_st}", array(), 'DELETE');

				if(!$db_ui->error()){

					echo "Interest deleted.";

				}

			}else{

				echo "Interest is not in your list.";

			}

		}

	}

}

?>
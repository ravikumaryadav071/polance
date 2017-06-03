<?php

require_once '../core/initi.php';

$user = new user();
// print_r($_GET);
if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){


		if(isset($_GET['search']) && !empty($_GET['search'])){
		
			$db_pd = DBpolance_data::getInstance();
			$db_ui = DBusers_interests::getInstance();
			$user_data = $user->data();
			$search_text = trim($_GET['search']);
			$no_suggestions = 10; //number of suggestions

			if(ctype_alpha($search_text) && $search_text != ''){
				
				$int_char = substr($search_text, 0, 1);
				$int_char = strtolower($int_char);
				
				$db_ui->get($user_data->username.'_interests', array('name_init', '=', $int_char));
				$tot_exsts = $db_ui->count();

				if($tot_exsts >0){
					$exsts = $db_ui->results();
					$condition = "";

					for($i=0; $i<$tot_exsts; $i++){

						$exst = $exsts[$i];
						$condition .= "AND id != {$exst->id_in_st}";

					}

					$db_pd->query("SELECT * FROM interests_domain_{$int_char} WHERE name LIKE '%{$search_text}%' {$condition} LIMIT 0,{$no_suggestions}", array(), 'SELECT *');
					$tot_sug = $db_pd->count();

				}else{

					//echo 'here';
					$db_pd->query("SELECT * FROM interests_domain_{$int_char} WHERE name LIKE '%{$search_text}%' LIMIT 0,{$no_suggestions}", array(), 'SELECT *');
					$tot_sug = $db_pd->count();
					//echo "$tot_sug";
				}

			 	include '../include/interests_suggestions.php';

			}

		}

	}

}

?>
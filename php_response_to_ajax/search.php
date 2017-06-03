<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET)){

		$db = DB::getInstance();
		$user_data = $user->data();

		$search_text = $_GET['search_text'];

		$db->query("SELECT name FROM users WHERE id != $user_data->id AND (name LIKE '%$search_text%' OR username LIKE '%$search_text%' OR email LIKE '%$search_text%') LIMIT 0,30 ");
		$total_results = $db->count();

		if($total_results>0){
			$results = $db->results();
		}

		$str = '';

		for($i=0; $i<$total_results; $i++){

			$result = $results[$i];

			if($i == 0){
				$str .= $result->name;
			}else{
				$str .= ','.$result->name;
			}

		}

		if($str != ''){

			echo $str;

		}

	}

}

?>
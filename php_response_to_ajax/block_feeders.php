<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		$user_data = $user->data();
		$db_uf = DBusers_feeds::getInstance();

		$blocked_feeders = $_POST['blocked_feeder'];
		$tot_bfs = count($blocked_feeders);
		for($i=0; $i<$tot_bfs; $i++){

			$bf = $blocked_feeders[$i];
			$db_uf->get("{$user_data->username}_blocked_feeders", array('userid', '=', $bf));
			if($db_uf->count()==0){
				$db_uf->insert("{$user_data->username}_blocked_feeders", array('userid'=>$bf));
			}

		}

	}

}

?>
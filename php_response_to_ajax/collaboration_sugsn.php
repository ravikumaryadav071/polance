<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){
	if(isset($_GET)){

		$col_name = $_GET['col_name'];
		$db_col = DBcollaborations::getInstance();
		$no_sugsn = 20;
		$db_col->query("SELECT collaboration_name FROM collaborations WHERE collaboration_name LIKE '%{$col_name}%' LIMIT 0,{$no_sugsn}", array(), 'SELECT *');
		$tot_sugsn = $db_col->count();
		if($tot_sugsn>0){

			$results = $db_col->results();
			$show_sugsn = ($tot_sugsn>=$no_sugsn)?$no_sugsn:$tot_sugsn;
			$sugsn = "";
			
			for($i=0; $i<$show_sugsn; $i++){

				if($i==0){
					$sugsn .= "{$results[$i]->collaboration_name}";
				}else{
					$sugsn .= ",{$results[$i]->collaboration_name}";
				}

			}

			echo $sugsn;

		}

	}

}

?>
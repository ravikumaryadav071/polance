<?php

if($user->isLoggedIn()){

	$db_ui->query("SELECT * FROM {$user_data->username}_collaborations", array(), 'SELECT *');
	$tot_col = $db_ui->count();

	if($tot_col>0){

		$cols = $db_ui->results();
		for ($i=0; $i<$tot_col ; $i++) { 
			$col = $cols[$i];
			$db_col->get('collaborations', array('id', '=', $col->col_id));
			if($db_col->count()>0){
				$col_info = $db_col->first();
				?>
				<div>
					<a href="collaboration.php?col=<?php echo $col_info->unique_name; ?>">
					<img src="<?php echo $col_info->profile_pic_dg; ?>" alt="<?php echo $col_info->collaboration_name; ?>">
					<?php echo $col_info->collaboration_name; ?>
					</a>
				</div>
				<?php
			}

		}

	}else{
		echo 'You are not a part of any collaboration.';
	}

}

?>
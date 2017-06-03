<!DOCTYPE HTML> 
<html>
	<head>
		<link href='bootstrap/jquery/smoothness/jquery-ui-1.10.1.custom.css' rel='stylesheet' type='text/css'>
		<link href='css/css_profile.css' rel='stylesheet' type='text/css'>
		<script src="bootstrap/jquery/jquery-1.9.1.js"></script>
		<script src="bootstrap/jquery/jquery-ui-1.10.1.custom.min.js"></script>
		<script src='bootstrap/js/bootstrap.js'></script>	
	</head>
	<body>
		<?php
		// ini_set('display_error', 1);
		// error_reporting(-1);
		require_once 'core/init.php';

		$user = new user();

		if($user->isLoggedIn()){
			
			if(isset($_GET)){
				
				$user_data = $user->data();
				$db = DB::getInstance();
				$db_ui = DBusers_interests::getInstance();
				$db_col = DBcollaborations::getInstance();
				$uc = user_connections::getInstance();
				$all_main_tb = array(
					'1'=>'all_business_interests',
					'2'=>'all_corporate_world_interests',
					'3'=>'all_education_interests',
					'4'=>'all_finance_interests',
					'5'=>'all_philosophy_interests',
					'6'=>'all_politics_interests',
					'7'=>'all_social_interests',
					'8'=>'all_sports_interests'
				);

				$all_int_domains_db = array(
					'1'=>'interests_business', 
					'2'=>'interests_corporate_world', 
					'3'=>'interests_education', 
					'4'=>'interests_finance', 
					'5'=>'interests_philosophy', 
					'6'=>'interests_politics', 
					'7'=>'interests_social', 
					'8'=>'interests_sports'
				);		//all interests domains database

				$all_int_domains = array(
					'1'=>'Business', 
					'2'=> 'Corporate World', 
					'3'=> 'Education', 
					'4'=> 'Finance', 
					'5'=> 'Philosophy', 
					'6'=> 'Politics', 
					'7'=> 'Social', 
					'8'=> 'Sports'
				);

				$db->get('usernames', array('username', '=', $_GET['user']));

				if($db->count()>0){

					$p_user_info = $db->first();
					$db->get('users_about', array('userid', '=', $p_user_info->userid));
					if($db->count()>0){

						$about = $db->first();
						$db_ui->query("SELECT * FROM {$p_user_info->username}_interests ORDER BY id DESC", array(), 'SELECT *');
						if($db_ui->count()>0){
							$tot_ints = $db_ui->count();
							$interests = $db_ui->results();
							$show_ints = array();
							for($i=0; $i<$tot_ints; $i++){
								$interest = $interests[$i];
								$id_in_db = $interest->id_in_db;
								$database = $all_int_domains_db[$interest->db_id];
								$db_temp = new DBtemp($database);
								$db_temp->get("{$all_main_tb[$interest->db_id]}", array('id', '=', $id_in_db));
								$int_info = $db_temp->first();
								$show_ints[$i] = "<strong>{$int_info->name}</strong> in ";
								$parent_id = $int_info->parent_id;

								while ($parent_id != 0) {
									$db_temp->get("{$all_main_tb[$interest->db_id]}", array('id', '=', $parent_id));
									$int_info = $db_temp->first();
									$show_ints[$i] .= "<strong>{$int_info->name}</strong> in ";
									$parent_id = $int_info->parent_id;
								}

								$show_ints[$i] .= "<strong>{$all_int_domains[$interest->db_id]}</strong>";
							}
						}

						$db_ui->query("SELECT * FROM {$p_user_info->username}_collaborations ORDER BY date DESC", array(), 'SELECT *');
						if($db_ui->count()>0){

							$tot_cols = $db_ui->count();
							$cols = $db_ui->results();
							$show_cols = array();

							for($i=0; $i<$tot_cols; $i++){

								$col = $cols[$i];
								$db_col->get('collaborations', array('id', '=', $col->col_id));
								$col_data = $db_col->first();
								$show_cols[$i] = "<a href='collaboration.php?col={$col_data->unique_name}'><img src='{$col_data->profile_pic_dg}'>{$col_data->collaboration_name}</a>";

							}

						}
						?>
						<div>
							<div>About: <pre><?php echo $about->about; ?></pre></div>
							<div>Gender: <?php echo $about->gender; ?></div>
							<div>Country: <?php echo $about->country; ?></div>
							<div>City/state: <?php echo $about->city; ?></div>
							<?php
							if(($about->dob_privacy=='PUBLIC') || ($about->dob_privacy=='FOLLOWERS' && $uc->isFollowing($p_user_info->userid)) || ($about->dob_privacy=='FRIENDS' && $uc->isFriend($p_user_info->userid)) || ($p_user_info->userid==$user_data->id)){
								?>
								<div>Birth Date: <?php echo date('d-M-Y', strtotime($about->dob)); ?></div>								
								<?php
							}
							?>
						</div>

						<?php
						if(isset($show_ints)){
							?>
							<div>
								Interests: 
								<?php
								for($i=0; $i<count($show_ints); $i++){
									?>
									<div><?php echo $show_ints[$i]; ?></div>
									<?php
								}
								?>
							</div>
							<?php
						}
						?>

						<?php
						if(isset($show_cols)){
							?>
							<div>
								Collaborations:
								<?php
								for($i=0; $i<count($show_cols); $i++){
									?>
									<div><?php echo $show_cols[$i]; ?></div>
									<?php
								}
								?>
							</div>
							<?php
						}
						?>
						
						<?php

					}

				}
			
			}

		}
		?>
	</body>
</html>
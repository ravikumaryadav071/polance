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

		require_once 'core/init.php';

		$user = new user();

		if($user->isLoggedIn()){

			$user_data = $user->data();
			$db = DB::getInstance();
			$db_ui = DBusers_interests::getInstance();
			$db_pd = DBpolance_data::getInstance();
			$uc = user_connections::getInstance();
			$sugst_users = array();

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

			$no_interests = 3;		//number of interests ads
			$db_ui->query("SELECT * FROM {$user_data->username}_interests ORDER BY RAND() LIMIT 0,{$no_interests}", array(), 'SELECT *');
			$tot_ints = $db_ui->count();
			if($tot_ints>0){

				$ints = $db_ui->results();
				for($i=0; $i<$tot_ints; $i++){

					$int = $ints[$i];
					$ct = time();
					$cts = date('Y-m-d h:i:s', $ct);
					$search_term = "({$int->id_in_db}->{$int->db_id}),";
					$db_pd->query("SELECT * FROM advertisements WHERE interests LIKE '%{$search_term}%' AND begin_time<'{$cts}' AND end_time>'{$cts}' ORDER BY RAND() LIMIT 0,1", array(), 'SELECT *');
					if($db_pd->count()>0){
						$ad = $db_pd->first();
						?>
						<div>
							<div>
								<?php echo $ad->caption; ?>
							</div>
							<div>
								<img src="<?php echo $ad->image; ?>" width="300px" height="250px">
							</div>
							<a href="javascript: void(0)" id="show_ad">See Details</a>
							<input type="hidden" id="ad_id" value="<?php echo $ad->id; ?>">
						</div>
						<?php
					}

				}

				$no_non_ints = 6-$no_interests;
				$search_term = "";
				$db_pd->query("SELECT * FROM advertisements WHERE interests='{$search_term}' AND begin_time<'{$cts}' AND end_time>'{$cts}' ORDER BY RAND() LIMIT 0,{$no_non_ints}", array(), 'SELECT *');
				if($db_pd->count()>0){
					$ad = $db_pd->first();
					?>
					<div>
						<div>
							<?php echo $ad->caption; ?>
						</div>
						<div>
							<img src="<?php echo $ad->image; ?>" width="300px" height="250px">
						</div>
						<a href="javascript: void(0)" id="show_ad">See Details</a>
						<input type="hidden" id="ad_id" value="<?php echo $ad->id; ?>">
					</div>
					<?php
				}

			}

			$no_ints = 5;		//number of interests ads
			$db_ui->query("SELECT * FROM {$user_data->username}_interests ORDER BY RAND() LIMIT 0,{$no_ints}", array(), 'SELECT *');
			$tot_ints = $db_ui->count();
			$tot_sugsns = 0;
			if($tot_ints>0){

				$ints = $db_ui->results();
				for($i=0; $i<$tot_ints; $i++){

					$int = $ints[$i];
					$db_id = $int->db_id;
					$id_in_db = $int->id_in_db;

					$db_temp = new DBtemp($all_int_domains_db[$db_id]);
					$db_temp->get($all_main_tb[$db_id], array('id', '=', $id_in_db));
					if($db_temp->count()>0){

						$int_info = $db_temp->first();
						$db_temp->query("SELECT * FROM {$int_info->table_name}_subscribers WHERE userid!=$user_data->id ORDER BY RAND() LIMIT 0,5", array(), 'SELECT *');
						$tot_users = $db_temp->count();
						if($tot_users>0 && !$db_temp->error()){

							$f_users = $db_temp->results();
							for($j=0; $j<$tot_users; $j++){
								$f_user = $f_users[$j];
								if(!in_array($f_user->userid, $sugst_users)){
									$sugst_users[] = $f_user->userid;
									if(!$uc->isFollowing($f_user->userid)||!$uc->isFriend($f_user->userid)){

										if(!$uc->isUserBlocked($f_user->userid)){
											$db->get('users', array('id', '=', $f_user->userid));
											$f_user_data = $db->first();
											?>
											<div id="user_info">
												<a href="profile.php?user=<?php echo $f_user_data->username; ?>" target="_blank">
													<img src="<?php echo $f_user_data->profile_pic_dg; ?>" alt="<?php echo $f_user_data->name; ?>">
													<p><?php echo $f_user_data->name; ?></p>
												</a>
												<?php
												include 'include/connecting_to_user.php';
												?>
											</div>
											<?php
											$tot_sugsns++;
											if($tot_ints>2&&$j>1){
												break 2;
											}
										}
									}
								}
								
							}

						}

					}

					if($tot_sugsns>5){
						break;
					}

				}

			}

		}

		?>
		<div id="light" class="white_content">
			<a id="close_popup" href="javascript:void(0)">Close</a>
			<div id="popup_content">
			</div>
		</div>
		<div id="fade" class="black_overlay"></div>
		<div id="message"></div>
		<script type="text/javascript" src="javascripts/pop_up.js"></script>
		<script type="text/javascript" src="javascripts/ad_details.js"></script>
	</body>
</html>
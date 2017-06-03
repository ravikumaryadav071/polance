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

			?>
			<div>
				<a href="all_interest_domains.php?cat=1">Business</a>
				<a href="all_interest_domains.php?cat=2">Corporate World</a>
				<a href="all_interest_domains.php?cat=3">Education</a>
				<a href="all_interest_domains.php?cat=4">Finance</a>
				<a href="all_interest_domains.php?cat=5">Philosophy</a>
				<a href="all_interest_domains.php?cat=6">Politics</a>
				<a href="all_interest_domains.php?cat=7">Social</a>
				<a href="all_interest_domains.php?cat=8">Sports</a>
			</div>
			<?php
			if(isset($_GET)){

				if(!empty($_GET['cat']) && is_numeric($_GET['cat'])){

					$cat_id = $_GET['cat'];		//catagory id
					$user_data = $user->data();
					$db = DB::getInstance();
					$uc = user_connections::getInstance();
					$db_up = DBusers_posts::getInstance();
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

					$db_name = $all_int_domains_db[$cat_id];
					$main_tb = $all_main_tb[$cat_id];
					$db_temp = new DBtemp($db_name);
					$all_int_container = array();
					$cat_container = array();
					$this_table = $all_main_tb[$cat_id];

					$db_temp->query("SELECT * FROM {$this_table} ORDER BY name ASC", array(), 'SELECT *');
					$tot_main_ints = $db_temp->count();

					if($tot_main_ints>0){
							
						$main_ints_info = $db_temp->results();
						for($i=0; $i<$tot_main_ints; $i++){

							$int_info = $main_ints_info[$i];
							?>
							<div>
								<a href="interests.php?cat=<?php echo $cat_id; ?>&int=<?php echo $int_info->id; ?>"><?php echo $int_info->name; ?></a>
							</div>
							<?php

						}

					}else{

						?>
						<div>No interest(s) in this catagory.</div>
						<?php

					}

				}

			}

		}

		?>
	</body>
</html>
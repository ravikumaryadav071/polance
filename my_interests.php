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

			$db = DB::getInstance();
			$db_pd = DBpolance_data::getInstance();
			$db_ui = DBusers_interests::getInstance();
			$db_edu = DBinterests_education::getInstance();
			$db_bus = DBinterests_business::getInstance();
			
			$user_data = $user->data();
			$no_int_pp = 20; //Number of interests per page

			?>
			<div id="add_int_form_container">
				<form id="add_interests_form" action="" method="POST">
					<input type="text" id="interests_input" name="interests_input" value="" placeholder="Add Existing/New Interest(s)">
					<input type="submit" id="add_new_interest" value="Add New">
				</form>
				<div id="suggestions"></div>
			</div>
			<div id="all_interests">
				<?php

				$db_ui->query("SELECT * FROM {$user_data->username}_interests ORDER BY id DESC LIMIT 0,{$no_int_pp}", array(), 'SELECT *');
				$tot_int = $db_ui->count();
				
				if($tot_int>0){

					$interests = $db_ui->results();
					$show_int = ($tot_int>=$no_int_pp)?$no_int_pp:$tot_int;

					for($i=0; $i<$show_int; $i++){
						
						$interest = $interests[$i];
						$int_id = $interest->id_in_st;
						$db_pd->get("main_interests_domain", array('id', '=', $interest->db_id));
						$db_info = $db_pd->first();
						$database = $db_info->db_name;
						$db_temp = new DBtemp($database);
						$db_temp->get($db_info->interests_table, array('id', '=', $interest->id_in_db));
						$int_info = $db_temp->first();
						$int_name = "<strong>{$int_info->name}</strong>";

						if($int_info->parent_id !=0){

							$parent_id = $int_info->parent_id;
							while($parent_id != 0){

								$db_temp->get($db_info->interests_table, array('id', '=', $parent_id));
								$parent_info = $db_temp->first();
								$int_name .= " in <strong>{$parent_info->name}</strong>";
								$parent_id = $parent_info->parent_id;

							}

						}

						$int_name .= " in <strong>{$db_info->name}</strong>";

						?>
						<div>
							<p>
								<?php echo $int_name ?>
							</p>
								<input type="button" id="remove_interest" value="Remove">
								<input type="hidden" id="interest_id" value="<?php echo $interest->id_in_db; ?>">
								<input type="hidden" id="interest_name" value="<?php echo $int_info->name; ?>">
								<input type="hidden" id="search_id" value="<?php echo $interest->id_in_st; ?>">
						</div>
						<?php
					}

				}
				?>
			</div>
			<?php

		}

		?>
		<div id="light" class="white_content">
			<a id="close_popup" href="javascript:void(0)">Close</a>
			<div id="popup_content">
			</div>
		</div>
		<div id="fade" class="black_overlay"></div>
		<div id="message"></div>
		<script src="javascripts/pop_up.js"></script>
		<script src="javascripts/users_interests.js"></script>
	</body>
</html>
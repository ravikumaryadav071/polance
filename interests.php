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
		//ini_set('display_error', 1);
		//error_reporting(-1);
		$user = new user();
		?>
		<div>
			<?php
			if($user->isLoggedIn()){

				if(isset($_GET)&&!empty($_GET)){

					$user_data = $user->data();
					$db = DB::getInstance();
					$uc = user_connections::getInstance();
					$db_up = DBusers_posts::getInstance();
					$db_upr = DBusers_posts_responses::getInstance();
					$db_upc = DBusers_posts_comments::getInstance();
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

					$valid_img_formats = array('jpeg', 'jpg', 'png');
					$valid_ado_formats = array('mp3', 'ogg', 'wav');
					$valid_vdo_formats = array('3gpp', 'avi', 'mp4', '3gp', 'webm', 'ogg');
					$valid_file_formats = array('pdf', 'doc', 'docx', 'ppt', 'pptx', 'pptm', 'xlsx', 'zip', 'rar', 'cab');


					if( isset($_GET['cat']) && !empty($_GET['cat']) && isset($_GET['int']) && !empty($_GET['int'])){

						if(is_numeric($_GET['cat']) && is_numeric($_GET['int'])){

							$cat_id = $_GET['cat'];		//catagory id
							$int_id = $_GET['int'];		//interest id in catagory

							$db_name = $all_int_domains_db[$cat_id];
							$main_tb = $all_main_tb[$cat_id];
							$db_temp = new DBtemp($db_name);

							$db_temp->get($main_tb, array('id', '=', $int_id));
							$int_info = $db_temp->first();

							$parent_id = $int_info->parent_id;
							$child_id = $int_info->child_id;
							$no_posts = 10;		//number of posts per sub inerets
							$posts = array();
							$tables_by_id = array();
							$entry_pointer = array();
							$post_counter = 0;
							$loop_counter = 0;
							$get_out = 0;
							$path = "";

							while($parent_id!=0){

								$db_temp->get($main_tb, array('id', '=', $parent_id));
								$parent_info = $db_temp->first();
								$path .= ">> <strong><a href='interests.php?cat={$cat_id}&int={$parent_info->id}'>{$parent_info->name}</a></strong> ";
								$parent_id = $parent_info->parent_id;

							}

							$path .= ">> <strong><a href='all_interest_domains.php?cat={$cat_id}'>{$all_int_domains[$cat_id]}</a></strong>";

							?>
							<div>
								<h2><?php echo $int_info->name; ?></h2>
								<p>You are here: <?php echo $path; ?></p>
							</div>
							<?php

							$tables = array();
							$tables[] = $int_info->table_name;
							$tables_by_id[$int_info->id] = $int_info->table_name;
							
							if($int_info->child_id != ""){

								$child_ids = $int_info->child_id;
								$all_childs = explode(',', $child_ids);
								for($i=0; $i<count($all_childs); $i++){

									$child = $all_childs[$i];
									$db_temp->get($main_tb, array('id', '=', $child));
									$child_info = $db_temp->first();
									$tables[] = $child_info->table_name;
									$tables_by_id[$child] = $child_info->table_name;

								}

							}

							do{

								$query = "";
								for($i=0; $i<count($tables); $i++){

									$table = $tables[$i];
									$table = strtolower($table);
									if($i==0){
										if(isset($entry_pointer[$table])){
											$query .= "(SELECT * FROM {$table} WHERE id<{$entry_pointer[$table]} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
										}else{	
											$query .= "(SELECT * FROM {$table} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
										}
									}else{
										if(isset($entry_pointer[$table])){
											$query .= "UNION (SELECT * FROM {$table} WHERE id<{$entry_pointer[$table]} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
										}else{	
											$query .= "UNION (SELECT * FROM {$table} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
										}
									}

								}

								$db_temp->query($query.' ORDER BY date DESC ', array(), 'SELECT *');
								$tot_posts = $db_temp->count();

								if($tot_posts>0){

									$all_posts = $db_temp->results();
									$add_posts = ($tot_posts>=20)?20:$tot_posts;
									for($j=0; $j<$tot_posts; $j++){

										$this_post = $all_posts[$j];
										$posts[$post_counter] = $this_post;
										$entry_pointer[$tables_by_id[$this_post->this_int_id]] = $this_post->id;
										$post_counter++;

									}

									if($tot_posts<(count($tables)*$no_posts) ){
										break;
									}

								}

								$get_out = 0;

								if($post_counter==0||$post_counter>20){
									break;
								}
								
							}while($post_counter<20);

							
							if(count($posts)>0){

								for($i=0; $i<count($posts); $i++){

									$post = $posts[$i];
									$db->get('users', array('id', '=', $post->userid));
									$p_user_data = $db->first();
									$db_up->get($p_user_data->username.'_posts', array('id', '=', $post->post_id));
									$post_info = $db_up->first();

									include 'include/all_posts_div.php';

								}

								?>
								<form action="" method="POST" id="post_counter" hidden="hidden">
									<?php
									?>
									<input type="hidden" id="cat_id" name="cat_id" value="<?php echo $cat_id; ?>">
									<input type="hidden" id="main_int_id" name="main_int_id" value="<?php echo $int_id; ?>">
									<input type="hidden" id="interest_id" name="<?php echo $int_id; ?>" value="<?php echo $entry_pointer[$tables[0]]; ?>">
									<?php
									for($i=0; $i<count($all_childs); $i++){
										?>
										<input type="hidden" id="interest_id" name="<?php echo $all_childs[$i]; ?>" value="<?php echo $entry_pointer[$tables[0]]; ?>">
										<?php
									}
									?>
								</div>
								<?php

							}else{

								?>
								<p>No posts related to this interest.</p>
								<?php

							}

						}

					}else if( isset($_GET['user']) && !empty($_GET['user']) && isset($_GET['post']) && !empty($_GET['post']) && isset($_GET['type']) && !empty($_GET['type'])){

						$p_userid = $_GET['user'];
						$post_id = $_GET['post'];
						$post_type = $_GET['type'];
						
						if($post_type == 'USER'){

							$db->get('users', array('id', '=', $p_userid));
							$p_user_data = $db->first();

							$db_up->get("{$p_user_data->username}_posts", array('id', '=', $post_id));
							$post_info = $db_up->first();


							$p_ints = $post_info->interest_tags;
							$all_ints = explode(',', $p_ints);
							$this_int = $all_ints[0];

							$this_int = str_replace('(', '', $this_int);
							$this_int = str_replace(')', '', $this_int);
							$this_int = explode('->', $this_int);
							$cat_id = $this_int[1];
							$int_id = $this_int[0];

							$db_name = $all_int_domains_db[$cat_id];
							$main_tb = $all_main_tb[$cat_id];
							$db_temp = new DBtemp($db_name);
							
							$db_temp->get($main_tb, array('id', '=', $int_id));
							$int_info = $db_temp->first();

							$db_temp->query("SELECT * FROM {$int_info->table_name} WHERE userid={$p_userid} AND post_id={$post_id} AND post_type='{$post_type}'", array(), 'SELECT *');
							$this_post_i_info = $db_temp->first();
							
							$parent_id = $int_info->parent_id;
							$child_id = $int_info->child_id;
							$no_posts = 10;		//number of posts per sub inerets
							$posts = array();
							$tables_by_id = array();
							$entry_pointer = array();
							$post_counter = 0;
							$loop_counter = 0;
							$get_out = 0;
							$path = "";

							while($parent_id!=0){

								$db_temp->get($main_tb, array('id', '=', $parent_id));
								$parent_info = $db_temp->first();
								$path .= ">> <strong><a href='interests.php?cat={$cat_id}&int={$parent_info->id}'>{$parent_info->name}</a></strong> ";
								$parent_id = $parent_info->parent_id;

							}

							$path .= ">> <strong><a href='all_interest_domains.php?cat={$cat_id}'>{$all_int_domains[$cat_id]}</a></strong>";

							?>
							<div>
								<h2><?php echo $int_info->name; ?></h2>
								<p>You are here: <?php echo $path; ?></p>
							</div>
							<?php

							$tables = array();
							$tables[] = $int_info->table_name;
							$tables_by_id[$int_info->id] = $int_info->table_name;
							
							if($int_info->child_id != ""){

								$child_ids = $int_info->child_id;
								$all_childs = explode(',', $child_ids);
								for($i=0; $i<count($all_childs); $i++){

									$child = $all_childs[$i];
									$db_temp->get($main_tb, array('id', '=', $child));
									$child_info = $db_temp->first();
									$tables[] = $child_info->table_name;
									$tables_by_id[$child] = $child_info->table_name;

								}

							}

							do{

								$query = "";
								for($i=0; $i<count($tables); $i++){

									$table = $tables[$i];
									$table = strtolower($table);
									if($i==0){
										if(isset($entry_pointer[$table])){
											$query .= "(SELECT * FROM {$table} WHERE id<{$entry_pointer[$table]} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
										}else{	
											$query .= "(SELECT * FROM {$table} WHERE id<{$this_post_i_info->id} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts}) UNION (SELECT * FROM {$table} WHERE id={$this_post_i_info->id} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts}) UNION (SELECT * FROM {$table} WHERE id>{$this_post_i_info->id} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
										}
									}else{
										if(isset($entry_pointer[$table])){
											$query .= "UNION (SELECT * FROM {$table} WHERE id<{$entry_pointer[$table]} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
										}else{	
											$query .= "UNION (SELECT * FROM {$table} WHERE date<'{$this_post_i_info->date}' ORDER BY date DESC, id DESC LIMIT 0,{$no_posts}) UNION (SELECT * FROM {$table} WHERE date>'{$this_post_i_info->date}' ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
										}
									}

								}

								$db_temp->query($query.' ORDER BY date DESC ', array(), 'SELECT *');
								$tot_posts = $db_temp->count();

								if($tot_posts>0){

									$all_posts = $db_temp->results();
									$add_posts = ($tot_posts>=20)?20:$tot_posts;
									for($j=0; $j<$tot_posts; $j++){

										$this_post = $all_posts[$j];
										$posts[$post_counter] = $this_post;
										$entry_pointer[$tables_by_id[$this_post->this_int_id]] = $this_post->id;
										$post_counter++;

									}

									if($tot_posts<(count($tables)*$no_posts) ){
										break;
									}

								}

								$get_out = 0;

								if($post_counter==0||$post_counter>20){
									break;
								}
								
							}while($post_counter<20);

							
							if(count($posts)>0){

								for($i=0; $i<count($posts); $i++){

									$post = $posts[$i];
									$db->get('users', array('id', '=', $post->userid));
									$p_user_data = $db->first();
									$db_up->get($p_user_data->username.'_posts', array('id', '=', $post->post_id));
									$post_info = $db_up->first();

									if($post->id == $this_post_i_info->id){
										$stv = "scrollHere";		//scroll to view
									}else{
										if(isset($stv)){
											unset($stv);
										}
									}

									include 'include/all_posts_div.php';

								}

								?>
								<form action="" method="POST" id="post_counter" hidden="hidden">
									<?php
									?>
									<input type="hidden" id="cat_id" name="cat_id" value="<?php echo $cat_id; ?>">
									<input type="hidden" id="main_int_id" name="main_int_id" value="<?php echo $int_id; ?>">
									<input type="hidden" id="interest_id" name="<?php echo $int_id; ?>" value="<?php echo $entry_pointer[$tables[0]]; ?>">
									<?php
									for($i=0; $i<count($all_childs); $i++){
										?>
										<input type="hidden" id="interest_id" name="<?php echo $all_childs[$i]; ?>" value="<?php echo $entry_pointer[$tables[0]]; ?>">
										<?php
									}
									?>
								</div>
								<?php

							}else{

								?>
								<p>No posts related to this interest.</p>
								<?php

							}

						}

					}

				}

			}

			?>
			<img src="images/LoaderIcon.gif" id="load_more" alt="Loading...">
		</div>
		<div id="message"></div>
		<script type="text/javascript" src="javascripts/autoload_interests.js"></script>
		<script type="text/javascript" src="javascripts/scroll_to_viewport.js"></script>
	</body>
</html>
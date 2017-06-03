<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		if(is_numeric($_POST['cat_id'])){

			$cat_id = $_POST['cat_id'];		//catagory id
			$int_id = $_POST['main_int_id'];
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
			$int_id_by_tb = array();
			$entry_pointer = array();
			$post_counter = 0;
			$loop_counter = 0;
			$get_out = 0;
			$path = "";

			$tables = array();
			$tables[] = $int_info->table_name;
			$tables_by_id[$int_info->id] = $int_info->table_name;
			$int_id_by_tb[strtolower($int_info->table_name)] = $int_info->id;
			
			if($int_info->child_id != ""){

				$child_ids = $int_info->child_id;
				$all_childs = explode(',', $child_ids);
				for($i=0; $i<count($all_childs); $i++){

					$child = $all_childs[$i];
					$db_temp->get($main_tb, array('id', '=', $child));
					$child_info = $db_temp->first();
					$tables[] = $child_info->table_name;
					$tables_by_id[$child] = $child_info->table_name;
					$int_id_by_tb[strtolower($child_info->table_name)] = $child;

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
							$query .= "(SELECT * FROM {$table} WHERE id<{$_POST[$int_id_by_tb[$table]]} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
						}
					}else{
						if(isset($entry_pointer[$table])){
							$query .= "UNION (SELECT * FROM {$table} WHERE id<{$entry_pointer[$table]} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
						}else{	
							$query .= "UNION (SELECT * FROM {$table} WHERE id<{$_POST[$int_id_by_tb[$table]]} ORDER BY date DESC, id DESC LIMIT 0,{$no_posts})";
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

					include '../include/all_posts_div.php';

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

				echo 'No more posts related to this interest.';

			}

		}

	}

}

?>
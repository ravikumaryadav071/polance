<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){


		$new_interest = trim($_POST['add_to_interests']);
		$main_domains = $_POST['main_domains'];
		$tot_md = count($main_domains);
		$db_pd = DBpolance_data::getInstance();
		if($tot_md>0){

			$all_int_domains = array('1'=>'Business', '2'=> 'Corporate World', '3'=> 'Education', '4'=> 'Finance', '5'=> 'Philosophy', '6'=> 'Politics', '7'=> 'Social', '8'=> 'Sports');

			$passed = array();
			
			for($i=0; $i<$tot_md; $i++){
				if(in_array($main_domains[$i], $all_int_domains)){
					$passed[] = 'Pass';
				}else{
					$passed[] = 'Fail';
				}
			}

			$unique_name = "";
			$un_arr = explode(' ', $new_interest);

			foreach($un_arr as $value){
				$unique_name .= $value;
			}

			$unique_name = strtolower($unique_name);

			$all_int_domains_db = array('Business'=>'interests_business', 'Corporate World'=>'interests_corporate_world', 'Education'=>'interests_education', 'Finance'=>'interests_finance', 'Philosophy'=>'interests_philosophy', 'Politics'=>'interests_politics', 'Social'=>'interests_social', 'Sports'=>'interests_sports');		//all interests domains database
			$all_main_tb = array(
				'Business'=>'all_business_interests',
				'Corporate World'=>'all_corporate_world_interests',
				'Education'=>'all_education_interests',
				'Finance'=>'all_finance_interests',
				'Philosophy'=>'all_philosophy_interests',
				'Politics'=>'all_politics_interests',
				'Social'=>'all_social_interests',
				'Sports'=>'all_sports_interests'
			);		//all main interests domains tables
			$all_int_domains_id = array(
				'Business'=>'1',
				'Corporate World'=>'2',
				'Education'=>'3',
				'Finance'=>'4',
				'Philosophy'=>'5',
				'Politics'=>'6',
				'Social'=>'7',
				'Sports'=>'8'
			);		//all interests domains database ids

			if(ctype_alpha($unique_name) && !in_array('Fail', $passed) && $tot_md<=3){

				$init_char = strtolower(substr($new_interest, 0, 1));
				$s_table_name = "interests_domain_{$init_char}";		//search table name

				//echo $unique_name;
				$condition = "";
				for($i=0; $i<$tot_md; $i++){

					$main_domian = $main_domains[$i];
					$db_id = $all_int_domains_id[$main_domian];

					if($i != $tot_md-1){
						$condition .= " db_id={$db_id} OR ";
					}else{
						$condition .= "db_id={$db_id}";
					}

				}


				if(isset($_POST['sub_interests_db_id']) && !empty($_POST['sub_interests_db_id']) && isset($_POST['sub_interests_st_id']) && !empty($_POST['sub_interests_st_id'])){
					
					$sub_int_ids_in_db = $_POST['sub_interests_db_id'];		//sub interest database id
					$sub_int_ids_in_st = $_POST['sub_interests_st_id'];		//sub interest search table id
					$sub_int_init_chars = $_POST['sub_interests_init'];		//sub interests initials
					$tot_sub_int = count($sub_int_ids_in_st);
					$db_pd->query("SELECT * FROM {$s_table_name} WHERE unique_name='{$unique_name}' AND ($condition)", array(), 'SELECT *');
					$exists_count = $db_pd->count();		//no of trees in which interest already exists
					$s_results = $db_pd->results();		//existsed serach results
					$valid = true;

					// for($i=0; $i<$tot_md; $i++){

					// 	$sub_int_id_in_st = $sub_int_ids_in_st[$i];
					// 	$sub_int_id_in_db = $sub_int_ids_in_db[$i];
					// 	$sub_int_init_char = $sub_int_init_chars[$i];
					// 	$db_pd->get("interests_domain_{$sub_int_init_char}", array('id', '=', $sub_int_id_in_st));
					// 	$sub_int_info = $db_pd->first();
						
					// 	// if($sub_int_info->unique_name == $unique_name){

					// 	// 	$valid = false;
					// 	// 	break 2;			//might get changed

					// 	// }						

					// }

					//if($)

					$insert_in = array();

					for($i=0; $i<$tot_sub_int; $i++){

						$sub_int_id_in_st = $sub_int_ids_in_st[$i];
						$sub_int_id_in_db = $sub_int_ids_in_db[$i];
						$sub_int_init_char = $sub_int_init_chars[$i];
						$db_pd->get("interests_domain_{$sub_int_init_char}", array('id', '=', $sub_int_id_in_st));
						$sub_int_info = $db_pd->first();
						
						if($sub_int_info->unique_name == $unique_name){

							$valid = false;
							continue 2;				//might get changed

						}

						$sub_int_db = $sub_int_info->db_id;
						$db_temp = new DBtemp($all_int_domains_db[$all_int_domains[$sub_int_db]]);
						$db_temp->get($all_main_tb[$all_int_domains[$sub_int_db]], array('id', '=', $sub_int_info->id_in_db));
						$sub_int_data = $db_temp->first();

						$insert_in[$i] = array();
						$insert_in[$i][] = $sub_int_info->id_in_db;

						$parent_id = $sub_int_data->parent_id;
						while(isset($parent_id)&&$parent_id!= 0){
							
							$insert_in[$i][] = $parent_id;
							$db_temp->get($all_main_tb[$all_int_domains[$sub_int_db]], array('id', '=', $parent_id));
							$parent_info = $db_temp->first();
							$parent_id = $parent_info->parent_id;

						}

						$insert_in[$i][] = $sub_int_db;

					}

					if($exists_count>0){

						$existed_in = array();
						
						for($i=0; $i<$exists_count; $i++){

							$s_result = $s_results[$i];
							$int_id_in_db = $s_result->id_in_db;
							$int_db_id = $s_result->db_id;

							$db_temp = new DBtemp($all_int_domains_db[$all_int_domains[$int_db_id]]);
							$db_temp->get($all_main_tb[$all_int_domains[$int_db_id]], array('id', '=', $int_id_in_db));
							$int_info = $db_temp->first();
							$parent_id = $int_info->parent_id;

							$existed_in[$i] = array();
							$existed_in[$i][] = $int_id_in_db;
							
							while(isset($parent_id)&&$parent_id!= 0){
								
								$existed_in[$i][] = $parent_id;
								$db_temp->get($all_main_tb[$all_int_domains[$int_db_id]], array('id', '=', $parent_id));
								$parent_info = $db_temp->first();
								$parent_id = $parent_info->parent_id;

							}

							$existed_in[$i][] = $int_db_id;

						}

						// $insert_in = array();

						// for($i=0; $i<$tot_sub_int; $i++){

						// 	$sub_int_id_in_st = $sub_int_ids_in_st[$i];
						// 	$sub_int_id_in_db = $sub_int_ids_in_db[$i];
						// 	$sub_int_init_char = $sub_int_init_chars[$i];
						// 	$db_pd->get("interests_domain_{$sub_int_init_char}", array('id', '=', $sub_int_id_in_st));
						// 	$sub_int_info = $db_pd->first();
						// 	$sub_int_db = $sub_int_info->db_id;
						// 	$db_temp = new DBtemp($all_int_domains_db[$all_int_domains[$sub_int_db]]);
						// 	$db_temp->get($all_main_tb[$all_int_domains[$sub_int_db]], array('id', '=', $sub_int_info->id_in_db));
						// 	$sub_int_data = $db_temp->first();

						// 	$insert_in[$i] = array();
						// 	$insert_in[$i][] = $sub_int_info->id_in_db;

						// 	$parent_id = $sub_int_data->parent_id;
						// 	while(isset($parent_id)&&$parent_id!= 0){
								
						// 		$insert_in[$i][] = $parent_id;
						// 		$db_temp->get($all_main_tb[$all_int_domains[$sub_int_db]], array('id', '=', $parent_id));
						// 		$parent_info = $db_temp->first();
						// 		$parent_id = $parent_info->parent_id;

						// 	}

						// 	$insert_in[$i][] = $sub_int_db;

						// }

						$add_in = array();
						$passed = false;
						//print_r($insert_in);
						//print_r($existed_in);
						$add_in_count = 0;		//add in position count
						for($i=0; $i<count($insert_in); $i++){

							$parent_id = $insert_in[$i][0];
							unset($existed_in[$i][0]);
							
							for($j=0; $j<count($existed_in); $j++){

								if($insert_in[$i] == $existed_in[$j]){
									$passed = false;
									break 2;			//might get changed
								}else{
									$passed = true;
								}
								

							}

							if($passed){

								$add_in[] = array();
								$add_in[$add_in_count]['db_id'] = end($insert_in[$i]);
								$add_in[$add_in_count]['parent_id'] = $parent_id;
								$add_in_count++;
							}

						}


						for($i=0; $i<count($add_in); $i++){

							$insert_db_id = $add_in[$i]['db_id'];
							$insert_in_domain_name = $all_int_domains[$insert_db_id];
							$insert_db = $all_int_domains_db[$insert_in_domain_name];
							$insert_parent = $add_in[$i]['parent_id'];
							$db_temp = new DBtemp($insert_db);
							$db_temp->insert($all_main_tb[$insert_in_domain_name], array('name'=>$new_interest, 'unique_name'=>$unique_name, 'parent_id'=>$insert_parent));
							$db_temp->query("SELECT * FROM {$all_main_tb[$insert_in_domain_name]} WHERE name='{$new_interest}' AND unique_name='{$unique_name}' AND parent_id={$insert_parent} AND table_name='' ORDER BY id LIMIT 0,1", array(), 'SELECT *');
							//echo "SELECT * FROM {$all_main_tb[$insert_in_domain_name]} WHERE name='{$new_interest}' AND unique_name='{$unique_name}' AND 'parent_id'={$insert_parent} AND table_name='' ORDER BY id LIMIT 0,1";
						//print_r($add_in);
							$last_data = $db_temp->first();
							$last_id = $last_data->id;
							$new_table_name = "{$unique_name}_{$parent_id}_{$last_id}";
							$db_temp->query("CREATE TABLE {$new_table_name} (id int auto_increment primary key not null, this_int_id int not null default '{$last_id}', userid int not null, post_id int not null, post_type varchar(20) not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
							$db_temp->query("CREATE TABLE {$new_table_name}_subscribers (userid int not null primary key)", array(), 'SELECT *');
							$db_temp->update($all_main_tb[$insert_in_domain_name], array('table_name'=>$new_table_name), array('id', '=', $last_id));
							$db_pd->insert("interests_domain_{$init_char}", array('name'=>$new_interest, 'unique_name'=>$unique_name, 'id_in_db'=>$last_id, 'db_id'=>$insert_db_id));
							// $db_temp->get($all_main_tb[$insert_in_domain_name], array('id', '=', $insert_parent));
							// $parent_info = $db_temp->first();
							// if($parent_info->child_id != ""){
							// 	$all_childs = $parent_info->child_id.",{$last_id}";
							// }else{
							// 	$all_childs = "{$last_id}";
							// }
							// $db_temp->update($all_main_tb[$insert_in_domain_name], array('child_id'=>$all_childs), array('id', '=', $parent_info->id));

							///////////here on
							$db_temp->get($all_main_tb[$insert_in_domain_name], array('id', '=', $insert_parent));
							$parent_info = $db_temp->first();
							if($parent_info->child_id != ""){
								$all_childs = $parent_info->child_id.",{$last_id}";
							}else{
								$all_childs = "{$last_id}";
							}
							$db_temp->update($all_main_tb[$insert_in_domain_name], array('child_id'=>$all_childs), array('id', '=', $parent_info->id));
							while($parent_info->parent_id != 0){

								$db_temp->get($all_main_tb[$insert_in_domain_name], array('id', '=', $parent_info->parent_id));
								$parent_info = $db_temp->first();
								if($parent_info->child_id != ""){
									$all_childs = $parent_info->child_id.",{$last_id}";
								}else{
									$all_childs = "{$last_id}";
								}
								$db_temp->update($all_main_tb[$insert_in_domain_name], array('child_id'=>$all_childs), array('id', '=', $parent_info->id));

							}

							/////////////upto here
						
						}

					}else{

						$add_in = $insert_in;
						
						for($i=0; $i<count($add_in); $i++){

							//print_r($add_in);
							$insert_db_id = end($add_in[$i]);
							$insert_in_domain_name = $all_int_domains[$insert_db_id];
							$insert_db = $all_int_domains_db[$insert_in_domain_name];
							$insert_parent = $add_in[$i][0];
							$db_temp = new DBtemp($insert_db);
							$db_temp->insert($all_main_tb[$insert_in_domain_name], array('name'=>$new_interest, 'unique_name'=>$unique_name, 'parent_id'=>$insert_parent));
							$db_temp->query("SELECT * FROM {$all_main_tb[$insert_in_domain_name]} WHERE name='{$new_interest}' AND unique_name='{$unique_name}' AND parent_id={$insert_parent} AND table_name='' ORDER BY id LIMIT 0,1", array(), 'SELECT *');
							//print_r($_POST);
							//echo "SELECT * FROM {$all_main_tb[$insert_in_domain_name]} WHERE name='{$new_interest}' AND unique_name='{$unique_name}' AND 'parent_id'={$insert_parent} AND table_name='' ORDER BY id LIMIT 0,1";
							$last_data = $db_temp->first();
							$last_id = $last_data->id;
							$new_table_name = "{$unique_name}_{$parent_id}_{$last_id}";
							$db_temp->query("CREATE TABLE {$new_table_name} (id int auto_increment primary key not null, this_int_id int not null default '{$last_id}', userid int not null, post_id int not null, post_type varchar(20) not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
							$db_temp->query("CREATE TABLE {$new_table_name}_subscribers (userid int not null primary key)", array(), 'SELECT *');
							$db_temp->update($all_main_tb[$insert_in_domain_name], array('table_name'=>$new_table_name), array('id', '=', $last_id));
							$db_pd->insert("interests_domain_{$init_char}", array('name'=>$new_interest, 'unique_name'=>$unique_name, 'id_in_db'=>$last_id, 'db_id'=>$insert_db_id));
							
							///////////here on
							$db_temp->get($all_main_tb[$insert_in_domain_name], array('id', '=', $insert_parent));
							$parent_info = $db_temp->first();
							if($parent_info->child_id != ""){
								$all_childs = $parent_info->child_id.",{$last_id}";
							}else{
								$all_childs = "{$last_id}";
							}
							$db_temp->update($all_main_tb[$insert_in_domain_name], array('child_id'=>$all_childs), array('id', '=', $parent_info->id));
							while($parent_info->parent_id != 0){

								$db_temp->get($all_main_tb[$insert_in_domain_name], array('id', '=', $parent_info->parent_id));
								$parent_info = $db_temp->first();
								if($parent_info->child_id != ""){
									$all_childs = $parent_info->child_id.",{$last_id}";
								}else{
									$all_childs = "{$last_id}";
								}
								$db_temp->update($all_main_tb[$insert_in_domain_name], array('child_id'=>$all_childs), array('id', '=', $parent_info->id));

							}
							////////////upto here

						}

					}



				}else{

					$db_pd->query("SELECT * FROM {$s_table_name} WHERE unique_name='{$unique_name}' AND ($condition)", array(), 'SELECT *');
					$exists_count = $db_pd->count();		//no of trees in which interest already exists
					if($exists_count!=$tot_md){

						$s_results = $db_pd->results();		//serach results
						$exists_in = array();
						$insert_in = array();

						if($exists_count != 0){
						
							for($i=0; $i<$exists_count; $i++){
								$s_result = $s_results[$i];
								$exists_in[] = $s_result->db_id;
							}


							for($i=0; $i<count($exists_in); $i++){
								if(!in_array($exists_in[$i], $main_domian)){
									$insert_in[] = $exists_in[$i];
								}
							}


						}else{

							$insert_in = array();

							for($i=0; $i<count($main_domains); $i++){
								$insert_in[] = $all_int_domains_id[$main_domains[$i]];
							}

						}
						
						$tot_insert_in = count($insert_in);
						//print_r($insert_in);

						if($tot_insert_in>0){

							for($i=0; $i<$tot_insert_in; $i++){


								$insert_db_id = $insert_in[$i];
								//echo $insert_db_id;
								$insert_in_domain_name = $all_int_domains[$insert_db_id];
								//echo $insert_in_domain_name;
								//print_r($all_int_domains_db['Sports']);
								$insert_db = $all_int_domains_db[$insert_in_domain_name];
								$db_temp = new DBtemp($insert_db);
								$db_temp->insert($all_main_tb[$insert_in_domain_name], array('name'=>$new_interest, 'unique_name'=>$unique_name));
								$db_temp->query("SELECT * FROM {$all_main_tb[$insert_in_domain_name]} WHERE name='{$new_interest}' AND unique_name='{$unique_name}' AND 'parent_id'=0 AND table_name='' ORDER BY id LIMIT 0,1", array(), 'SELECT *');
								$last_data = $db_temp->first();
								// echo "SELECT * FROM {$all_main_tb[$insert_in_domain_name]} WHERE name='{$new_interest}' AND unique_name='{$unique_name}' AND 'parent_id'=0 AND table_name='' ORDER BY id LIMIT 0,1";
								// print_r($last_data);
								$last_id = $last_data->id;
								$new_table_name = "{$unique_name}_0_{$last_id}";
								$db_temp->query("CREATE TABLE {$new_table_name} (id int auto_increment primary key not null, this_int_id int not null default '{$last_id}', userid int not null, post_id int not null, post_type varchar(20) not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
								$db_temp->query("CREATE TABLE {$new_table_name}_subscribers (userid int not null primary key)", array(), 'SELECT *');
								$db_temp->update($all_main_tb[$insert_in_domain_name], array('table_name'=>$new_table_name), array('id', '=', $last_id));
								$db_pd->insert("interests_domain_{$init_char}", array('name'=>$new_interest, 'unique_name'=>$unique_name, 'id_in_db'=>$last_id, 'db_id'=>$insert_db_id));
							}

						}

					}else{

						echo "{$new_interest} already exists.";

					}

				}

			}

		}

	}

}

?>
<?php

require_once 'core/init.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		$db_pd = DBpolance_data::getInstance();
		$user_data = $user->data();
		$caption = trim($_POST['caption']);
		$url = trim($_POST['url']);
		$description = trim($_POST['description']);
		$start = $_POST['start'];
		$end = $_POST['end'];
		$message = "";
		$add_tag_id = "";

		if($caption != ""){

			if(isset($_POST['interest_id'])&&isset($_POST['catagory_id'])&&!empty($_POST['interest_id'])&&!empty($_POST['catagory_id'])){
				
				$catagory_id = $_POST['catagory_id'];
				$interest_id = $_POST['interest_id'];
				$tot_int = count($catagory_id);
				$tot_cat = count($catagory_id);
				$cat_id = array();
				$int_id = array();
				if($tot_cat>0 && $tot_int>0 && $tot_cat==$tot_int){

					$cat_index = array();
					$int_index = array();

					$cat_id = $catagory_id;
					$int_id = $interest_id;

					for($i=0; $i<$tot_cat; $i++){

						$add_tag_id .= "({$int_id[$i]}->{$cat_id[$i]}),";

					}

				}

			}

			if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){

				$db_pd->query("SELECT id FROM advertisements ORDER BY id DESC LIMII 0,1", array(), 'SELECT *');
				if($db_pd->count()>0){
					$last = $db_pd->first();
					$last_id = $last->id+1;
				}else{
					$last_id = 1;
				}

				$profile_pic = $_FILES['file']['name'];
				$type = $_FILES['file']['type'];
				$tmp_name = $_FILES['file']['tmp_name'];
				$size = $_FILES['file']['size'];

				$ext = explode('.', basename($profile_pic));
				$file_ext = strtolower(end($ext));

				$name = '';
				$strs = explode(' ', $profile_pic);
				if(count($strs)>1){
					foreach ($strs as $key => $value) {
						if(is_numeric($value) || ctype_alpha($value) || ctype_alnum($value) || !in_array($value, array('/', ':', '|', '<', '>', '*', '?', ';')) || !strstr($value, '\ ')){
							$name .= $value;
						}
					}

					$name .= hash::unique();

				}else{

					$name = $strs[0];
					
					if(!strstr('/', $name) || !strstr('\ ', $name) || !strstr(':', $name) || !strstr('|', $name) || !strstr('<', $name) || !strstr('>', $name) || !strstr('*', $name) || !strstr('?', $name) || !strstr(';', $name)){

						$name = hash::unique();

					}

				}

				$profile_pic = $name;

				$valid_format = array("image/jpeg", "image/jpg", "image/png");
				$valid_ext = array("jpg", "jpeg", "png");

				$target = 'images/advertisements/';
				$path = $target.$profile_pic.'_'.$user_data->username.'.'.$file_ext;

				if(in_array($file_ext, $valid_ext) && in_array($type, $valid_format)){

					if(move_uploaded_file($tmp_name, $path)){

						$db_pd->insert('advertisements', array('userid'=>$user_data->id, 'caption'=>$caption, 'url'=>$url, 'description'=>$description, 'image'=>$path, 'interests'=>$add_tag_id, 'begin_time'=>$start, 'end_time'=>$end));

						if(!$db_pd->error()){

							session::flash('ads', 'Your advertisement uploaded successfully.');
							redirect::to('post_advertisement.php');

						}else{
							$message = "Your ad cannot be uploaded right now. Please try again.";								
						}

					}else{
						$message = "Your ad cannot be uploaded right now. Please try again.";
					}

				}else{
					$message = "Your image do not have valid file format.";
				}

			}

		}

		session::flash('ads', $message);
		redirect::to('post_advertisement.php');

	}

}

?>
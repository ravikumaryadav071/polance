<html>
    <head>
		<link href='bootstrap/jquery/smoothness/jquery-ui-1.10.1.custom.css' rel='stylesheet' type='text/css'>
        <script src="bootstrap/jquery/jquery-1.9.1.js"></script>
    </head>
    <body> 
		<?php
			
			require_once 'core/init.php';

			$user = new user();

			if($user->isLoggedIn()){

				$userid = $_SESSION['user'];
				$db = DB::getInstance();
				$user_data = $user->data();
				if(isset($_POST['submit']) && !empty($_POST['submit'])){

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

					$target = 'images/profile_pic/';
					$path = $target.$profile_pic.'_'.$user_data->username.'.'.$file_ext;

					$target_dg = 'images/profile_pic_dg/';
					$path_dg = $target_dg.$profile_pic.'_'.$user_data->username.'.'.$file_ext;

					if(in_array($file_ext, $valid_ext) && in_array($type, $valid_format)){

						if(move_uploaded_file($tmp_name, $path)){

							$old_size = getimagesize($path);
							$old_width = $old_size[0];
							$old_height = $old_size[1];
							
							if($size > 102400){

								if(($size >102400) && ($size <204800)){

									$down_p = 0.60; //downgrade percentage	

								}else{

									if(($size>=204800) && ($size <307200)){

										$down_p = 0.50; //

									}else{

										if(($size>=307200) && ($size <409600)){

											$down_p = 0.40;

										}else{

											if(($size>=409600) && ($size <512000)){

												$down_p = 0.30;

											}else{

												if(($size>=512000) && ($size <1024000)){

													$down_p = 0.20;

												}else{

													if($size >= 1024000){

														$down_p = 0.15;

													}

												}

											}

										}

									}

								}	

							}else{

								$down_p = 0.80;

							}

							$new_width = $down_p*$old_width;
							$new_height = $down_p*$old_height;
							$new_image = imagecreatetruecolor($new_width, $new_height);

							if($type == 'image/png'){

								$old_image = imagecreatefrompng($path);

							}else{

								$old_image = imagecreatefromjpeg($path);

							}

							imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);

							if($type == 'image/png'){

								imagepng($new_image, $path_dg);

							}else{

								imagejpeg($new_image, $path_dg);

							}

							$db->update('users', $userid,array('profile_pic'=>$path, 'profile_pic_dg'=>$path_dg));

							if(!$db->error()){

								session::flash('profile', 'Your profile picture uploaded successfully.');
								redirect::to('profile.php?user='.$user_data->username);

							}else{

								echo "<div id='message'>Your image cannot be uploaded right now. Please try again.</div>";								

							}


						}else{

							echo "<div id='message'>Your image cannot be uploaded right now. Please try again.</div>";

						}


					}else{

						echo "<div id='error'>Your file do not have valid file format.</div>";

					}



				}

				?>
				<div id="form_container">
					<form action="" method="POST" enctype="multipart/form-data">
						<div id="preview_container">
							<img id="pic_preview" src="" alt="Profile Pic">
						</div>
						<div>
							<label for="profile_pic">Choose your profile picture.(Image format must be jpeg, jpg or png.)</label>
							<br/>
							<input type="file" name="file" id="profile_pic">
						</div>
						<span id="error"></span>
						<span id="message"></span>
						<input type="submit" id="submit" name="submit" value="Upload profile pic">
					</form>
				</div>

				<?php

			}

		?>
		<script type="text/javascript" src="javascripts/upload_profilepic.js"></script>
	
	</body>
</html>
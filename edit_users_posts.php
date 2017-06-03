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

			if(isset($_GET) && !empty($_GET)){

				$post_id = $_GET['post'];
				$p_userid = $_GET['user'];

				if(is_numeric($post_id) && is_numeric($p_userid)){

					$user_data = $user->data();
					$db = DB::getInstance();
					$db_up = DBusers_posts::getInstance();

					$db->get('users', array('id', '=', $p_userid));
					$p_user_data = $db->first();

					$db_up->get($p_user_data->username.'_posts', array('id', '=', $post_id));
					$post = $db_up->first();
					$passed = false;

					if($p_userid != $user_data->id){
						$contris = $post->contributors;
						if(strstr($contris, " {$user_data->id},")){
							$passed = true;
						}
					}else{
						$passed = true;
					}


					if($passed){
						
						$files = $post->files;
						$text = $post->text_content;
						$files = explode(',', $files);
						$show_files = array();

						$show_text = explode('<file>', $text);

						for($i=0; $i<count($files); $i++){
							$file = $files[$i];
							$file = explode('/', $file);
							$show_files[$i] = end($file);
						}

						for($i=0; $i<count($show_text); $i++){
							$show_text[$i] = str_replace('</file/>', '<file>', $show_text[$i]);
						}

						?>
						<div>
							<form method="POST" action="submit_edited_post.php" enctype="multipart/form-data">
								<?php
								for($i=0; $i<count($show_text); $i++){
									?>
									<textarea name="read_text[]"><?php echo $show_text[$i]; ?></textarea>
									<?php
									if(isset($show_files[$i]) && !empty($show_files[$i])){
										?>
										<div>
											<label><?php echo $show_files[$i]; ?></label>
											<input type="checkbox" id="remove_file" name="remove_file[]" value="<?php echo ($i+1); ?>">Remove
											<input type="checkbox" id="replace_file" name="replace_file[]" value="<?php echo ($i+1); ?>">Replace
										</div>
										<?php
									}
								}
								?>
								<input type="button" id="add_files" value="Add Files">
								<input type="hidden" name="user" value="<?php echo $p_userid; ?>">
								<input type="hidden" name="post" value="<?php echo $post_id; ?>">
								<input type="submit" value="Submit">
							</form>
						</div>
						<?php

					}else{
						echo 'You cannot edit this post.';
					}

				}

			}

		}

		?>
		<script type="text/javascript" src="javascripts/edit_post.js"></script>
	</body>
</html>
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
		if (session::exists('ads')) {
			echo '<p>' . session::flash('ads') . '</p>';	
		}

		$user = new user();

		if($user->isLoggedIn()){

			$user_data = $user->data();
			$db_pd = DBpolance_data::getInstance();

			?>
			<div>
				<form id="ad_post_form" action="submit_ads.php" method="POST" enctype="multipart/form-data">
					<div>
						<label for="caption">Caption: </label>
						<input type="text" id="caption" name="caption" value="">
					</div>
					<div>
						<label for="url">URL: </label>
						<input type="text" id="url" name="url" value="">
					</div>
					<div>
						<label for="description">Description: </label>
						<textarea id="description" name="description"></textarea>
					</div>
					<div>
						<label for="add_tags">Tags: </label>
						<input type="text" id="add_tags">
						<input type="button" id="add_tags_to_list" value="ADD">
						<div id="suggested_tags"></div>
						<div id="added_tags">
						</div>
					</div>
					<div id="preview_container">
						<img id="pic_preview" src="" alt="Profile Pic">
					</div>
					<div>
						<label for="profile_pic">Choose your profile picture.(Image format must be jpeg, jpg or png.)</label>
						<br/>
						<input type="file" name="file" id="profile_pic">
					</div>
					<div>
						<label for="start">Starts At: </label>
						<input type="date" id="start" name="start" value="">
					</div>
					<div>
						<label for="end">Ends At: </label>
						<input type="date" id="end" name="end" value="">
					</div>
					<input type="submit" value="POST">
				</form>
			</div>
			<?php

		}
		?>
		<div id="message"></div>
		<script type="text/javascript" src="javascripts/ads_int_suggestions.js"></script>
		<script type="text/javascript" src="javascripts/upload_profilepic.js"></script>
	</body>
</html>
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
		// ini_set('display_error', 1);
		// error_reporting(-1);
		require_once 'core/init.php';

		$user = new user();

		if($user->isLoggedIn()){
			
			$user_data = $user->data();
			$db = DB::getInstance();

			$db->get('users_about', array('userid', '=', $user_data->id));
			if($db->count()>0){
				$about = $db->first();
			}
			if(isset($_POST) && !empty($_POST)){
				$p_about = trim($_POST['about']);
				$p_country = trim($_POST['country']);
				$p_city = trim($_POST['city']);

				if(isset($_POST['dob']) && !empty($_POST['dob']) && $_POST['dob']!=""){
					$p_dob = $_POST['dob'];
				}else if(isset($about)){
					$p_dob = date('Y-m-d', strtotime($about->dob));
				}else{
					$p_dob = "";
				}
				if(isset($_POST['dob_p']) && !empty($_POST['dob_p'])){
					$p_dob_p = strtoupper($_POST['dob_p']);
				}else{
					$p_dob_p = "";
				}
				if(isset($_POST['gender'])  && !empty($_POST['gender'])){
					$p_gen = strtoupper($_POST['gender']);
				}else{
					$p_gen = "";
				}

				if(isset($about)){
					$db->myUpdate('users_about', array('about'=>$p_about, 'country'=>$p_country, 'city'=>$p_city, 'dob'=>$p_dob, 'dob_privacy'=>$p_dob_p, 'gender'=>$p_gen), array('userid', '=', $user_data->id));
				}else{
					$db->insert('users_about', array('userid'=>$user_data->id, 'about'=>$p_about, 'country'=>$p_country, 'city'=>$p_city, 'dob'=>$p_dob, 'dob_privacy'=>$p_dob_p, 'gender'=>$p_gen));
				}

				redirect::to("about.php?user={$user_data->username}");

			}
			

			?>
			<div>
				<form method="POST" action="">
					<textarea name="about" placeholder="Write about yourself."><?php if(isset($about)){ echo $about->about; } ?></textarea>
					<div>
						<label for="country">Country: </label>
						<input type="text" id="country" name="country" value="<?php if(isset($about)){ echo $about->country; } ?>">
					</div>
					<div>
						<label for="city">City/State: </label>
						<input type="text" id="city" name="city" value="<?php if(isset($about)){ echo $about->city; } ?>">
					</div>
					<div>
						<label for="dob">Birth Date: </label><?php if(isset($about) && $about->dob != "0000-00-00"){ echo date('d-M-Y', strtotime($about->dob)).' <a href="javascript:void(0)" id="change_dob">Change</a>'; } ?>
						<input type="date" id="dob" name="dob" value="" <?php if(isset($about) && $about->dob != "0000-00-00"){ ?> hidden="hidden" <?php } ?> >
					</div>
					<div>
						<label for="dob_p">Birth Date privacy: </label>
						<select name="dob_p" id="dob_p"> 
							<option name="PRIVATE" <?php if(isset($about)){ if($about->dob_privacy == "PRIVATE"){ echo 'SELECTED'; } } ?> >Private</option>
							<option name="FERIENDS" <?php if(isset($about)){ if($about->dob_privacy == "FERIENDS"){ echo 'SELECTED'; } } ?> >Friends</option>
							<option name="FOLLOWERS" <?php if(isset($about)){ if($about->dob_privacy == "FOLLOWERS"){ echo 'SELECTED'; } } ?> >Followers</option>
							<option name="PUBLIC" <?php if(isset($about)){ if($about->dob_privacy == "PUBLIC"){ echo 'SELECTED'; } } ?> >Public</option>
						</select>
					</div>
					<div>
						<label for="gender">Gender: </label>
						<select name="gender" id="gender">
							<option name="MALE" <?php if(isset($about)){ if($about->gender == "MALE"){ echo 'SELECTED'; } } ?> >Male</option>
							<option name="FEMALE" <?php if(isset($about)){ if($about->gender == "FEMALE"){ echo 'SELECTED'; } } ?> >Female</option>
							<option name="OTHER" <?php if(isset($about)){ if($about->gender == "OTHER"){ echo 'SELECTED'; } } ?> >Other</option>
						</select>
					</div>
					<input type="submit" value="SAVE">
				</form>
			</div>
			<?php

		}
		?>
		<script type="text/javascript" src="javascripts/update_about.js"></script>
	</body>
</html>
<?php

require_once 'core/init.php';

$db = DB::getInstance();
$db_pd = DBpolance_data::getInstance();

if(isset($_GET)){

	if(!empty($_GET['id'])){
		$otp_id = $_GET['id'];
	}

	if(!empty($_GET['username'])){
		$db_pd->get('otp_table', array('username', '=', $_GET['username']));
		$where = array('username', '=', $_GET['username']);
	}else if(!empty($_GET['email'])){
		$db_pd->get('otp_table', array('email', '=', $_GET['email']));
		$where = array('email', '=', $_GET['email']);
	}

	$count = $db_pd->count();

	if($count>0){

		$otp_info = $db_pd->first();
		$passed = $otp_info->passed;

	}else{

		echo '__|__Fuck you!<br>@@@@@';

	}

	if($passed == 'YES' && $otp_id == $otp_info->id){

		if(isset($_POST)){

			if(!empty($_POST['reset'])){

				$password = $_POST['password'];
				$password_a = $_POST['password_again'];
				if($password == $password_a){

					$salt = hash::salt(32);
					$n_password = hash::make($password, $salt);
					$db->get('users', $where);
					if($db->count() > 0){
						$user_info = $db->first();
						$db->update('users', $user_info->id, array('password'=>$n_password, 'salt'=>$salt));
						if(!$db->error()){

							$_SESSION['users'] = $user_info->id;
							session::flash('home', 'Your password has been reset.');
							$db_pd->delete('otp_table', $where);
							redirect::to('index.php');

						}
					}

				}else{

					echo 'Your passwords are not matching.';

				}

			}else{

				echo 'You have not resseted your password.';

			}

		}
		?>
		<form action="" method="POST">
			<label for="password">Enter your password.</label>
			<input type="password" name="password" id="password" value="">
			<label for="password_again">Enter your password again.</label>
			<input type="password" name="password_again" id="password_again" value="">
			<input type="submit" name="reset" value="Reset Password">
		</form>
		<?php
	}else{

		echo 'You fucking idiot. Keep your ass ready to get banged.';

	}

}

?>
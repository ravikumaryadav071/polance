<?php

require_once 'core/init.php';

if(isset($_SESSION['user'])){
	unset($_SESSION['user']);
}

if(isset($_POST)){

	$db = DB::getInstance();
	$db_pd = DBpolance_data::getInstance();

	if(isset($_POST['username'])){

		if(!empty($_POST['username'])){

			$username = $_POST['username'];
			$db->get('users', array('username', '=', $username));
			$user_info = $db->first();
			$u_email = $user_info->email;
			$otp = mt_rand(124578, 94562239);
			$otp_pf = hash::salt(32);		//one time password postfix
			$otp_db = hash::make($otp, $otp_pf);
			$db_pd->get('otp_table', array('username', '=', $username));
			$count = $db_pd->count();

			if($count == 0){

				$db_pd->insert('otp_table', array('otp'=>$otp_db, 'otp_pf'=>$otp_pf, 'username'=>$username, 'email'=>$u_email));

			}else{

				$db_pd->delete('otp_table', array('username', '=', $username));
				$db_pd->insert('otp_table', array('otp'=>$otp_db, 'otp_pf'=>$otp_pf, 'username'=>$username, 'email'=>$u_email));

			}

			//*************** this comment has to be toggled from here after uploading the site *********

			// $to = "$u_email";
			// $subject = "One Time passord.";
			// $message = "Your one time polance password is : {$otp}";
			// $headers = "From: Polance<sender@polance.com>\r\n".
			// 			"Reply-To: feedback@polance.com\r\n".
			// 			"Content-type: text/html; charset=UTF-8 \r\n";

			// mail($to, $subject, $message, $headers);

			if(!$db_pd->error()){

				redirect::to('verify_otp.php?user='.$username.'&otp='.$otp.'&otp_pf='.$otp_pf);

			}

		}

	}else if(isset($_POST['email'])){

		if(!empty($_POST['email'])){

			$email = $_POST['email'];
			$db->get('users', array('email', '=', $email));
			$user_info = $db->first();
			$username = $user_info->username;
			$u_email = $user_info->email;
			$otp = mt_rand(124578, 94562239);
			$otp_pf = hash::salt(32);		//one time password postfix
			$otp_db = hash::make($otp, $otp_pf);
			$db_pd->get('otp_table', array('username', '=', $username));
			$count = $db_pd->count();

			if($count == 0){

				$db_pd->insert('otp_table', array('otp'=>$otp_db, 'otp_pf'=>$otp_pf, 'username'=>$username, 'email'=>$u_email));

			}else{

				$db_pd->delete('otp_table', array('username', '=', $username));
				$db_pd->insert('otp_table', array('otp'=>$otp_db, 'otp_pf'=>$otp_pf, 'username'=>$username, 'email'=>$u_email));

			}

			//*************** this comment has to be toggled from here after uploading the site *********

			// $to = "$u_email";
			// $subject = "One Time passord.";
			// $message = "Your one time polance password is : {$otp}";
			// $headers = "From: Polance<sender@polance.com>\r\n".
			// 			"Reply-To: feedback@polance.com\r\n".
			// 			"Content-type: text/html; charset=UTF-8 \r\n";

			// mail($to, $subject, $message, $headers);

			if(!$db_pd->error()){

				redirect::to('verify_otp.php?email='.$u_email.'&otp='.$otp);

			}
			
		}

	}

}

?>

<form action="" method="POST">
	<label for="username">Enter your username.</label>
	<input type="text" name="username" id="username" value="" placeholder="Username">
	<p>Or</p>
	<label for="email">Enter your Email Id.</label>
	<input type="text" name="email" id="email" value="" placeholder="Email">
	<input type="submit" name="get_otp" value="Get one time password">
</form>
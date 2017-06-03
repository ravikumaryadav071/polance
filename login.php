<?php 
require_once 'core/init.php';

$user = new user();

if($user->isLoggedIn()){
	redirect::to('index.php');
}


if (input::exists()) {
	//echo input::get('token');
	//echo session::get(config::get('session/token_name'));
	if (token::check(input::get('token'))) {

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
				'username' => array('required' => true),
				'password' => array('required' => true)
			));

		if ($validation->passed()) {
			//Log user in
			$remember = (input::get('remember') === 'on') ? true : false;
			$login = $user->login(input::get('username'), input::get('password'), $remember);
			
			if ($login) {
				//echo "Success";
				if(isset($_SERVER['HTTP_CLIENT_IP'])){
					$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
				}else{
					$http_client_ip = null;
				}
				if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
					$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
				}else{
					$http_x_forwarded_for = null;
				}
				if(isset($_SERVER['HTTP_CLIENT_IP'])){
					$remote_addr = $_SERVER['REMOTE_ADDR'];
				}else{
					$remote_addr = null;
				}
				
				$db_pd = DBpolance_data::getInstance();

				if(!empty($http_client_ip)){
					$ip_addr = $http_client_ip;
				}else if(!empty($http_x_forwarded_for)){
					$ip_addr = $http_x_forwarded_for;
				}else{
					$ip_addr = $remote_addr;
				}

				$db_pd->insert('users_ip', array('userid'=>$_SESSION['user'], 'ip_address'=>$ip_addr));
				redirect::to('index.php');
			
			} else {
				echo "Sorry, Logging in failed.";
			}

		} else {
			foreach ($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}

?>


<form action="" method="post">
	<div class="field">
		<lable for="username">Username</lable>
		<input type="text" name="username" id="username" autocomplete="on">
	</div>

	<div class="field">
		<lable for="password">Password</lable>
		<input type="password" name="password" id="password" autocomplete="off">
	</div>

	<div class="field">
		<label for="remember">
			<input type="checkbox" name="remember" id="remember"> Remember me </input>
		</label>
	</div>

	<input type="hidden" name="token" value="<?php echo token::generate(); ?>">
	<input type="submit" value="Log in">
</form>

<a href="send_otp.php">Forget Password</a>
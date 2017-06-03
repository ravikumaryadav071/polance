<?php

require_once 'core/init.php';

if(isset($_GET)){

	if(isset($_GET['user'])){

		if(!empty($_GET['user'])){

			$username = $_GET['user'];

			?>
			<form action="checking_otp.php" method="POST">
				<label for="otp">Your one time password</label>
				<input type="text" name="otp" value="">
				<input type="hidden" name="username" value="<?php echo $username; ?>">
				<input type="submit" name="submit" value="submit">
			</form>
			<?php

		}

	}else if(isset($_GET['email'])){

		if(!empty($_GET['email'])){

			$email = $_GET['email'];
			?>
			<form action="checking_otp.php" method="POST">
				<label for="otp">Your one time password</label>
				<input type="text" name="otp" value="">
				<input type="hidden" name="email" value="<?php echo $email; ?>">
				<input type="submit" name="submit" value="submit">
			</form>
			<?php
			
		}

	}

}

?>
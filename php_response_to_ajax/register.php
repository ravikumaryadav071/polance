<?php

require_once '../core/initi.php';

if(isset($_GET)){

	$db = DB::getInstance();

	if(isset($_GET['username'])){

		$username = $_GET['username'];
		if(!strstr($username, ' ')){

			if(ctype_alpha(substr($username, 0, 1))){
				$db->get('users', array('username', '=', $username));
				if($db->count() > 0){

					echo 'This username already exists.';

				}else{

					echo 'This username is available.';

				}
			}else{
				echo 'First character of username must be an alphabet.';
			}
		}else{
			echo 'Username must not contain space.';
		}

	}else if(isset($_GET['email'])){

		$email = $_GET['email'];
		$db->get('users', array('email', '=', $email));
		if($db->count() > 0){

			echo 'This Email Id already registered.';

		}else{

			echo 'You can register through this Email Id.';

		}

	}elseif (isset($_GET['contact_no'])) {

		$contact_no = $_GET['contact_no'];
		$db->get('users', array('contact_no', '=', $contact_no));
		if($db->count() > 0){

			echo 'This Contact number already registered.';

		}else{

			echo 'You can register through this Conatct number.';

		}		

	}

}

?>
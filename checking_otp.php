<?php

require_once 'core/init.php';

if(isset($_POST)){

	$db = DB::getInstance();
	$db_pd = DBpolance_data::getInstance();

	if(isset($_POST['username'])){

		if(!empty($_POST['username'])){

			$username = $_POST['username'];
			$where = array('username', '=', $username);
			$db_pd->get('otp_table', array('username', '=', $username));
			$count = $db_pd->count();
			if($count > 0){
				$user_otp = $db_pd->first();
			}

		}

	}else if(isset($_POST['email'])){

		if(!empty($_POST['email'])){

			$email = $_POST['email'];
			$where = array('email', '=', $email);
			$db_pd->get('otp_table', array('email', '=', $email));
			$count = $db_pd->count();
			if($count > 0){
				$user_otp = $db_pd->first();
			}		
			
		}

	}
	
	$otp = hash::make($_POST['otp'], $user_otp->otp_pf);
	if($otp == $user_otp->otp){
		$db_pd->query("UPDATE otp_table SET passed = 'YES' WHERE {$where[0]} {$where[1]} '{$where[2]}'", array(), 'UPDATE');
		if(!$db_pd->error()){
			$db_pd->get('otp_table', $where);
			$otp_info = $db_pd->first();
			$otp_id = $otp_info->id;
			redirect::to('new_password.php?id='.$otp_id.'&'.$where[0].$where[1].$where[2]);
		}else{
			redirect::to('send_otp.php');
		}

	}else{

		//redirect::to('verify_otp.php');

	}

}

?>
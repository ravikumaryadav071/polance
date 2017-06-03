<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	$user_data = $user->data();
	$db = DB::getInstance();
	$db_uc = DBusers_connection::getInstance();
	
	$db_uc->query("SELECT * FROM {$user_data->username}_requests ORDER BY date DESC, id DESC", array(), 'SELECT *');
	$tot_requests = $db_uc->count();

	if($tot_requests > 0){
		$requests = $db_uc->results();
	}else{
		echo 'Request Box is empty.';
	}

	for($i=0; $i<$tot_requests; $i++){

		$request = $requests[$i];
		$r_userid = $request->userid;
		$db->get('users', array('id', '=', $r_userid));
		$r_user_info = $db->first();
		?>
		<div id="request_container_<?php echo $r_userid; ?>">
			<a href="profile.php?user=<?php echo $r_user_info->username; ?>">
				<img src="<?php echo $r_user_info->profile_pic_dg; ?>" alt="<?php echo $r_user_info->name; ?>" width="25px" height="30px">
				<?php echo $r_user_info->name; ?>
			</a>
			<input type="button" id="request_<?php echo $r_userid; ?>"onClick="grant_request(<?php echo $r_userid; ?>)" value="Accept Request">
			<input type="button" id="delete_request_<?php echo $r_userid; ?>" onClick="delete_request(<?php echo $r_userid; ?>)" value="Delete request">
		</div>
		<?php

	}

}

?>
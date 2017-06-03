<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){
		
		$ad_id = $_GET['ad'];
		$db_ui = DBusers_interests::getInstance();
		$db_pd = DBpolance_data::getInstance();
		$ct = time();
		$cts = date('Y-m-d h:i:s', $ct);
		$db_pd->query("SELECT * FROM advertisements WHERE id={$ad_id} AND begin_time<'{$cts}' AND end_time>'{$cts}' ORDER BY RAND() LIMIT 0,1", array(), 'SELECT *');
		if($db_pd->count()>0){
			$ad = $db_pd->first();
			?>
			<div>
				<div>
					<?php echo $ad->caption; ?>
				</div>
				<div>
					<img src="<?php echo $ad->image; ?>" width="300px" height="250px">
				</div>
				<a href="<?php echo $ad->url; ?>">Follow link</a>
				<div>
					<?php echo $ad->description; ?>
				</div>
			</div>
			<?php
		}
	
	}

}

?>
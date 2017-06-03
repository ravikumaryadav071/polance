<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		$user_data = $user->data();
		$db_ucl = DBusers_collections::getInstance();
		$clc_name = trim($_POST['clc_name']);

		$db_ucl->get($user_data->username.'_collections_lists', array('collection_name', '=', $clc_name));
		if($db_ucl->count()==0){

			$db_ucl->insert($user_data->username.'_collections_lists', array('collection_name'=>$clc_name));
			$db_ucl->query("SELECT * FROM {$user_data->username}_collections_lists WHERE collection_name='{$clc_name}' ORDER BY id DESC", array(), 'SELECT *');
			$last_res = $db_ucl->first();
			?>
			<div id="collection">
				<br><a href="collection.php?clc=<?php echo $last_res->id; ?>"><?php echo $last_res->collection_name; ?></a><br>
				<span id="clc_counter"><?php echo $last_res->tot_posts; ?></span>
				<input type="hidden" id="collection_id" value="<?php echo $last_res->id; ?>">
			</div>
			<?php

		}else{
			echo 'Collection of this name already created.';
		}

	}

}

?>
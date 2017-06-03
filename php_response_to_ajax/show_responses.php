<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$p_user = $_GET['user'];
		$post_id = $_GET['post_id'];
		$post_type = $_GET['post_type'];
		$list = $_GET['list'];
		$user_data = $user->data();
		$db = DB::getInstance();
		
		if($post_type == 'USER'){

			$db_upr = DBusers_posts_responses::getInstance();
			$db->get('users', array('id', '=', $p_user));
			$p_user_data = $db->first();

			if($list=='UPVOTE'){

				$db_upr->query("SELECT userid FROM {$p_user_data->username}_{$post_id}_upvotes", array(), 'SELECT *');
				$tot_users = $db_upr->count();
				if($tot_users>0){
					$show_users = $db_upr->results();
				}

			}else if($list=='SHARE'){

				$db_upr->query("SELECT userid FROM {$p_user_data->username}_{$post_id}_shares", array(), 'SELECT *');
				$tot_users = $db_upr->count();
				if($tot_users>0){
					$show_users = $db_upr->results();
				}

			}else if($list=='VARIFY'){

				$db_upr->query("SELECT userid FROM {$p_user_data->username}_{$post_id}_varify", array(), 'SELECT *');
				$tot_users = $db_upr->count();
				if($tot_users>0){
					$show_users = $db_upr->results();
				}

			}else if($list=='COLLECT'){

				$db_upr->query("SELECT userid FROM {$p_user_data->username}_{$post_id}_collects", array(), 'SELECT *');
				$tot_users = $db_upr->count();
				if($tot_users>0){
					$show_users = $db_upr->results();
				}

			}

		}else if($post_type == 'COLLABORATION'){

			$db_col = DBcollaborations::getInstance();
			$db_cpr = DBcollaborations_posts_responses::getInstance();
			$uniquer_name = strtolower($p_user);

			if($list=='UPVOTE'){

				$db_cpr->query("SELECT userid FROM {$uniquer_name}_{$post_id}_upvotes", array(), 'SELECT *');
				$tot_users = $db_cpr->count();
				if($tot_users>0){
					$show_users = $db_cpr->results();
				}

			}else if($list=='SHARE'){

				$db_cpr->query("SELECT userid FROM {$uniquer_name}_{$post_id}_shares", array(), 'SELECT *');
				$tot_users = $db_cpr->count();
				if($tot_users>0){
					$show_users = $db_cpr->results();
				}

			}else if($list=='VARIFY'){

				$db_cpr->query("SELECT userid FROM {$uniquer_name}_{$post_id}_varify", array(), 'SELECT *');
				$tot_users = $db_cpr->count();
				if($tot_users>0){
					$show_users = $db_cpr->results();
				}

			}else if($list=='COLLECT'){

				$db_cpr->query("SELECT userid FROM {$uniquer_name}_{$post_id}_collects", array(), 'SELECT *');
				$tot_users = $db_cpr->count();
				if($tot_users>0){
					$show_users = $db_cpr->results();
				}

			}

		}

		if($tot_users>0){

			for($i=0; $i<$tot_users; $i++){

				$l_user = $show_users[$i];
				$db->get('users', array('id', '=', $l_user->userid));
				$l_user_data = $db->first();
				?>
				<div>
					<a href="profile.php?user=<?php echo $l_user_data->username; ?>" target="_blank">
						<img src="<?php echo $l_user_data->profile_pic_dg; ?>" alt="<?php echo $l_user_data->name; ?>" width="40px" height="35px">
						<?php echo $l_user_data->name; ?>
					</a>
				</div>
				<?php

			}

		}

	}

}

?>
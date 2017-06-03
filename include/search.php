<?php
if(!$db->error()){

	$tot_users = $db->count();

	if($tot_users>0){
		$s_users = $db->results();		//searched users
		$show_users = ($tot_users>=$users_pp)?$users_pp:$tot_users;
		?>
		<div id="search_results">
			<?php
			for($i=0; $i<$show_users; $i++){

				$f_user_data = $s_users[$i];

				if(!$uc->isUserBlocked($f_user_data->id)){
					?>
					<div id="user_info">
						<a href="profile.php?user=<?php echo $f_user_data->username; ?>" target="_blank">
							<img src="<?php echo $f_user_data->profile_pic_dg; ?>" alt="<?php echo $f_user_data->name; ?>">
							<p><?php echo $f_user_data->name; ?></p>
						</a>
						<?php
						include 'connecting_to_user.php';
						?>
					</div>
					<?php
				}

			}
			if($tot_users>=$users_pp){
				?>
				<input type="button" id="load_more_search_results" value="Load More" onClick="load_more_search_results(<?php $results[($show_users-1)]->id; ?>)">
				<?php
			}
			?>
		</div>
		<?php

	}

}
?>
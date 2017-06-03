<?php
for($i=0; $i<$show_followers; $i++){

	$follower = $followers[$i];

	if(!$uc->isUserBlocked($follower->userid)){

		$db->get('users', array('id', '=', $follower->userid));
		$f_user_data = $db->first();

		?>
		<div id="user_info">
			<a href="profile.php?user=<?php echo $f_user_data->username; ?>">
				<img src="<?php echo $f_user_data->profile_pic_dg;?>" alt="<?php echo $f_user_data->name;?>">
				<p><?php echo $f_user_data->name;?></p>
			</a>
			<?php
			include '../include/connecting_to_user.php';
			?>
		</div>
		<?php

	}

}
if($tot_followers>=$no_followers_pp){
	?>
	<input type="button" id="load_more_followers" value="Load More" onClick="load_more_followers('<?php echo $p_username; ?>', <?php echo $followers[($show_followers-1)]->id; ?>)">
	<?php
}
?>
<?php
for($i=0; $i<$show_friends; $i++){

	$friend = $friends[$i];

	if(!$uc->isUserBlocked($friend->userid)){

		$db->get('users', array('id', '=', $friend->userid));
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
if($tot_friends>=$no_friends_pp){
	?>
	<input type="button" id="load_more_friends" value="Load More" onClick="load_more_friends('<?php echo $p_username; ?>', <?php echo $friends[($show_friends-1)]->id; ?>)">
	<?php
}
?>
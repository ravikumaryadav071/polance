<?php
for($i=0; $i<$show_followings; $i++){

	$following = $followings[$i];

	if(!$uc->isUserBlocked($following->userid)){

		$db->get('users', array('id', '=', $following->userid));
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
if($tot_followings>=$no_followings_pp){
	?>
	<input type="button" id="load_more_followings" value="Load More" onClick="load_more_followings('<?php echo $p_username; ?>', <?php echo $followings[($show_followings-1)]->id; ?>)">
	<?php
}
?>
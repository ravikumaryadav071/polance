<?php

for($i=0; $i<$show_groups; $i++){
	
	$group = $groups[$i];
	$db_gm->query("SELECT * FROM {$group->chat_table} WHERE id>{$group->last_seen}", array(), 'SELECT *');
	$unread_msgs = $db_gm->count();
	$db_gm->query("SELECT * FROM {$group->chat_table} ORDER BY date DESC, id DESC LIMIT 0,1", array(), 'SELECT *');
	$chat = $db_gm->first();
	$date = strtotime($chat->date);
	$ext = $chat->extention;

	?>
	<div>
		<a href="group_chat.php?group=<?php echo $group->chat_table; ?>" target="_blank"><?php if($group->name != ''){ echo $group->name;}else{ echo 'Group '.($i+1); } ?></a>
		<?php
		if($chat->sent_by==$user_data->id){

			?>
			<div id="sent_msg_container" style="background-color: #CCCCFF">
				<a>Me: on <?php echo date('d/m/Y h:i:s A', $date); ?></a>
				<p><pre><?php echo $chat->message; ?></pre></p>
				<?php
				if($ext != 'TEXT'){
					?>
					<a href="<?php echo $path; ?>" download>Download File</a>
					<?php
				}
				?>
			</div>
			<?php

		}else{

			$db->get('users', array('id', '=', $chat->sent_by));
			$c_user_data = $db->first();

			?>
			<div id="received_msg_container" style="background-color: #99FFFF">
				<a><?php echo $c_user_data->name; ?>: on <?php echo date('d/m/Y h:i:s A', $date); ?></a>
				<p><pre><?php echo $chat->message; ?></pre></p>
				<?php
				if($ext != 'TEXT'){
					?>
					<a href="<?php echo $path; ?>" download>Download File</a>
					<?php
				}
				?>
			</div>
			<?php

		}
		if($unread_msgs>0){
			?>
			<strong><?php echo $unread_msgs; ?> unread message(s).</strong>
			<?php
		}
		?>
	</div>
	<?php
}
if($tot_groups>=$no_cg_pp){

	?>
	<input type="hidden" id="last_id" value="<?php $groups[($show_groups-1)]->id; ?>">
	<?php

}

?>
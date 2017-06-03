<?php
for($i=$show_msgs-1; $i>=0; $i--){

	$chat = $messages[$i];
	$date = strtotime($chat->date);
	$ext = $chat->extention;
	$path = $chat->path;

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

}

if($tot_msgs>=$no_messages_pp){
	?>
	<input type="hidden" id="last_seen" value="<?php echo $messages[0]->id; ?>">
	<?php
}else if($tot_msgs>0){
	?>
	<input type="hidden" id="last_seen" value="<?php echo $messages[0]->id; ?>">
	<?php
}else{
	?>
	<input type="hidden" id="last_seen" value="0">
	<?php
}
?>
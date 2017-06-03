<?php
if($tot_sug>0){

	$sugsns = $db_pd->results();

	for($i=0; $i<$tot_sug; $i++){

		$sugsn = $sugsns[$i];
		$suggested_text = "";
		$db_id = $sugsn->db_id;
		$db_pd->get("main_interests_domain", array('id', '=', $db_id));
		$info_db = $db_pd->first();		//database information
		//echo "SELECT * FROM main_interests_domian WHERE id={$db_id}";
		//print_r($info_db);
		$database = $info_db->db_name;
		$table_name = $info_db->interests_table;
		$id_in_db = $sugsn->id_in_db;
		$db_temp = new DBtemp($database);
		
		$db_temp->get($table_name, array('id', '=', $id_in_db));
		$post_info = $db_temp->first();
		$md_id = $post_info->parent_id;
		
		$db_temp->get($table_name, array('id', '=', $id_in_db));
		$info_int = $db_temp->first();		//interest information

		$suggested_text = "<strong>{$sugsn->name}</strong> in ";

		while (isset($md_id) && $md_id != 0) {
			
			$db_temp->get($table_name, array('id', '=', $md_id));
			$info_md = $db_temp->first();		//main domain information
			$suggested_text .= "<strong>{$info_md->name}</strong> in ";
			//print_r($info_md);
			$md_id = $info_md->parent_id;

		}
		
		$suggested_text .= "<strong>{$info_db->name}</strong>";

		?>
		<div>
			<p><?php echo $suggested_text; ?></p>
			<input type="button" id="add_interest" value="Add">
			<input type="hidden" id="interest_id" value="<?php echo $id_in_db; ?>">
			<input type="hidden" id="interest_name" value="<?php echo $sugsn->name; ?>">
			<input type="hidden" id="search_id" value="<?php echo $sugsn->id; ?>">
		</div>
		<?php

	}
}
?>
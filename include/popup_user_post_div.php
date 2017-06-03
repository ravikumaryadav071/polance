<?php

// if($post_info->edit_id != 0){

// 	$db_up->get($p_user_data->username.'_edited_posts', array('id', '=', $post_info->edit_id));
// 	$post_info = $db_up->first();

// }

if($post_info->edit_id != 0){

	$db->get('users', array('id', '=', $post_info->edited_by));
	$s_user_data = $db->first();

}


if($post_info->delete_id != 0){

	unset($post_info);

}

if(isset($post_info)){

	$post_text = $post_info->text_content;
	$files = $post_info->files;
	$exts = $post_info->extention;
	$up_count = $post_info->tot_upvotes;
	$down_count = $post_info->tot_downvotes;
	$share_count = $post_info->tot_shares;
	$comment_count = $post_info->tot_comments;
	$varify_count = $post_info->tot_varify;
	$collect_count = $post_info->tot_collects;
	$contris = $post_info->contributors;
	$refs = $post_info->refs;
	$tags = $post_info->interest_tags;
	$tag_links = array();
	$show_refs = array();
	$show_contris = array();
	$show_files_exts = array();
	$can_edit = false;

	$find_text = $post_text.' ';
	$regx = '|(http://)?[a-z]+\.[a-z0-9@_-]+\.[a-z0-9@\/_-]+[\s]|i';
	preg_match_all($regx, $find_text, $matches);
	
	if( isset($matches[0][0]) && !empty($matches[0][0])){

		if($matches[0][0]!=""){

			$f_content = file_get_contents($matches[0][0]);
			if($f_content!=''){

				preg_match('|<title>(?P<title>.+)</title>|i', $f_content, $title);
				preg_match('|<img.+src=(?P<src>.+\s).+>|i', $f_content, $l_img);
				preg_match('|<p(.+)?>.+</p>|i', $f_content, $l_para);

				$title = $title['title'];	//page_title;
				if(isset($l_img['src'])){
					$l_img = $l_img['src'];			//link image
					if(strstr($matches[0][0], 'http://')){
						$root = str_replace('http://', '', $matches[0][0]);
					}else{
						$root = $matches[0][0];
					}
					$root = str_replace(' ', '', $root);
					$l_img = explode('"', $l_img);
					$l_img = $l_img[1];
					$all_paths = explode('/', $root);
					$root_path = $all_paths[0];
					$l_img_src = 'http://'.$root_path.'/'.$l_img;
				}else{
					$l_img = 'images/noimage.png';		//link image source
				}
				if(isset($l_para[0])){
					$l_para = $l_para[0];		//link para
				}else{
					$l_para = "<p></p>";
				}

			}

		}

	}

	$db_upr->get("{$p_user_data->username}_{$post_id}_upvotes", array('userid', '=', $user_data->id));
	$upvoted = $db_upr->count();

	$db_upr->get("{$p_user_data->username}_{$post_id}_downvotes", array('userid', '=', $user_data->id));
	$downvoted = $db_upr->count();

	$db_upr->get("{$p_user_data->username}_{$post_id}_shares", array('userid', '=', $user_data->id));
	$shared = $db_upr->count();

	$db_upr->get("{$p_user_data->username}_{$post_id}_reports", array('userid', '=', $user_data->id));
	$reported = $db_upr->count();

	$db_upr->get("{$p_user_data->username}_{$post_id}_varify", array('userid', '=', $user_data->id));
	$varified = $db_upr->count();
	
	$show_files_exts = explode(",", $exts);

	$show_texts = explode('<file>', $post_text);
	for($j=0; $j<count($show_texts); $j++){
		$show_texts[$j] = str_replace('</file/>', '<file>', $show_texts[$j]);
	}

	$file_paths = explode(',', $files);
	
	if($tags != ""){

		$tags_ids = explode(',', $tags);

		for($j=0; $j<count($tags_ids); $j++){
			if($tags_ids[$j] !=""){
				$temp_tag = str_replace('(', '', $tags_ids[$j]);
				$temp_tag = str_replace(')', '', $temp_tag);
				$int_cat = explode('->', $temp_tag);		//interest->catagory
				$tag_links[$j] = array('int_id'=>$int_cat[0], 'db_id'=>$int_cat[1]);
			}
		}

	}


	if($refs != ""){
		$show_refs = explode(",", $refs);
	}

	if($contris != ""){
		$temp_contris = str_replace(" ", "", $contris);
		$show_contris = explode(",", $temp_contris);
	}

	?>
	<div class="checkborder">
		<?php
		if(isset($show_sec_feeder)){
			if($show_sec_feeder != ""){
				?>
				<div>
					<?php echo $show_sec_feeder; ?>
				</div>
				<?php
			}
		}
		if(isset($s_user_data)){
			if($s_user_data != ""){
				?>
				<div>
					<a href="profile.php?user=<?php echo $s_user_data->username; ?>" alt="<?php $s_user_data->name; ?>">
						<?php echo $s_user_data->name; ?>
					</a> has edited this post.
				</div>
				<?php
			}
		}
		if(isset($collection_info)){
			if($collection_info != ""){
				?>
				<div>
					<a href="collection.php?collection=<?php echo $collection_info->collection_name; ?>" alt="<?php $collection_info->name; ?>">
						<?php echo $collection_info->name; ?>
					</a>
				</div>
				<?php
			}
		}

		if($p_user_data->id == $user_data->id){
			$can_edit = true;
		}else{
			for($j=0; $j<count($show_contris); $j++){
				if($show_contris[$j] != ""){
					if($show_contris[$j] == $user_data->id){
						$can_edit = true;
					}
				}
			}
		}
		?>
		<div id="user_info">
			<a href="profile.php?user=<?php echo $p_user_data->username; ?>" alt="<?php $p_user_data->name; ?>">
				<img height='20px' width='24px' src="<?php echo $p_user_data->profile_pic_dg; ?>" alt="<?php echo $p_user_data->name; ?>">
				<?php echo $p_user_data->name; ?>
			</a>
		</div>
		<div id="post">
			<?php
			for($j=0; $j<count($show_texts); $j++){

				?>
				<pre><?php echo $show_texts[$j]; ?></pre>
				<?php

				if(isset($show_files_exts[$j])){

					if(in_array($show_files_exts[$j], $valid_img_formats)){
						?>
						<img src="<?php echo $file_paths[$j]; ?>" alt="Image">
						<?php
					}else if(in_array($show_files_exts[$j], $valid_vdo_formats)){
						?>
						<video src="<?php echo $file_paths[$j]; ?>" controls></video>
						<?php
					}else if(in_array($show_files_exts[$j], $valid_ado_formats)){
						?>
						<audio src="<?php echo $file_paths[$j]; ?>" controls></audio>
						<?php
					}else if(in_array($show_files_exts[$j], $valid_file_formats)){
						?>
						<a href="<?php echo $file_paths[$j]; ?>" download><?php echo $show_files_exts[$j].' File'; ?></a>
						<?php
					}

				}

			}
			?>
		</div>
		<?php
		if($tags!=""){
			?>
			<div id="tags">
				Tags:
				<?php
				for($j=0; $j<count($tag_links); $j++){

					if(isset($tag_links[$j])){

						$show_tag = "";
						$db_id = $tag_links[$j]['db_id'];
						$db_temp = new DBtemp($all_int_domains_db[$db_id]);
						$cat_tb = $all_main_tb[$db_id];		//catagory table
						$int_id = $tag_links[$j]['int_id'];
						$db_temp->get($cat_tb, array('id', '=', $int_id));
						$int_info = $db_temp->first();
						$int_name = $int_info->name;
						$show_tag .= "<strong>{$int_name}</strong> in ";
						$parent_id =  $int_info->parent_id;
						while($parent_id!=0){
							$db_temp->get($cat_tb, array('id', '=', $parent_id));
							$p_info = $db_temp->first();	//parent_info
							$show_tag .= "<strong>{$p_info->name}</strong> in";
							$parent_id = $p_info->parent_id;
						}

						$show_tag .= " <strong>{$all_int_domains[$db_id]}</strong>";

						?>
						<a href="interests.php?cat=<?php echo $db_id; ?>&int=<?php echo $int_id; ?>"><?php echo $show_tag; ?></a>
						<?php

					}

				}
				?>
			</div>
			<?php
		}
		if(count($show_contris)){
			?>
			<div id="contris">
				Contributors:
				<?php
				for($j=0; $j<count($show_contris); $j++){
					if($show_contris[$j] != ""){
						$db->get('users', array('id', '=', $show_contris[$j]));
						$c_user_data = $db->first();		//contri user data
						?>
						<a href="profile.php?user=<?php echo $c_user_data->username; ?>"><?php echo $c_user_data->name; ?></a>
						<?php
					}
				}
				?>
			</div>
			<?php
		}
		if(count($show_refs)){
			?>
			<div id="references">
				References:
				<?php
				for($j=0; $j<count($show_refs); $j++){
					?>
					<a href="<?php echo $show_refs[$j]; ?>"><?php echo $show_refs[$j]; ?></a>
					<?php
				}
				?>
			</div>
			<?php
		}
		?>
		<div id="counts">Upvotes: <span id="up_count"><?php echo $up_count; ?></span> | Downvotes: <span id="down_count"><?php echo $down_count; ?></span> | Shares: <span id="share_count"><?php echo $share_count; ?></span> | Varifications: <span id="varify_count"><?php echo $varify_count; ?></span> | Collects: <span id="collect_count"><?php echo $collect_count; ?> | Comments: <span id="comment_count"><?php echo $comment_count; ?></span></div>
		<div id="user_response">
			<?php
			if($upvoted>0){
				?>
				<input type="button" id="upvote" value="Upvote" hidden="hidden" <?php if($downvoted>0){ ?>disabled="disabled"<?php } ?>>
				<input type="button" id="upvoted" value="Upvoted" <?php if($downvoted>0){ ?>disabled="disabled"<?php } ?>>
				<?php
			}else{
				?>
				<input type="button" id="upvote" value="Upvote" <?php if($downvoted>0){ ?>disabled="disabled"<?php } ?>>
				<input type="button" id="upvoted" value="Upvoted" hidden="hidden" <?php if($downvoted>0){ ?>disabled="disabled"<?php } ?>>
				<?php
			}
			if($downvoted>0){
				?>
				<input type="button" id="downvote" value="Downvote" hidden="hidden" <?php if($upvoted>0){ ?>disabled="disabled"<?php } ?>>
				<input type="button" id="downvoted" value="Downvoted" <?php if($upvoted>0){ ?>disabled="disabled"<?php } ?>>
				<?php
			}else{
				?>
				<input type="button" id="downvote" value="Downvote" <?php if($upvoted>0){ ?>disabled="disabled"<?php } ?>>
				<input type="button" id="downvoted" value="Downvoted" hidden="hidden" <?php if($upvoted>0){ ?>disabled="disabled"<?php } ?>>
				<?php
			}
			if($shared>0){
				?>
				<input type="button" id="share" value="share" hidden="hidden">
				<input type="button" id="shared" value="shared">
				<?php
			}else{
				?>
				<input type="button" id="share" value="share">
				<input type="button" id="shared" value="shared" hidden="hidden">
				<?php
			}
			if($varified>0){
				?>
				<input type="button" id="varify" value="Verify" hidden="hidden">
				<input type="button" id="varified" value="Verifed">
				<?php
			}else{
				?>
				<input type="button" id="varify" value="Verify">
				<input type="button" id="varified" value="Verifed" hidden="hidden">
				<?php
			}
			if($reported>0){
				?>
				<input type="button" id="report" value="Report" hidden="hidden">
				<input type="button" id="reported" value="Reported">
				<?php
			}else{
				?>
				<input type="button" id="report" value="Report">
				<input type="button" id="reported" value="Reported" hidden="hidden">
				<?php
			}
			?>
			<input type="button" id="comment" value="Comment">
			<?php
			if($can_edit){
				?>
				<a href="edit_users_posts.php?user=<?php echo $p_user_data->id; ?>&post=<?php echo $post_id; ?>">Edit</a>
				<?php
			}
			?>
			<input type="hidden" id="post_id" value="<?php echo $post_id; ?>">
			<input type="hidden" id="user" value="<?php echo $p_user_data->id; ?>">
			<input type="hidden" id="post_type" value="<?php echo 'USER'; ?>">
			<input type="button" id="collect" value="Collect">
			<input type="checkbox" id="collect_cb" hidden="hidden">
			<div id="comment_here" hidden="hidden">
				<div id="show_comment_area">
					<a href="javascript: void(0)" id="show_comments">Show Comments</a>
				</div>
				<form id="comment_form" method="post" action="">
					<textarea name="comment_text" id="comment_text" value=""></textarea>
					<input type="hidden" name="post_id" name="c_post_id" value="<?php echo $post_id; ?>">
					<input type="hidden" name="user" name="c_user" value="<?php echo $p_user_data->id; ?>">
					<input type="hidden" name="post_type" name="c_post_type" value="<?php echo 'USER'; ?>">
					<input type="submit" id="submit_comment" value="Submit">
				</form>
			</div>
		</div>
	</div>
	<?php

}
?>
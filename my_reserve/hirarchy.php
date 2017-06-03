<!-- <div>
								<a href="interests.php?cat=<?php // echo $cat_id; ?>&int=<?php // echo $int_info->id; ?>"><?php // echo $int_info->name; ?></a>
								<?php
								// if(isset($main_int_info->child_id)){
								
								// 	if($main_int_info->child_id != ""){

								// 		$parent_id = $int_info->id;
								// 		$all_childs = findChildren($parent_id);
								// 		function findChildren($parent_id){
											
								// 			$db_temp->query("SELECT * FROM {$this_table} WHERE parent_id={$parent_id} ORDER BY name ASC");
								// 			$tot_childs = $db_temp->count();
								// 			$show_this = "";
								// 			if($tot_childs>0){
								// 				$show_this .= "<div>+<div hidden='hidden'>";
								// 				$this_childs = $db_temp->results();
								// 				for($j=0; $j<$tot_childs; $j++){

								// 					$this_child = $this_childs[$j];
								// 					$show_this .= "<a href='interests.php?cat={$cat_id}&int={$this_child->id}'>{$this_child->name}</a>";

								// 					findChildren($this_child->id);

								// 				}
								// 				$show_this .= "</div></div>";
								// 			}

								// 			return $show_this;
										
								// 		}

								// 		echo $all_childs;
								// 		// here:
								// 		// $child_ids = explode(',', $int_info->child_id);
								// 		// for($j=0; $j<count($child_ids); $j++){

								// 		// 	$child_id = $child_ids[$j];
								// 		// 	if(isset($child_id)){

								// 		// 		$db_temp->query("SELECT * FROM {$all_main_tb[$cat_id]} WHERE id={$child} AND parent_id={} ORDER BY name ASC", array(), 'SELECT');
								// 		// 		$child_info = $db_temp->first();
								// 		// 		if($child_info->child_id != ""){

								// 		// 			$parent_id = $child_info->id;
								// 		// 			goto here;

								// 		// 		}

								// 		// 	}

								// 		// }

								// 	}
								
								// }
								?>
							</div> -->
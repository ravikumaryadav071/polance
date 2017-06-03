<?php
ob_start();
include('includecss.php');
require_once 'core/init.php';

$user = new user();

if($user->isLoggedIn()){

	$userid = $_SESSION['user'];
	$db = DB::getInstance();
	$uc = user_connections::getInstance();
	$db->query('SELECT * FROM users');
	$users = $db->results();
	$count = $db->count();
	$user_data = $user->data();
	include('navbarud.php');
	for($i=0; $i<$count; $i++){
		$s_user = $users[$i];
		if(!$uc->isUserBlocked($s_user->id)){
					?>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
						<div id="user_info">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 userstmepfilediv">
								<a href="profile.php?user=<?php echo $s_user->username; ?>" target="_blank">
									<img class="userstmepfileimg" src="<?php echo $s_user->profile_pic_dg; ?>" alt="<?php echo $s_user->name; ?>">
									<span><?php echo ucwords($s_user->name); ?></span>
								</a>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 userstmepfilediv1">
							<?php
								if($uc->isFollowing($s_user->id)){
									?>
									<a href="javascript: void(0)" id="follow_<?php echo $s_user->id; ?>" onclick="follow(<?php echo $s_user->id; ?>)" hidden="hidden" class="btn btn-primary">Follow</a>
									<a href="javascript: void(0)" id="unfollow_<?php echo $s_user->id; ?>" onclick="unfollow(<?php echo $s_user->id; ?>)" class="btn btn-primary">Unfollow</a>
									<?php
									if($uc->isFriend($s_user->id)){
										?>
										<a href="javascript: void(0)" id="friend_<?php echo $s_user->id; ?>" onclick="friend(<?php echo $s_user->id; ?>)" hidden="hidden" class="btn btn-primary">Friend</a>
										<a href="javascript: void(0)" id="unfriend_<?php echo $s_user->id; ?>" onclick="unfriend(<?php echo $s_user->id; ?>)" class="btn btn-primary">Unfriend</a>
										<a href="javascript: void(0)" id="delete_friend_req_<?php echo $s_user->id; ?>" onclick="delete_friend_req(<?php echo $s_user->id; ?>)" hidden="hidden">Delete Friend Request</a>
										<?php
									}else{
										if($uc->hasUserRequest($s_user->id)){
											?>
											<a href="javascript: void(0)" id="friend_<?php echo $s_user->id; ?>" onclick="friend(<?php echo $s_user->id; ?>)" hidden="hidden" class="btn btn-primary">Friend</a>
											<a href="javascript: void(0)" id="delete_friend_req_<?php echo $s_user->id; ?>" onclick="delete_friend_req(<?php echo $s_user->id; ?>)" class="btn btn-primary">Delete Friend Request</a>
											<?php
										}else{
											?>
											<a href="javascript: void(0)" id="friend_<?php echo $s_user->id; ?>" onclick="friend(<?php echo $s_user->id; ?>)" class="btn btn-primary">Friend</a>
											<a href="javascript: void(0)" id="delete_friend_req_<?php echo $s_user->id; ?>" onclick="delete_friend_req(<?php echo $s_user->id; ?>)" hidden="hidden" class="btn btn-primary">Delete Friend Request</a>
											<?php
										}
									}
								}else{
									?>
									<a href="javascript: void(0)" id="follow_<?php echo $s_user->id; ?>" onclick="follow(<?php echo $s_user->id; ?>)" class="btn btn-primary">Follow</a>
									<a href="javascript: void(0)" id="unfollow_<?php echo $s_user->id; ?>" onclick="unfollow(<?php echo $s_user->id; ?>)" hidden="hidden" class="btn btn-primary">Unfollow</a>
									<a href="javascript: void(0)" id="friend_<?php echo $s_user->id; ?>" onclick="friend(<?php echo $s_user->id; ?>)" hidden="hidden" class="btn btn-primary">Friend</a>
									<a href="javascript: void(0)" id="delete_friend_req_<?php echo $s_user->id; ?>" onclick="delete_friend_req(<?php echo $s_user->id; ?>)" hidden="hidden" class="btn btn-primary">Delete Friend Request</a>
									<?php
								}
								if($uc->isBlocked($s_user->id)){
									?>
									<a href="javascript: void(0)" id="block_<?php echo $s_user->id; ?>" onclick="block(<?php echo $s_user->id; ?>)" hidden="hidden" class="btn btn-primary">Block</a>
									<a href="javascript: void(0)" id="unblock_<?php echo $s_user->id; ?>" onclick="unblock(<?php echo $s_user->id; ?>)" class="btn btn-primary">Unblock</a>
									<?php
								}else{
									?>
									<a href="javascript: void(0)" id="block_<?php echo $s_user->id; ?>" onclick="block(<?php echo $s_user->id; ?>)" class="btn btn-primary">Block</a>
									<a href="javascript: void(0)" id="unblock_<?php echo $s_user->id; ?>" onclick="unblock(<?php echo $s_user->id; ?>)" hidden="hidden" class="btn btn-primary">Unblock</a>
									<?php
								}
								?>
							</div>
						</div>
					</div>
					<?php
				}
	}
}
?>

<script type="text/javascript" src="javascripts/user_connections.js"></script>
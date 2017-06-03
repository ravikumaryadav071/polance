<?php
class user_connections{

	private $_follower=false,
			$_following=false,
			$_friend=false,
			$_blocked=false,
			$_request=false,
			$_userFollower=false,
			$_userFollowing=false,
			$_userFriend=false,
			$_userBlocked=false,
			$_userRequest=false;
	
	private static $_instance=null;
	private $_user=null;
	private $_db=null;
	private $_db_uc=null;
	private function __construct(){
		$user = new user();
		if($user->isLoggedIn()){
			$this->_user = $user->data();
			$this->_db = DB::getInstance();
			$this->_db_uc = DBusers_connection::getInstance();
		}
	}

	public static function getInstance(){
		if(!isset(self::$_instance)){
			self::$_instance = new user_connections();
		}
		return self::$_instance;
	}

	public function isFollower($id){

		$this->_db_uc->get($this->_user->username.'_followers', array('userid', '=', $id));
		if(!$this->_db_uc->error()){
			if($this->_db_uc->count()>0){
				$this->_follower = true;
			}else{
				$this->_follower = false;
			}
		}else{
			$this->_follower = false;
		}

		return $this->_follower;

	}

	public function isUserFollower($id){

		$this->_db->get('users', array('id', '=', $id));
		if(!$this->_db->error()){
			$user_info = $this->_db->first();
			$this->_db_uc->get($user_info->username.'_followers', array('userid', '=', $this->_user->id));
			if(!$this->_db_uc->error()){
				if($this->_db_uc->count()>0){
					$this->_userFollower = true;
				}else{
					$this->_userFollower = false;
				}
			}else{
				$this->_userFollower = false;
			}
		}

		return $this->_userFollower;

	}

	public function isFollowing($id){

		$this->_db_uc->get($this->_user->username.'_following', array('userid', '=', $id));
		if(!$this->_db_uc->error()){
			if($this->_db_uc->count()>0){
				$this->_following = true;
			}else{
				$this->_following = false;
			}
		}else{
			$this->_following = false;
		}

		return $this->_following;

	}

	public function isUserFollowing($id){

		$this->_db->get('users', array('id', '=', $id));
		if(!$this->_db->error()){
			$user_info = $this->_db->first();
			$this->_db_uc->get($user_info->username.'_following', array('userid', '=', $this->_user->id));
			if(!$this->_db_uc->error()){
				if($this->_db_uc->count()>0){
					$this->_userFollowing = true;
				}else{
					$this->_userFollowing = false;
				}
			}else{
				$this->_userFollowing = false;
			}
		}

		return $this->_userFollowing;

	}

	public function isFriend($id){

		$this->_db_uc->get($this->_user->username.'_friends', array('userid', '=', $id));
		if(!$this->_db_uc->error()){
			if($this->_db_uc->count()>0){
				$this->_friend = true;
			}else{
				$this->_friend = false;
			}
		}else{
			$this->_friend = false;
		}

		return $this->_friend;

	}

	public function isUserFriend($id){

		$this->_db->get('users', array('id', '=', $id));
		if(!$this->_db->error()){
			$user_info = $this->_db->first();
			$this->_db_uc->get($user_info->username.'_friends', array('userid', '=', $this->_user->id));
			if(!$this->_db_uc->error()){
				if($this->_db_uc->count()>0){
					$this->_userFriend = true;
				}else{
					$this->_userFriend = false;
				}
			}else{
				$this->_userFriend = false;
			}
		}

		return $this->_userFriend;

	}

	public function hasRequest($id){

		$this->_db_uc->get($this->_user->username.'_requests', array('userid', '=', $id));
		if(!$this->_db_uc->error()){
			if($this->_db_uc->count()>0){
				$this->_request = true;
			}else{
				$this->_request = false;
			}
		}else{
			$this->_request = false;
		}

		return $this->_request;

	}

	public function hasUserRequest($id){

		$this->_db->get('users', array('id', '=', $id));
		if(!$this->_db->error()){
			$user_info = $this->_db->first();
			$this->_db_uc->get($user_info->username.'_requests', array('userid', '=', $this->_user->id));

			if(!$this->_db_uc->error()){
				if($this->_db_uc->count()>0){
					$this->_userRequest = true;
				}else{
					$this->_userRequest = false;
				}
			}else{
				$this->_userRequest = false;
			}
		}

		return $this->_userRequest;

	}

	public function isBlocked($id){

		$this->_db_uc->get($this->_user->username.'_blocked', array('userid', '=', $id));
		if(!$this->_db_uc->error()){
			if($this->_db_uc->count()>0){
				$this->_blocked = true;
			}else{
				$this->_blocked = false;
			}
		}else{
			$this->_blocked = false;
		}

		return $this->_blocked;

	}

	public function isUserBlocked($id){

		$this->_db->get('users', array('id', '=', $id));
		if(!$this->_db->error()){
			$user_info = $this->_db->first();
			$this->_db_uc->get($user_info->username.'_blocked', array('userid', '=', $this->_user->id));
			if(!$this->_db_uc->error()){
				if($this->_db_uc->count()>0){
					$this->_userBlocked = true;
				}else{
					$this->_userBlocked = false;
				}
			}else{
				$this->_userBlocked = false;
			}
		}

		return $this->_userBlocked;

	}

}

?>
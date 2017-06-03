<!DOCTYPE HTML>
<html>
    <head>
		<link href='bootstrap/jquery/smoothness/jquery-ui-1.10.1.custom.css' rel='stylesheet' type='text/css'>
		<link href='css/custom.css' rel='stylesheet' type='text/css'>
		<link href='css/css_profile.css' rel='stylesheet' type='text/css'>
        <script src="bootstrap/jquery/jquery-1.9.1.js"></script>
    </head>
    <body> 

<?php

require_once 'core/init.php';

//var_dump(token::check(input::get('token')));

$user = new user();

if($user->isLoggedIn()){

	redirect::to('index.php');

}
if(input::exists()) {
	//echo "submitted";
	//echo Input::get('username');
	if(token::check(input::get('token'))) {
		//echo "I have been run";
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array(
						'required' => true,
						'min' => 2,
						'max' => 20,
						'username' => 'users'
					),
				'password' => array(
					'required' => true,
					'min' => 6

					),
				'password_again' => array(
					'required' => true,
					'matches' => 'password'
					),
				'name' => array(
					'required' => true,
					'min' => 2,
					'max' => 50
					),
				'email' => array(
					'required' => true,
					'min' => 4,
					'unique' => 'users'
					),
				'contact_no' => array(
					'required' => true,
					'min' => 6,
					'max' => 15,
					'unique' => 'users'
					)
				));

			if($validation->passed()) {
				//register user
				/*echo "Passed";
				session::flash('success', 'you have registered successfully');
				header('Location: index.php');
				*/
				$user = new user();
				$db = DB::getInstance();
				$db_uc = DBusers_connection::getInstance();
				$db_um = DBusers_messages::getInstance();
				$db_un = DBusers_notifications::getInstance();
				$db_uf = DBusers_feeds::getInstance();
				$db_ui = DBusers_interests::getInstance();
				$db_up = DBusers_posts::getInstance();
				$db_ucl = DBusers_collections::getInstance();
				$salt = hash::salt(32);
				
				try {

					$user->create(array(
							'username' => input::get('username'),
							'password' => hash::make(input::get('password'), $salt),
							'salt' => $salt,
							'name' => input::get('name'),
							'email' => input::get('email'),
							'contact_no' => input::get('contact_no'),
							'joined' => date('Y-m-d H:i:s'),
							'group' => 1
						));

					$name_init = substr(input::get('name'), 0, 1);
					$name_init = strtolower($name_init);
					$username = input::get('username');
					$db->get('users', array('username', '=', $username));
					$result = $db->first();
					$userid = $result->id;
					$init_un = substr($username, 0, 1);
					$init_un = strtolower($init_un);
					
					$db->insert("name_{$name_init}", array('userid'=>$userid, 'name'=>input::get('name')));
					$db->insert("usernames", array('username'=>$username, 'userid'=>$userid));
					$db->insert("users_last_updated", array('userid'=>$userid));
					$db->insert("online_users", array('userid'=>$userid));
					$db_uc->query("CREATE TABLE {$username}_followers (id int auto_increment primary key not null, userid int not null, name_init varchar(1) not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
					$db_uc->query("CREATE TABLE {$username}_following (id int auto_increment primary key not null, userid int not null, name_init varchar(1) not null, id_in_gf int not null, priority int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
					$db_uc->query("CREATE TABLE {$username}_friends (id int auto_increment primary key not null, userid int not null, received_from varchar(50) not null, name_init varchar(1) not null, id_in_gf int not null, priority int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
					$db_uc->query("CREATE TABLE {$username}_blocked (id int auto_increment primary key not null, userid int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
					$db_uc->query("CREATE TABLE {$username}_requests (id int auto_increment primary key not null, userid int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
					$db_um->query("CREATE TABLE {$username}_messages (id int auto_increment primary key not null, userid int not null, message text not null, file_type varchar(100) not null default 'TEXT_MESSAGE', extention varchar(30) not null default 'TEXT', path varchar(400) not null, sorr varchar(10) not null default 'SENT', sorn varchar(10) not null default 'NOT SEEN', date timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
					$db_um->query("CREATE TABLE {$username}_inbox (id int auto_increment primary key not null, userid int not null, message text not null, sorr varchar(10) not null default 'SENT', sorn varchar(10) not null default 'NOT SEEN', date timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
					$db_um->query("CREATE TABLE {$username}_chat_groups (id int auto_increment primary key not null, name varchar(50) not null, chat_table varchar(60) not null, sorn varchar(10) not null default 'NOT SEEN', last_seen int not null, last_updated timestamp not null, joined timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
					$db_um->query("CREATE TABLE {$username}_deleted_chat_groups (id int auto_increment primary key not null, name varchar(50) not null, chat_table varchar(60) not null, left_on timestamp not null default CURRENT_TIMESTAMP)", array(), 'SELECT *');
					$db_un->query("CREATE TABLE {$username}_notifications (id int auto_increment primary key not null, post_id int not null, userid int not null default '{$userid}', ntf_type varchar(30) not null default 'USER', sec_userid int not null, action varchar(50) not null, sorn varchar(10) not null default 'NOT SEEN', date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
					$db_un->insert('notifications_settings', array('userid'=>$userid));
					//$db_un->query("CREATE TABLE {$username}_shown_posts (userid_post_id_post_type varchar(30) not null primary key)", array(), "CREATE")
					$db_up->query("CREATE TABLE {$username}_posts (id int auto_increment primary key not null, text_content text not null, file_type text not null, extention varchar(250) not null default 'TEXT', files text not null, contributors varchar(150) not null, refs text not null, interest_tags text not null, privacy varchar(20) not null default 'FOLLOWERS', suggested_tags text not null, tot_upvotes int not null, tot_downvotes int not null, tot_comments int not null, tot_shares int not null, tot_varify int not null, tot_collects int not null, tot_reports int not null, edit_id int not null, edited_by int not null, delete_id int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
					$db_up->query("CREATE TABLE {$username}_edited_posts (id int auto_increment primary key not null, post_id int not null, text_content text not null, file_type text not null, extention varchar(250) not null default 'TEXT', files text not null, contributors varchar(150) not null, refs text not null, interest_tags text not null, privacy varchar(20) not null default 'FOLLOWERS', suggested_tags text not null, edit_id int not null, edited_by int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
					//$db_up->query("CREATE TABLE {$username}_deleted_posts (id int auto_increment primary key not null, post_id int not null, edit_id int not null, text_content text not null, file_type text not null, extention varchar(250) not null default 'TEXT', files text not null, contributors varchar(150) not null, refs text not null, interest_tags text not null, privacy varchar(20) not null default 'FOLLOWERS', suggested_tags text not null, tot_upvotes int not null, tot_downvotes int not null, tot_comments int not null, tot_shares int not null, tot_varify int not null, tot_reports int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
					$db_ui->query("CREATE TABLE {$username}_interests (id int auto_increment primary key not null, id_in_db int not null, db_id int not null, name_init varchar(1) not null, id_in_st int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
					//collaboration is related to interest
					$db_ui->query("CREATE TABLE {$username}_collaborations (col_id int primary key not null, col_type varchar(30) not null, date timestamp not null default CURRENT_TIMESTAMP)");
					$db_uf->query("CREATE TABLE {$username}_feeds (id int auto_increment primary key not null, userid int not null default '{$userid}', sec_id int not null, post_id int not null, post_type varchar(20) not null default 'USER', action varchar(30) not null default 'UPLOADED', privacy varchar(10) default 'FOLLOWERS', date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
					$db_uf->query("CREATE TABLE {$username}_blocked_feeders (userid int primary key not null)", array(), 'CREATE');
					//needs to change the following table in data base\/
					$db_uf->query("CREATE TABLE {$username}_generate_feeds (id int auto_increment primary key not null, generator_id int not null, generator_type varchar(20) not null default 'USER', new_feed_id int not null, last_seen_id int not null default '0', pointer int not null, last_updated timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
					$db_uf->query("CREATE TABLE {$username}_feeder (id int auto_increment primary key not null, feeder_id int not null, feed_id int not null, feeder_type varchar(15) not null default 'USER', userid int not null, sec_id int not null, post_id int not null, post_type varchar(20) not null, action varchar(30) not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
					$db_uf->insert($username.'_generate_feeds', array('generator_id'=>$userid, 'new_feed_id'=>0, 'last_seen_id'=>0));
					$db_ucl->query("CREATE TABLE {$username}_collections_lists (id int auto_increment primary key not null, collection_name varchar(60) not null, tot_posts int not null)", array(), 'CREATE');
					$db_ucl->query("CREATE TABLE {$username}_collections (id int auto_increment primary key not null, clc_id int not null, post_id int not null, userid int not null, post_type varchar(15) not null)", array(), 'CREATE');
					//$db_uf->query("CREATE TABLE {$username}_updated_users (feeder_id varchar(30) primary key not null)", array(), 'CREATE');
					mkdir("users_personal_chats/{$username}");
					mkdir("posts/{$init_un}/{$username}");
					mkdir("posts/{$init_un}/{$username}/images");
					mkdir("posts/{$init_un}/{$username}/videos");
					mkdir("posts/{$init_un}/{$username}/audios");
					mkdir("posts/{$init_un}/{$username}/files");
					session::flash('home', 'you have registered successfully');
					//header('Location: index.php');
					redirect::to('index.php');

				} catch(Exception $e) {
					die($e->getMessage());
				}
			} else {
				//output errors
				//print_r($validation->errors
					foreach ($validation->errors() as $error) {
							echo $error, '<br>';
						}
				}
	}
}
?>


<form action="" method="post">
	<div class="field">
		<label for="username"> Username</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete ="off">
		<span id="username_msg"></span>
	</div>

	<div class="field">
		<label for="password"> Choose a Password</label>
		<input type="password" name="password" id="password">
		<span id="password_msg"></span>
	</div>

	<div class="field">
		<label for="password_again"> Enter your password again</label>
		<input type="password" name="password_again" id="password_again">
		<span id=""></span>
		<span id="password_again_msg"></span>
	</div>

	<div class="field">
		<label for="name"> Your name</label>
		<input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">
		<span id="name_msg"></span>
	</div>

	<div class="field">
		<label for="email"> Email id</label>
		<input type="text" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>">
		<span id="email_msg"></span>
	</div>

	<div class="field">
		<label for="contact_no"> Contact Number</label>
		<input type="text" name="contact_no" id="contact_no" value="<?php echo escape(Input::get('contact_no')); ?>">
		<span id="contact_no_msg"></span>
	</div>

	<input type="hidden" name="token"  value="<?php echo token::generate(); ?>">
	<input type="submit" value="Register">
</form>
<script type="text/javascript" src="javascripts/register.js"></script>
</body>
</html>
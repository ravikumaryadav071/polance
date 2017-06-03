<?php
session_start();
ob_start();

$GLOBALS['config'] = array(

	'mysql' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_login'
		),
	'remember' => array(
			 'cookie_name' => 'hash',
			 'cookie_expiry' => 604800
		),
	'session' => array(
			'session_name' => 'user',
			'token_name' => 'token'

		),
	'mysql_for_polance_data' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_data'
		),
	'mysql_for_users_connection' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_users_connection'
		),
	'mysql_for_users_collections' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_users_collections'
		),
	'mysql_for_users_messages' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_users_messages'
		),
	'mysql_for_users_feeds' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_users_feeds'
		),
	'mysql_for_users_interests' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_users_interests'
		),
	'mysql_for_users_notifications' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_users_notifications'
		),
	'mysql_for_users_posts' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_users_posts'
		),
	'mysql_for_groups_messages' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_groups_messages'
		),
	'mysql_for_interests_business' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_interests_business'
		),
	'mysql_for_interests_corporate_world' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_interests_corporate_world'
		),
	'mysql_for_interests_education' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_interests_education'
		),
	'mysql_for_interests_finance' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_interests_finance'
		),
	'mysql_for_interests_philosophy' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_interests_philosophy'
		),
	'mysql_for_interests_politics' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_interests_politics'
		),
	'mysql_for_interests_social' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_interests_social'
		),
	'mysql_for_interests_sports' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_interests_sports'
		),
	'mysql_for_users_posts_comments' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_users_posts_comments'
		),
	'mysql_for_users_posts_responses' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_users_posts_responses'
		),
	'mysql_for_collaborations' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_collaborations'
		),
	'mysql_for_collaborations_posts' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_collaborations_posts'
		),
	'mysql_for_collaborations_posts_comments' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_collaborations_posts_comments'
		),
	'mysql_for_collaborations_posts_responses' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_collaborations_posts_responses'
		),
	'mysql_for_collaborations_members' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'polance_collaborations_members'
		),

	'main_interests_domain' => array(
			'polance_interests_business'=>'business_sub_interests',
			'polance_interests_corporate_world'=>'corporate_world_sub_interests',
			'polance_interests_education'=>'education_sub_interests',
			'polance_interests_finance'=>'finance_sub_interests',
			'polance_interests_philosophy'=>'philosofy_sub_interests',
			'polance_interests_politics'=>'politics_sub_interests',
			'polance_interests_sports'=>'sports_sub_interests',
			'polance_interests_social'=>'social_sub_interests'
		)
	);

spl_autoload_register(function ($class) {
	require_once 'classes/'. $class .'.php';

});

require_once 'functions/sanitize.php';

if (cookie::exists(config::get('remember/cookie_name')) && !session::exists(config::get('session/session_name'))) {
	//echo "User Asked to be remembered";
	$hash = cookie::get(config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

	if ($hashCheck->count()) {
		//echo "hash matches, log user in";
		//echo $hashCheck->first()->user_id;
		$user = new user($hashCheck->first()->userid);
		$user->login();
	}
}

?>
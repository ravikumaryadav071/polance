<html>
	<head>
		<link href='bootstrap/jquery/smoothness/jquery-ui-1.10.1.custom.css' rel='stylesheet' type='text/css'>
		<link href='css/css_profile.css' rel='stylesheet' type='text/css'>
		<script src="bootstrap/jquery/jquery-1.9.1.js"></script>
		<script src="bootstrap/jquery/jquery-ui-1.10.1.custom.min.js"></script>
		<script src='bootstrap/js/bootstrap.js'></script>	
	</head>
	<body>
		<?php
			require_once 'core/init.php';

			$user = new user();
			if($user->isLoggedIn()){

				?>
				<form id="search_form" action="search.php" method="post">
					<input type="text" name="search_text" id="search_text" placeholder="Serach by Name or Username" autocomplete="off" value="<?php echo escape(input::get('search_text')); ?>">
					<input type="submit" name="search" id="search" value="search">
				</form>
				<?php

				if(isset($_POST) && !empty($_POST)){

					if(isset($_POST['search_text']) && !empty($_POST['search_text'])){
					
						$db = DB::getInstance();
						$uc = user_connections::getInstance();
						$userid = $_SESSION['user'];
						$users_pp = 10; //number of users per page
						$search_text = trim($_POST['search_text']);
						$db->query("SELECT * FROM users WHERE id != {$userid} AND (username LIKE '%$search_text%' OR name LIKE '%$search_text%' OR email LIKE '%$search_text%') ORDER BY joined DESC, id DESC LIMIT 0,{$users_pp}");
						include 'include/search.php';

					}

				}

			}

		?>
		<div id="message"></div>
		<script type="text/javascript" src="javascripts/user_connections.js"></script>
		<script type="text/javascript" src="javascripts/search.js"></script>
	</body>
</html>
<!DOCTYPE HTML>
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
			<div>
				<form action="" method="POST">
					<input type="text" id="col_text" name="col_name" value="<?php if(isset($_POST['col_text'])){ echo $_POST['col_text']; } ?>">
					<input type="submit" value="Search">
				</form>
			</div>
			<?php

			if(isset($_POST) && !empty($_POST)){

				$col_name = trim($_POST['col_name']);
				$db_col = DBcollaborations::getInstance();
				$no_sugsn = 20;
				$db_col->query("SELECT * FROM collaborations WHERE collaboration_name LIKE '%{$col_name}%' LIMIT 0,{$no_sugsn}", array(), 'SELECT *');
				$tot_sugsn = $db_col->count();
				if($tot_sugsn>0){

					$results = $db_col->results();
					$show_sugsn = ($tot_sugsn>=$no_sugsn)?$no_sugsn:$tot_sugsn;

					for($i=0; $i<$show_sugsn; $i++){

						$result = $results[$i];
						?>
						<div>
							<a href="collaboration.php?col=<?php echo $result->unique_name; ?>"><?php echo $result->collaboration_name; ?></a>
						</div>
						<?php

					}

				}

			}


		}
		?>
		<script type="text/javascript" src="javascripts/collaboration_sugsn.js"></script>
	</body>
</html>
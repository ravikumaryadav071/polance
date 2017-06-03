<html>
	<head>
		<title>Polance</title>
		<link href='bootstrap/jquery/smoothness/jquery-ui-1.10.1.custom.css' rel='stylesheet' type='text/css'>
		<link href='css/css_profile.css' rel='stylesheet' type='text/css'>
		<script src="bootstrap/jquery/jquery-1.9.1.js"></script>
		<script src="bootstrap/jquery/jquery-ui-1.10.1.custom.min.js"></script>
		<script src='bootstrap/js/bootstrap.js'></script>
	</head>
	<body>
		<?php

		$text = "I have links http://www.polance.com m.facebook.com/ravi_kumar m.cricbuzz.com ";
		$regx = '|(http://)?[a-z]+\.[a-z0-9@_-]+\.[a-z0-9@\/_-]+[\s]|i';
		preg_match_all($regx, $text, $matches);
		print_r($matches);
		?>
		<div>
			<img src="images/profile_pic/d98fcdb29ac0850181cfb254eed2e21c81080ed53e034813f17379202a7377ca_ravikumar.jpg">
			<p>Thassun ji di hor.</p>
		</div>
		<div>
			<input type="button" id="btn" value="new">
			<div id="drag_me">
				Before.
			</div>
			<div id="drag_me">
				Dragging me.
			</div>
			<div id="drop_here">
				Drop here.
			</div>
			<div id="message"></div>
		</div>
		<script type="text/javascript" src="javascripts/dragging_me.js"></script>
	</body>
</html>
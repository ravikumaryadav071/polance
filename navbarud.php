<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding hdrcolor">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding">
	        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-10 nopadding logondtagdiv">
	        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding logodiv">
	            	<a href="index.php"><img src="bootstrap/img/final1.png" class="center-block logo"></a>
	        	</div>
	        	<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding taglinediv">
					<span>We Grow To Change</span>
	        	</div> -->
	        </div>
	        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-2 explorebtn nopadding">
	        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadding">
		        	<form id="search_form" class="form-horizontal center-block" action="search.php" method="post">
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 input-group">
							<input type="text" class="form-control" name="search_text" id="search_text" placeholder="Serach by Name or Username" autocomplete="off">
							<div class="input-group-btn">
								<button class="btn btn-primary">
									<span class="glyphicon glyphicon-search searchbtnpadding">
										<input type="submit" hidden name="search" id="search" value="search">
									</span>
								</button>
							</div>
						</div>
					</form>
	        	</div>
	        	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 nopadding">
	        		<div class="polygon">
	        		</div>
		        	<div class="dropdown pull-right">
						<button class="btn btn-primary navdropdownbtn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		        			<span ><?php echo ucwords($user_data->name) ?></span>
					    	<span class="caret"></span>
					  	</button>
					  	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					    	<li><a href="update.php">Update</a></li>
					    	<li><a href="changepwd.php">Change Password</a></li>
					  	</ul>
					</div>
	        	</div>
	        	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		        	<a href="logout.php"><span class="glyphicon glyphicon-off pull-right"></span></a>
		        	<a href="stats.php"><span class="glyphicon glyphicon-signal pull-right"></span></a>
		        	<a href="profile.php?user=<?php echo escape($user->data()->username); ?>">
		        		<div class="clip-wrap">
  <!-- <img src="http://karen@karenmenezes.com/shapes-polygon/clip-demo.jpg" alt="demo-image-clip-path" width="140" height="140"> -->
  <!-- <span class="font-large">+</span>
  <img src="http://karen@karenmenezes.com/shapes-polygon/mask-hexagon.png" alt="demo-polygon-clip-path" width="140" height="140">
  <span class="font-large">=</span> -->
  <img src="<?php echo $user_data->profile_pic; ?>" alt="demo-clip-path" width="50" height="50" class="clip-polygon">
</div> <!-- /clip-wrap -->

		<svg class="clip-svg">
			  <defs>
				    <clipPath id="clip-svg-demo" clipPathUnits="objectBoundingBox">
					      <polygon points="0.42 0, 0.53 0, 1 0.5, 0.85 1, 0.15 1, 0 0.5" />
				    </clipPath>
			  </defs>	
		</svg>
		        		<!-- <img class="profilepicthumbnail pull-right" src="<?php echo $user_data->profile_pic; ?>" alt="<?php echo escape($user_data->name); ?>"> -->
		        	</a>
		        	<!-- <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Dropdown
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div> -->
	        	</div>
	        </div>
	    </div>
</div>
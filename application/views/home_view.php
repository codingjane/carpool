<html>
<head>
	<meta charset="UTF-8">
	<title>Profile - Homepage</title>
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
		$user = $this->session->userdata['user_info'];
		$logged_in = $user['logged_in'];
		if ($logged_in) 
		{
			$first_name = $user['first_name'];
			$last_name = $user['last_name'];
			$email = $user['email'];
			echo "<div class='hdr'><h4>Welcome  ". $first_name. "   ". "</h4><a href=/login/logout>Log Off</a>" ; 
			//echo "<h3> Welcome  ". $first_name. "</h3>";
			//echo "<a href=/login/logout>Log Off</a>";
				echo "<div class='welcome'> <h4>User Information</h4>";
				echo "<h5> First Name: ". $first_name. "</h5>";
				echo "<h5> Last Name: ". $last_name. "</h5>";
				echo "<h5> email:  ". $email. "</h5>";
				echo "</div>";
			echo "</div>";
		} 
		else 
		{
			echo "<h3> Not logged in - show some page </h3>";
		}
?>
</body>
</html>
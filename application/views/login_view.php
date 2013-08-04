<html>
<head>
	<meta charset="UTF-8">
	<title>Login and Registration</title>
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="container">
		<div id="login_form" class="stylized myform">
			<h3> Login </h3>
			<?php echo $this->session->flashdata('message_success'); ?>
		<!--/login is the controller and login_user is function in class login -->
			 <form action="/login/login_process" method="POST">
			 	<div>
			 		<label for="email">Email: </label>
			 		<input type="email" name="email" value="<?php echo set_value('email'); ?>"/>
			 	</div>
			 	<div>
			 		<label for="password">Password: </label>
			 		<input type="password" value="" name="password" />
			 	</div>
				<div>
					<button class="btn pull-right" name="submit" value="Login" /> Login </button>
				</div>
				<?php if (isset($errors_login)){echo ($errors_login);} ?>
				<div><?php echo $this->session->flashdata('message_duplicate');?>
			    </div>
			 </form>       
				<!--<form action="/register/register_home" method="post">-->
				<form action="/carpool/carpool_home" method="post">
							<input type="submit" class="btn btn-primary register_btn pull-right" name="submit" value="New Parent Register Here" />
				</form>
		</div>
	</div> 
</body>
</html>

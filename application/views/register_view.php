
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
		 	<div id="reg_form" class="stylized myform">
		 		<h3> New Parent Registration </h3>
				<?php echo form_open('register/register_process')
				// <form action="/register/register_process" method="POST"> -->
					// if (isset($success))
					//  {echo ($message_success);}

					//  echo $this->session->flashdata('message_duplicate');
					//  echo $this->session->flashdata('errors_registration');
					//  echo $this->session->flashdata('message_duplicate');
				?>
				<div>
					<label for="first_name">First Name:</label>
					<input type="input" id="first_name" name="first_name" value="<?php echo set_value('first_name'); ?>" />
					<label for="last_name">Last Name:</label>
					<input type="input" id="last_name" name="last_name" value="<?php echo set_value('last_name'); ?>" />
					
					<label for="last_name">email:</label>
					<input type="input" id="email" name="email" value="<?php echo set_value('email'); ?>" />
					<h5> Address : </h5>
					<label for="address_street">Street:</label>
					<input type="input" id="address_street" name="address_street" value="<?php echo set_value('address_street'); ?>" />
					
					<label for="address_city">City:</label>
					<input type="input" id="address_city" name="address_city" value="<?php echo set_value('address_city'); ?>" />

					<label for="address_zipcode">Zipcode:</label>
					<input type="input" id="address_zipcode" name="address_zipcode" value="<?php echo set_value('address_zipcode'); ?>" />
					
					<?php 
						echo form_dropdown('address_state', $states,set_value('address_state'),'id="address_state"'); 
						//var_dump($states); 
					?>
					<label for="address_state">State:</label>
					<input type="input" id="address_state" name="address_state" value="<?php echo set_value('address_state'); ?>" />

					<label for="address_country"> Country:</label>
					<input type="input" id="address_country" name="address_country" value="<?php echo set_value('address_country'); ?>" />

					<label for="phone_home"> Home Phone#</label>
					<input type="input" id="phone_home" name="phone_home" value="<?php echo set_value('phone_home'); ?>" />

					<label for="phone_mobile"> Mobile Phone#</label>
					<input type="input" id="phone_mobile" name="phone_mobile" value="<?php echo set_value('phone_mobile'); ?>" />

					<label for="password">Password: </label>
					<input type="password" id="password" name="password" value="" />
					<label for="last_name">Re-enter Password:</label>
					<input type="password" id="con_password" name="con_password" value="" />
				</div> 

				<div>
					<button type="submit" class="btn btn-primary pull-right" name="submit" value="Register">Register</button>
				</div>
				</form>
				<?php echo $this->session->flashdata('errors_registration'); ?>
			</div><!--<div class="reg_form">-->   
	</div> 
</body>
</html>

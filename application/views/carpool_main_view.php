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
		 <div id="activity_form" class="stylized myform">
		 	<fieldset>
		 			<?php
		 				// var_dump($activity);
						// echo form_dropdown('activity_name', $activity,set_value('activity_name'),'id="id"'); 
						//var_dump($states);
		 			?>
				<label for="activity_name">Activity Name:</label>
		 		<select name="activity_name" style="width:300px">
					<option value="0">Show all</option>
					<?php 
						//echo " before foreach";

						foreach($activity as $act)
						{
						  echo "<option value='{$act['id']}'>{$act['activity_name']}" ;
						}
						
					?>
				</select>
				<form action="/carpool/get_carpool_list" method="post">
				<h5>Location Address</h5>
				<label for="address_street">Street</label>
				<input type="input" id="address_street" name="address_street" <?php echo " value = '{$act["address_street"]}'";?>/>
				<label for="address_city">City</label>
				<input type="input" id="address_city" name="address_city" <?php echo " value = '{$act["address_city"]}'";?>/>
				<label for="address_zipcode">Zipcode </label>
				<input type="input" id="address_zipcode" name="address_zipcode" <?php echo " value = '{$act["address_zipcode"]}'";?>/>

				<label for="start_date">Date</label>
				<input type="input" id="start_date" name="start_date" <?php echo "value = '{$act["activity_start_date"]}'";?>/>
				<!-- display day as in Saturday, Monday  -->

				<label for="start_time">Start time</label>
				<input type="input" id="start_time" name="start_time" <?php echo "value= '{$act["activity_start_time"]}'";?>/>

				<label for="end_time">End Time </label>
				<input type="input" id="end_time" name="end_time" <?php echo "value= '{$act["activity_end_time"]}'";?> />

						<!-- <form id="custom-search-form" class="form-search form-horizontal pull-right">
						    <div class="input-append span12">
						        <input type="text" class="search-query" placeholder="Search">
						        <button type="submit" class="btn"><i class="icon-search"></i></button>
						    </div>
						</form> -->
					<?php 
					$newdata  = $activity;
					$this->session->set_userdata($newdata);
					?>
					<input type="submit" class="btn btn-primary register_btn pull-right" name="submit" value="Get Carpool List" />
				</form>
			</fieldset>
		</div>
		<div id="carpool_table">
			<table class="table table-striped table-condensed">
			    <thead>
			        <tr>
			            <th>id#</th>
			            <th>Student Name</th>
			            <th>Home School</th>
			            <th>Parent Name</th>
			            <th>Need a ride</th>
			            <th>Can drive up</th>
			            <th>Can drive return</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<?php 
						//echo " before foreach";
						foreach($carpool_list as $person)
							//var_dump($carpool_list); die();
						// {
						//   echo "<option value='{$act['id']}'>{$act['activity_name']}" ;
						// }
						{				
					        echo "<tr>";
					    		echo "<td value=".'{$person["id"]}'."></td>";
						    	echo "<td value=".'{$person["student_name"]}'."></td>";
						    	echo "<td value=".'{$person["home_school_name"]}'."></td>";
						    	echo "<td value=".'{$person["parent_name"]}'."></td>";
						    	echo "<td value=".'{$person["can_drive"]}'."></td>";
						    	echo "<td value=".'{$person["can_drive_up"]}'."></td>";
						    	echo "<td value=".'{$person["can_drive_return"]}'."></td>";
					        echo "</tr>";
					    }// end of loop
			        ?>
			    </tbody>
			</table>
				</div>
</body>
</html>
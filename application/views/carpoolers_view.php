<html>

<head>
<link rel="stylesheet" type="text/css"
      href="<?php echo "$base/$css"?>">
</head>
<body>
<div id="header">
<? $this->load->view('carpooler_header'); ?>
</div>
<!-- <div id="menu">
<?   $this->load->view('carpooler_menu'); ?>

</div>
 -->
<? echo heading('List of Carpoolers',3); ?>



<!-- <table border="1">
  <tr>
    <th>ID</th>
    <th>Activity Name</th>    
    <th>Street Address</th>    
    <th>Zip Code</th>
    <th>From Date</th>
    <th>End Date</th>
    <th>From Time</th>
    <th>To Time</th>

  </tr>
    <?php foreach($query as $row)
    {
      echo "<tr>";
        echo "<td>". $row->id ."</td>";
        echo "<td>". $row->title ."</td>";
        echo "<td>". $row->author ."</td>";
        echo "<td>". $row->year ."</td>";
      echo "</tr>";   
    }
  ?>

</table> -->

<div id="footer">
  <? $this->load->view('carpooler_footer'); ?>
</div>
</body>
</html>

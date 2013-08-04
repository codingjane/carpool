<html>

<head>
<link rel="stylesheet" type="text/css"
      href="<?php echo "$base/$css"?>">
</head>
<body>
<div id="header">
<? $this->load->view('carpool_header'); ?>
</div>
<div id="menu">
<?   $this->load->view('carpool_menu_view'); ?>

</div>

  <? echo heading('List of Carpoolers',3); ?>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Title</th>    
    <th>Author</th>    
    <th>Year</th>    
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

</table>

<div id="footer">
<? $this->load->view('carpooler_footer'); ?>
</div>
</body>
</html>

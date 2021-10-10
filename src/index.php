<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Costa365</title>
  <link href="entireframework.min.css" rel="stylesheet" type="text/css">
  <link href="css/styles.css" rel="stylesheet" type="text/css">
 </head>
 <body>
 <?php
 include_once('header.php');
 ?>
 <div class="container">
 <div class="row">
 <?php
 include_once('cms.php');
 $ct = cms::readContent('sites');
 foreach ($ct as $k => $v) {
  echo "<div class='col c4'><h3>{$ct[$k][name]}</h3>";
  echo "<table><tr>";
  echo "<td><img src='{$ct[$k][image]}' alt='' height='76' width='76'></td>";
  echo "<td>{$ct[$k][description]}<br><a href='{$ct[$k][link]}' class='btn btn-sm btn-a'>Check it out!</a></td>";
  echo "</tr></table></div>";
 }
 ?>
 </div>
 </div>
 
 </div>
 </body>
</html>

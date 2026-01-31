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
 <div class="card-grid">
 <?php
 include_once('cms.php');
 $ct = cms::readContent('sites');
 foreach ($ct as $k => $v) {
  echo "<div class='card'>";
  echo "<div class='card-header'><h3>{$ct[$k]['name']}</h3><a href='{$ct[$k]['link']}' class='btn btn-a' target='_blank'>Check it out!</a></div>";
  echo "<div class='card-content'>";
  echo "<img src='{$ct[$k]['image']}' alt='{$ct[$k]['name']}'>";
  echo "<div class='description'>{$ct[$k]['description']}</div>";
  echo "</div>";
  echo "</div>";
 }
 ?>
 </div>
 </div>
 
 </div>
 </body>
</html>


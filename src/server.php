<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Costa365 - Server</title>
  <link href="entireframework.min.css" rel="stylesheet" type="text/css">
 </head>
 <body>
<?php
include_once('header.php');
?>
<div class="container">
<table class="table">
<tbody>
 <tr>
  <th>Operating System</th>
  <td><?php echo php_uname('a'); ?></td>
 </tr>
 <tr>
  <th>Server Side Language</th>
  <td>PHP v<?php echo phpversion(); ?></td>
 </tr>
 <tr>
  <th>CSS Framework</th>
  <td><a href="https://mincss.com">Min CSS</a></td>
 </tr>
 <tr>
  <th>Web server</th>
  <td><?php echo str_replace('/', ' v', apache_get_version()); ?></td>
 </tr>
 <tr>
  <th>IP Address</th>
  <td><?php echo gethostbyname("costa365.rf.gd"); ?></td>
 </tr>


 <?php
  include_once('ipInfo.php');
  $ipInfo = new ipInfo(gethostbyname("costa365.rf.gd"));

  echo '<tr><th>Location</th><td>' . $ipInfo->getLocation() . '</td></tr>';
  echo '<tr><th>AS</th><td>' . $ipInfo->getAs() . '</td></tr>';
  echo '<tr><th>Service Provider</th><td>' . $ipInfo->getIsp() . '</td></tr>';
  echo '<tr><th>Organisation</th><td>' . $ipInfo->getOrganisation() . '</td></tr>';
 ?> 
 
 </tbody>
</table>
</div>

</body>
</html>

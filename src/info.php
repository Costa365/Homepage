<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Costa365 - Info</title>
  <link href="//mincss.com/entireframework.min.css" rel="stylesheet" type="text/css">
 </head>
 <body>
 <?php
  include_once('header.php');
  include_once('browserInfo.php');
  include_once('ipInfo.php');
  $browserInfo = new browserInfo();
  $ipInfo = new ipInfo();

echo '<div class="container">
<table class="table">
<tbody>
 <tr>
  <th>IP Address</th>';
echo '  <td>' . $ipInfo->getIpAddress() . '</td>';
echo ' </tr>
 <tr>
  <th>Location</th>';
echo '  <td>' . $ipInfo->getLocation(). '</td>';
echo ' </tr>
<tr>
  <th>AS</th>';
echo '  <td>' . $ipInfo->getAs(). '</td>';
echo ' </tr>
<tr>
  <th>Service Provider</th>';
echo '  <td>' . $ipInfo->getIsp(). '</td>';
echo ' </tr>
<tr>
  <th>Organisation</th>';
echo '  <td>' . $ipInfo->getOrganisation(). '</td>';
echo ' </tr>
 <tr>
  <th>Browser</th>';
echo '  <td>' . $browserInfo->getName() . '</td>';
echo ' </tr>
 <tr>
  <th>Version</th>';
echo '  <td>v' . $browserInfo->getBrowserVersion() . '</td>';
echo ' </tr>
 <tr>
  <th>Platform</th>';
echo '  <td>' . $browserInfo->getPlatform() . '</td>';
echo ' </tr>
 <tr>
  <th>User Agent</th>';
echo '  <td>' . $browserInfo->getUserAgent() . '</td>';
echo ' </tr>
</tbody>
</table>
</div>';
?>

</div>

</body>
</html>

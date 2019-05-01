<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Costa365 - Client</title>
  <link href="//mincss.com/entireframework.min.css" rel="stylesheet" type="text/css">
 </head>
 <body>
 <?php
  include_once('header.php');
  include_once('clientInfo.php');
  include_once('ipInfo.php');
  $clientInfo = new clientInfo();
  $ipInfo = new ipInfo();

echo '<div class="container">
<table class="table">
<tbody>
 <tr>
  <th>IP Address</th>';
echo '<td>' . $ipInfo->getIpAddress() . '</td>';
echo '</tr>
 <tr>
  <th>Location</th>';
echo '<td>' . $ipInfo->getLocation(). '</td>';
echo '</tr>
 <tr>
  <th>AS</th>';
echo '<td>' . $ipInfo->getAs(). '</td>';
echo '</tr>
 <tr>
  <th>Service Provider</th>';
echo '<td>' . $ipInfo->getIsp(). '</td>';
echo '</tr>
 <tr>
  <th>Organisation</th>';
echo '<td>' . $ipInfo->getOrganisation(). '</td>';
echo '</tr>
 <tr>
  <th>Browser</th>';
$version = $clientInfo->getBrowserVersion() == clientInfo::UNKNOWN ? '' : (' '.$clientInfo->getBrowserVersion());
echo '<td>' . $clientInfo->getName() . $version . '</td>';
echo '</tr>
 <tr>
  <th>Platform</th>';
echo '<td>' . $clientInfo->getPlatform() . '</td>';
echo '</tr>
 <tr>
  <th>User Agent</th>';
echo '<td>' . $clientInfo->getUserAgent() . '</td>';
echo '</tr>
</tbody>
</table>
</div>';
?>

</div>

</body>
</html>

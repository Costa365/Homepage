<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Browser Info</title>
  <link href="//mincss.com/entireframework.min.css" rel="stylesheet" type="text/css">
 </head>
 <body>

 <nav class="nav" tabindex="-1" onclick="this.focus()">
  <div class="container">
   <a class="pagename current" href="#">Browser Info</a>
   <a href="http://cpubenchmark.co.nf">CPU Info</a>
   <a href="http://bloodglucoseconverter.co.nf/">Blood Glucose Converter</a> 
   <a href="http://fonoapi.co.nf/">Phone Info</a>
  </div>
 </nav>
 <p />
 <div class="container">
 <?php
  include_once('BrowserInfo.php');
  $b = new BrowserInfo();
  $yourbrowser= "<div id='info'>Your browser: " . $b->getName() . " v" . $b->getVersion() . " on " . $b->getPlatform() . " reports: </div><i>" . $b->getUserAgent() . "</i>";
  print_r($yourbrowser);
  echo "<br><br>Time: " . date("H:i:s") . " GMT<br>";
  echo "Date: " . date("d/m/Y");
  echo '<br>PHP version: ' . phpversion();
?>  
</div>
</body>
</html>


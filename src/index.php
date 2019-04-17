<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <p>
 <?php 


function getBrowser() { 
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";

  //First get the platform?
  if (preg_match('/Android/i', $u_agent)) {
    $platform = 'Android';  
  }elseif(preg_match('/linux/i', $u_agent)) {
    $platform = 'Linux';
  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'Mac';
  }elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'Windows';
  }

  // Next get the name of the useragent yes seperately and for good reason
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Firefox/i',$u_agent)){
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  }elseif(preg_match('/OPR/i',$u_agent)){
    $bname = 'Opera';
    $ub = "Opera";
  }elseif(preg_match('/SamsungBrowser/i',$u_agent)){
    $bname = 'Samsung Browser';
    $ub = "SamsungBrowser";
  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Apple Safari';
    $ub = "Safari";
  }elseif(preg_match('/Netscape/i',$u_agent)){
    $bname = 'Netscape';
    $ub = "Netscape";
  }elseif(preg_match('/Edge/i',$u_agent)){
    $bname = 'Edge';
    $ub = "Edge";
  }elseif(preg_match('/Trident/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Lynx/i',$u_agent)){
    $bname = 'Lynx';
    $ub = "Lynx";
  }elseif(preg_match('/w3m/i',$u_agent)){
    $bname = 'W3M';
    $ub = "w3m";
  }

  // finally get the correct version number
  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) .
')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
    // we have no matching number just continue
  }
  // see how many we have
  $i = count($matches['browser']);
  if ($i != 1) {
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        $version= $matches['version'][0];
    }else {
        $version= $matches['version'][1];
    }
  }else {
    $version= $matches['version'][0];
  }

  // check if we have a number
  if ($version==null || $version=="") {$version="?";}

  // handle curl
  if (strpos($u_agent, 'curl') !== false) {
    $bname = 'Curl';
    $u_name = 'Curl';
  }

  return array(
    'userAgent' => $u_agent,
    'name'      => $bname,
    'version'   => $version,
    'platform'  => $platform,
    'pattern'   => $pattern
  );
} 

$ua=getBrowser();
$yourbrowser= "Your browser: " . $ua['name'] . " v" . $ua['version'] . " on " .$ua['platform'] . " reports: <br ><i>" . $ua['userAgent'] . "</i>";
print_r($yourbrowser);

echo "<br><br>Time: " . date("H:i:s") . " GMT<br>";
echo "Date: " . date("d/m/Y");

  //require_once('BrowserInfo.php');

  //$b = new BrowserInfo;

  //echo $b->getName();
/*
  printf("UserAgent: %s\nName: %s\nVersion: %s\nPlatform: %s\n", 
    $browser->getUserAgent(),
    $browser->getName(),
    $browser->getVersion(),
    $browser->getPlatform());
*/
 ?> 
</p> 
</body>
</html>


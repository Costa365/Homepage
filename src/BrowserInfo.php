<?php
class BrowserInfo {
  /*
  private $uagent = $_SERVER['HTTP_USER_AGENT'];
  private $bname = 'Unknown';
  private $version = "";
  private $platform = 'Unknown';
  private $pattern = '';
  private $sname = '';
*/
  /*public function BrowserInfo() { 
    readPlatform();
    readName();
    readVersion();
  }

  private function readPlatform() {
    if (preg_match('/linux/i', $uagent)) {
      $platform = 'linux';
    }elseif (preg_match('/macintosh|mac os x/i', $uagent)) {
      $platform = 'mac';
    }elseif (preg_match('/windows|win32/i', $uagent)) {
      $platform = 'windows';
    }
  }

  private function readName() {
    if(preg_match('/MSIE/i',$uagent) && !preg_match('/Opera/i',$uagent)){
      $bname = 'Internet Explorer';
      $sname = "MSIE";
    }elseif(preg_match('/Firefox/i',$uagent)){
      $bname = 'Mozilla Firefox';
      $sname = "Firefox";
    }elseif(preg_match('/OPR/i',$uagent)){
      $bname = 'Opera';
      $sname = "Opera";
    }elseif(preg_match('/Chrome/i',$uagent) && !preg_match('/Edge/i',$uagent)){
      $bname = 'Google Chrome';
      $sname = "Chrome";
    }elseif(preg_match('/Safari/i',$uagent) && !preg_match('/Edge/i',$uagent)){
      $bname = 'Apple Safari';
      $sname = "Safari";
    }elseif(preg_match('/Netscape/i',$uagent)){
      $bname = 'Netscape';
      $sname = "Netscape";
    }elseif(preg_match('/Edge/i',$uagent)){
      $bname = 'Edge';
      $sname = "Edge";
    }elseif(preg_match('/Trident/i',$uagent)){
      $bname = 'Internet Explorer';
      $sname = "MSIE";
    }
  }

  private function readVersion(){
    $known = array('Version', $sname, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
  ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $uagent, $matches)) {
      // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
      //we will have two since we are not using 'other' argument yet
      //see if version is before or after the name
      if (strripos($uagent,"Version") < strripos($uagent,$sname)){
          $version= $matches['version'][0];
      }else {
          $version= $matches['version'][1];
      }
    }else {
      $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
  }
*/
/*
  public function getUserAgent{
    return $uagent;
  }

  public function getName{
    return $bname;
  }

  public function getVersion{
    return $version;
  }

  public function getPlatform{
    return $platform;
  }

  public function getPattern{
    return $pattern;
  }
} 
*/
?> 
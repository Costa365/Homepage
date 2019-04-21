<?php
class BrowserInfo {
  
  private $uagent = '';
  private $bname = 'Unknown';
  private $version = '';
  private $platform = 'Unknown';
  private $pattern = '';
  private $sname = '';

  public function BrowserInfo() { 
    $this->uagent = $_SERVER['HTTP_USER_AGENT'];
    $this->readPlatform();
    $this->readName();
    $this->readVersion();
  }
  
  private function readPlatform() {
    if (preg_match('/Android/i', $this->uagent)) {
      $this->platform = 'Android';  
    }elseif(preg_match('/linux/i', $this->uagent)) {
      $this->platform = 'Linux';
    }elseif (preg_match('/macintosh|mac os x/i', $this->uagent)) {
      $this->platform = 'Mac';
    }elseif (preg_match('/windows|win32/i', $this->uagent)) {
      $this->platform = 'Windows';
    }
  }

  private function readName() {
    $uagent = $this->uagent;
    if(preg_match('/MSIE/i',$uagent) && !preg_match('/Opera/i',$uagent)){
      $this->bname = 'Internet Explorer';
      $this->sname = "MSIE";
    }elseif(preg_match('/Firefox/i',$uagent)){
      $this->bname = 'Mozilla Firefox';
      $this->sname = "Firefox";
    }elseif(preg_match('/OPR/i',$uagent)){
      $this->bname = 'Opera';
      $this->sname = "Opera";
    }elseif(preg_match('/SamsungBrowser/i',$u_agent)){
      $this->bname = 'Samsung Browser';
      $this->sname = 'SamsungBrowser';
    }elseif(preg_match('/Chrome/i',$uagent) && !preg_match('/Edge/i',$uagent)){
      $this->bname = 'Google Chrome';
      $this->sname = 'Chrome';
    }elseif(preg_match('/Safari/i',$uagent) && !preg_match('/Edge/i',$uagent)){
      $this->bname = 'Apple Safari';
      $this->sname = "Safari";
    }elseif(preg_match('/Netscape/i',$uagent)){
      $this->bname = 'Netscape';
      $this->sname = "Netscape";
    }elseif(preg_match('/Edge/i',$uagent)){
      $this->bname = 'Edge';
      $this->sname = "Edge";
    }elseif(preg_match('/Trident/i',$uagent)){
      $this->bname = 'Internet Explorer';
      $this->sname = "MSIE";
    }elseif(preg_match('/Lynx/i',$u_agent)){
      $this->bname = 'Lynx';
      $this->sname = "Lynx";
    }elseif(preg_match('/w3m/i',$u_agent)){
      $this->bname = 'W3M';
      $this->sname = "w3m";
    }
    
    if (strpos($u_agent, 'curl') !== false) {
      $this->bname = 'Curl';
      $this->sname = 'Curl';
    }
  }

  private function readVersion(){
    $known = array('Version', $this->sname, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $this->uagent, $matches)) {
      // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    
    if ($i != 1) {
      //we will have two since we are not using 'other' argument yet
      //see if version is before or after the name
      if (strripos($this->uagent,"Version") < strripos($this->uagent,$this->sname)){
        $this->version= $matches['version'][0];
      }else {
        $this->version= $matches['version'][1];
      }
    }else {
      $this->version= $matches['version'][0];
    }

    // check if we have a number
    if ($this->version==null || $this->version=="") {
      $this->version='?';
    }
  }

  public function getUserAgent(){
    return $this->uagent;
  }

  public function getName(){
    return $this->bname;
  }

  public function getVersion(){
    return $this->version;
  }

  public function getPlatform(){
    return $this->platform;
  }

  public function getPattern(){
    return $this->pattern;
  }
} 
?> 
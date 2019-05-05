<?php
declare(strict_types=1);

class clientInfo {
  const UNKNOWN = 'Unknown';

  private $uagent = '';
  private $bname = self::UNKNOWN;
  private $bversion = self::UNKNOWN;
  private $platform = self::UNKNOWN;
  private $pattern = '';
  private $sname = '';

  public function clientInfo($userAgent) { 
    $this->uagent = $userAgent;
    if(strlen($this->uagent)>0){
      $this->readPlatform();
      $this->readName();
      $this->readBrowserVersion();
    }
  }
  
  private function readPlatform(): void {
    if (preg_match('/Android/i', $this->uagent)) {
      $this->platform = $this->readAndroidVersion();  
    }elseif(preg_match('/linux/i', $this->uagent)) {
      $this->platform = 'Linux' . ' (' . $this->readLinuxCpuLength() . ')';;
    }elseif (preg_match('/macintosh|mac os x/i', $this->uagent)) {
      $this->platform = $this->readMacVersion();
    }elseif (preg_match('/iPhone OS/i', $this->uagent)) {
      $this->platform = $this->readMacVersion();      
    }elseif (preg_match('/iPad/i', $this->uagent)) {
      $this->platform = $this->readMacVersion();
    }elseif (preg_match('/Windows Phone/i', $this->uagent)) {
      $this->platform = 'Windows Phone';
    }elseif (preg_match('/windows|win32/i', $this->uagent)) {
      $this->platform = $this->readWindowsVersion();
    }
  }

  private function readWindowsVersion(): string {
    $winVer = '';
    if (strpos($this->uagent, 'Windows 95') !== false) {
      $winVer = 'Windows 95';
    }elseif (strpos($this->uagent, 'Win95') !== false) {
      $winVer = 'Windows 95';
    }elseif (strpos($this->uagent, 'Windows_95') !== false) {
      $winVer = 'Windows 95';
    }elseif (strpos($this->uagent, 'Windows 98') !== false) {
      $winVer = 'Windows 98';
    }elseif (strpos($this->uagent, 'Win98') !== false) {
      $winVer = 'Windows 98';
    }elseif (strpos($this->uagent, 'Windows NT 5.0') !== false) {
      $winVer = 'Windows 2000';
    }elseif (strpos($this->uagent, 'Windows 2000') !== false) {
      $winVer = 'Windows 2000';
    }elseif (strpos($this->uagent, 'Windows NT 5.1') !== false) {
      $winVer = 'Windows XP';
    }elseif (strpos($this->uagent, 'Windows XP') !== false) {
      $winVer = 'Windows XP';
    }elseif (strpos($this->uagent, 'Windows NT 5.2') !== false) {
      $winVer = 'Windows Server 2003';
    }elseif (strpos($this->uagent, 'Windows NT 6.0') !== false) {
      $winVer = 'Windows Vista';
    }elseif (strpos($this->uagent, 'Windows NT 6.1') !== false) {
      $winVer = 'Windows 7';
    }elseif (strpos($this->uagent, 'Windows NT 6.2') !== false) {
      $winVer = 'Windows 8';
    }elseif (strpos($this->uagent, 'Windows NT 10.0') !== false) {
      $winVer = 'Windows 10';
    }elseif (strpos($this->uagent, 'Windows ME') !== false) {
      $winVer = 'Windows ME';
    }elseif (strpos($this->uagent, 'Windows NT 4.0') !== false) {
      $winVer = 'Windows NT 4.0';
    }elseif (strpos($this->uagent, 'WinNT4.0') !== false) {
      $winVer = 'Windows NT 4.0';
    }elseif (strpos($this->uagent, 'WinNT') !== false) {
      $winVer = 'Windows NT 4.0';
    }elseif (strpos($this->uagent, 'Windows NT') !== false) {
      $winVer = 'Windows NT 4.0';
    }elseif (strpos($this->uagent, 'WinNT') !== false) {
      $winVer = 'Windows NT 4.0';
    }elseif (strpos($this->uagent, 'WinNT') !== false) {
      $winVer = 'Windows NT 4.0';
    }elseif (strpos($this->uagent, 'WinNT') !== false) {
      $winVer = 'Windows NT 4.0';
    }

    return $winVer . ' (' . $this->readWindowsCpuLength() . ')';
  }

  private function readWindowsCpuLength(): string {
    if (strpos($this->uagent,"WOW64") == true ||
      strpos($this->uagent,"Win64") == true ||
      strpos($this->uagent,"x86_64") == true ||
      strpos($this->uagent,"x86-64") == true ||
      strpos($this->uagent,"x64;") == true ||
      strpos($this->uagent,"amd64") == true ||
      strpos($this->uagent,"AMD64") == true ||
      strpos($this->uagent,"amd64") == true) {
      return "64-bit";
    }
    return "32-bit";
  }

  private function readLinuxCpuLength(): string {
    if (strpos($this->uagent,"x86_64")) {
      return "64-bit";
    }
    return "32-bit";
  }

  private function readAndroidVersion(): string {
    preg_match('/Android (\d+(?:\.\d+)+)[;)]/', $this->uagent, $matches);
    return 'Android v' . $matches[1] . ' (' .  
      $this->androidCodeName(substr($matches[1],0,1),substr($matches[1],2,1)) . ')';  
  }

  private function readMacVersion(): string {
    preg_match('/\((.*?)\)/', $this->uagent, $matches);
    $ver = str_replace('CPU ', '', $matches[1]);
    $ver = str_replace('_', '.', $ver);
    return $ver; 
  }

  private function androidCodeName(string $vMajor, string $vMinor): string {
    if ($vMajor == '2') {
      if($vMinor == '0' || $vMinor == '1') {
        return 'Eclair';
      }elseif($vMinor == '3') {
        return 'Gingerbread';
      }
    }elseif ($vMajor == '3') {
      return 'Honeycomb';
    }elseif ($vMajor == '4') {
      if($vMinor == '0') {
        return 'Ice Cream Sandwich';
      }elseif($vMinor == '4') {
        return 'KitKat';
      }else{
        return 'Jelly Bean';
      }
    }elseif ($vMajor == '5') {
      return 'Lollipop';
    }elseif ($vMajor == '6') {
      return 'Marshmallow';
    }elseif ($vMajor == '7') {
      return 'Nougat';
    }elseif ($vMajor == '8') {
      return 'Oreo';
    }elseif ($vMajor == '9') {
      return 'Pie';
    }elseif ($vMajor == '10') {
      return 'Q';
    }
    return '?';
  }

  private function readName(): void {
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
    }elseif(preg_match('/SamsungBrowser/i',$uagent)){
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
      $this->sname = "Trident";
    }elseif(preg_match('/Lynx/i',$uagent)){
      $this->bname = 'Lynx';
      $this->sname = "Lynx";
    }elseif(preg_match('/w3m/i',$uagent)){
      $this->bname = 'W3M';
      $this->sname = "w3m";
    }elseif(preg_match('/Opera/i',$uagent)){
      $this->bname = 'Opera';
      $this->sname = "Opera";
    }
    
    if (strpos($uagent, 'curl') !== false) {
      $this->bname = 'Curl';
      $this->sname = 'curl';
    }
  }

  private function readBrowserVersion(): void {
    $known = array('Version', $this->sname, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

    preg_match_all($pattern, $this->uagent, $matches);
    $i = count($matches['browser']);
    
    if ($i != 1) {
      if (strripos($this->uagent,"Version") < strripos($this->uagent,$this->sname)){
        $this->bversion = $matches['version'][0];
      }else {
        $this->bversion = $matches['version'][1];
      }
    }else {
      $this->bversion = $matches['version'][0];
    }

    if ($this->bversion==null) {
      $this->bversion=self::UNKNOWN;
    }
    else {
      $this->bversion = 'v' . $this->bversion;
    }
  }

  public function getUserAgent(): string {
    return $this->uagent;
  }

  public function getName(): string {
    return $this->bname;
  }

  public function getBrowserVersion(): string {
    return $this->bversion;
  }

  public function getPlatform(): string {
    return $this->platform;
  }

  public function getPattern(): string {
    return $this->pattern;
  }
} 
?> 

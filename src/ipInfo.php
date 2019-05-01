<?php
declare(strict_types=1);

class ipInfo {
  private $ipaddress = '';
  private $city = '';
  private $country = '';
  private $isp = '';
  private $org = '';
  private $as = '';

  public function IpInfo() { 
    $this->ipaddress = $this->getClientIp();
    $this->ipLocationIspInfo($this->ipaddress);
  }
  
  private function getClientIp() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
      $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
      $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
      $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
      $ipaddress = getenv('REMOTE_ADDR');
    else
      $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }

  private function ipLocationIspInfo($ip) {
    $ipdat = @json_decode(file_get_contents("http://ip-api.com/json/" . $ip));
    
    $this->city = @$ipdat->city;
    $this->country = @$ipdat->country;
    $this->isp = @$ipdat->isp;
    $this->org = @$ipdat->org;
    $this->as = @$ipdat->as;
  }

  public function getIpAddress(){
    return $this->ipaddress;
  }

  public function getCity(){
    return $this->city;
  }

  public function getCountry(){
    return $this->country;
  }

  public function getIsp(){
    return $this->isp;
  }

  public function getOrganisation(){
    return $this->org;
  }

  public function getAs(){
    return $this->as;
  }

  public function getLocation(){
    $location = '';
    if(strlen($this->city) > 0){
      $location = $this->city;
    }
    if(strlen($this->country) > 0 ){
      if(strlen($location) > 0){
        $location = $location . ', ';
      }
      $location = $location .  $this->country;
    }
    return $location;
  }
} 
?> 

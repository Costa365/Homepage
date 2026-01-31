<?php
declare(strict_types=1);

class ipInfo {
  private $ipaddress = '';
  private $city = '';
  private $country = '';
  private $isp = '';
  private $org = '';
  private $as = '';

  public function __construct(string $ip){
    if(strlen($ip) > 0){
      $this->ipaddress = $ip; 
    } else {
      $this->ipaddress = $this->getClientIp();
    }
    
    $this->ipLocationIspInfo($this->ipaddress);
  }
  
  private function getClientIp(): string {
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

  private function ipLocationIspInfo(string $ip): void {
    $ipdat = @json_decode(file_get_contents("http://ip-api.com/json/" . $ip));
    
    $this->city = (string)@$ipdat->city;
    $this->country = (string)@$ipdat->country;
    $this->isp = (string)@$ipdat->isp;
    $this->org = (string)@$ipdat->org;
    $this->as = (string)@$ipdat->as;
  }

  public function getIpAddress(): string {
    return $this->ipaddress;
  }

  public function getCity(): string {
    return $this->city;
  }

  public function getCountry(): string {
    return $this->country;
  }

  public function getIsp(): string {
    return $this->isp;
  }

  public function getOrganisation(): string {
    return $this->org;
  }

  public function getAs(): string {
    return $this->as;
  }

  public function getLocation(): string {
    $location = '';
    if(!is_null($this->city) && strlen($this->city) > 0){
      $location = $this->city;
    }
    if(!is_null($this->country) && strlen($this->country) > 0 ){
      if(strlen($location) > 0){
        $location = $location . ', ';
      }
      $location = $location .  $this->country;
    }
    return $location;
  }
} 
?> 

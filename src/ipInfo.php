<?php
class ipInfo {
  
  private $ipaddress = '';
  private $city = '';
  private $country = '';

  public function IpInfo() { 
    $this->ipaddress = $this->getClientIp();
    $this->city = $this->ipLocation($this->ipaddress, "City");
    $this->country = $this->ipLocation($this->ipaddress, "Country");
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

  private function ipLocation($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
      $ip = $_SERVER["REMOTE_ADDR"];
      if ($deep_detect) {
        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
          $ip = $_SERVER['HTTP_CLIENT_IP'];
      }
    }
    $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support = array("country", "city");
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
      $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
      if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
        switch ($purpose) {
          case "city":
            $output = @$ipdat->geoplugin_city;
            break;
          case "country":
            $output = @$ipdat->geoplugin_countryName;
            break;
        }
      }
    }
    return $output;
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

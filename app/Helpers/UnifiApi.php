<?php 

namespace App\Helpers;
/**
* 
*/
class UnifiApi
{ 
  public $user = '';
  public $password = '';
  public $site         = 'default';
  public $baseurl      = 'https://127.0.0.1:8443';
  public $version      = '0.1';
  public $is_loggedin  = false;
  private $cookies     = '/tmp/unifi_browser';
  public $debug        = false;

  function __construct($user = '', $password = '', $baseurl = '', $site = '', $version = '') {      
    if (!empty($user)) $this->user          = $user;
    if (!empty($password)) $this->password  = $password;
    if (!empty($baseurl)) $this->baseurl    = $baseurl;
    if (!empty($site)) $this->site          = $site;
    if (!empty($cookies)) $this->cookies          = $cookies;

  }

  public function login($ap,$minutes,$up=NULL,$down=NULL,$MBytes=NULL) {
    
    $ch = curl_init();
    // Return output instead of displaying it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    // We are posting data
    curl_setopt($ch, CURLOPT_POST, TRUE);
    // Set up cookies
    curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
    // Allow Self Signed Certs
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSLVERSION, 1);
    // Login to the UniFi controller
    curl_setopt($ch, CURLOPT_URL, $this->baseurl."/api/login");

    $data = json_encode(array("username" => $this->user,"password" => $this->password));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_exec($ch);

    // Send user to authorize and the time allowed
    $authorize_array  = array('cmd' => 'authorize-guest', 'mac' => $ap, 'minutes' => $minutes);
    if (isset($up)) $authorize_array['up'] = $up;
    if (isset($down)) $authorize_array['down'] = $down;
    if (isset($MBytes)) $authorize_array['bytes'] = $MBytes;
    $json = json_encode($authorize_array);

    // Make the API Call
    curl_setopt($ch, CURLOPT_URL, $this->baseurl.'/api/s/'.$this->site.'/cmd/stamgr');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'json='.$json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
    // Logout of the connection
    //curl_setopt($ch, CURLOPT_URL, $this->baseurl."/logout");
        if(($content = curl_exec($ch)) === false) {
           error_log('curl error: ' . curl_error($ch));
        }  
    curl_close ($ch);
    return true;  
  }

  public function logout()
  {
    $ch = curl_init();
    // Return output instead of displaying it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    // We are posting data
    curl_setopt($ch, CURLOPT_POST, TRUE);
    // Set up cookies
    curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
    // Allow Self Signed Certs
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSLVERSION, 1);
    // Logout of the connection
    curl_setopt($ch, CURLOPT_URL, $this->baseurl."/logout");
        if(($content = curl_exec($ch)) === false) {
           error_log('curl error: ' . curl_error($ch));
        }  
    curl_close ($ch);
  }
}
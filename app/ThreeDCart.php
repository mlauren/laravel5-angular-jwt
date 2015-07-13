<?php

class ThreeDCartAPI {

  protected $client;
  protected $headerishere;

  public function __construct() {
    //set up form vars here
    $secureUrl    = 'devstandishsalongoods.3dcartstores.com';
    $privateKey  = '956fbc1ac55b0d40d215e7bc441094fa';
    $token       = '237326bd3029cfa111e2169842bf76bb';

    $this->headershere = [
      'SecureUrl' => $secureUrl,
      'PrivateKey' => $privateKey,
      'Token' => $token,
      'Content-Type' => 'application/json; charset=utf-8',
      'Accept' => 'application/json'
    ];
    $client = new GuzzleHttp\Client();
    $res = $client->get('https://apirest.3dcart.com/3dCartWebAPI/v1/', ['header' => headershere]);
    return $res->getStatusCode();
    
  }

}


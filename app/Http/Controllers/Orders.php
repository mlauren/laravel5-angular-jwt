<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Orders extends Controller {
    
    public function get() {
        $secureUrl    = 'devstandishsalongoods.3dcartstores.com';
        $privateKey  = '956fbc1ac55b0d40d215e7bc441094fa';
        $token       = '237326bd3029cfa111e2169842bf76bb';

        $ch = curl_init('https://apirest.3dcart.com/3dCartWebAPI/v1/Customers');
        $httpHeader = array(
          'Content-Type: application/json;charset=UTF-8',
          'Accept: application/json',
          'SecureUrl: ' . $secureUrl,
          'PrivateKey: ' . $privateKey,
          'Token: ' . $token,
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        $response = curl_exec($ch);
        if ($response === false) {
            $response = curl_error($ch);
        }
        curl_close($ch);
    }

}
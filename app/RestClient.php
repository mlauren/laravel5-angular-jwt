<?php

namespace RestDoc\HttpClient;

class RestClient 
{
	
	private $url;
	private $secureUrl;
	private $privateKey;
	private $token;
	private $httpHeaders;
	private $contentType;
	
	/**
	 * 
	 * @param int $version
	 * @param string $secureUrl
	 * @param string $privateKey
	 * @param string $token
	 * @param string $contentType
	 */
	function __construct($version, $secureUrl, $privateKey, $token, $contentType = 'json') 
	{
		$this->url         = 'https://apirest.3dcart.com/3dCartWebAPI/v' . $version . '/';
		$this->secureUrl   = $secureUrl;
		$this->privateKey  = $privateKey;
		$this->token       = $token;
		$this->contentType = $contentType;
		$this->httpHeaders = array(
				'SecureUrl: ' . $this->secureUrl,
				'PrivateKey: ' . $this->privateKey,
				'Token: ' . $this->token,
		);
		if ($this->contentType === 'xml') {
			array_push($this->httpHeaders, 'Content-Type: application/xml; charset=utf-8');
			array_push($this->httpHeaders, 'Accept: application/xml');
		} else {
			array_push($this->httpHeaders, 'Content-Type: application/json; charset=utf-8');
			array_push($this->httpHeaders, 'Accept: application/json');
		}
	}
	
	/**
	 * Retreives a single customer by the contactid ($id), or list of customers filtered with query parameters ($params). 
	 * Set the $groupId argument to a customer group id to filter results within a specific customer group. Maximum
	 * number of records per request is 300.
	 * @param int $id
	 * @param array $params
	 * @param int $groupId
	 * @return <mixed, string>
	 */
	public function getCustomers($id = null, $params = null, $groupId = null) 
	{
		if ($groupId !== null) {
			$this->url .= 'CustomerGroups/' . $groupId . '/Customers';
			if ($params !== null) {
				$this->url .= '?' . http_build_query($params);
			}
		} else {
			$this->url .= 'Customers';
			if ($id !== null) {
				$this->url .= '/' . $id;
			}
			if ($params !== null) {
				$this->url .= '?' . http_build_query($params);
			}
		}
		$ch = curl_init($this->url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->httpHeader);

		// [ ... addtional cURL options as needed ... ]
		
		$response = curl_exec($ch);
		if ($response === false) {
			$response = curl_error($ch);
		}
		curl_close($ch);
		return $response;
	}
}

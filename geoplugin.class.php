<?php
/*This PHP class uses the PHP Webservice of http://www.geoplugin.com/ to geolocate IP addresses
Geographical location of the IP address (visitor) and locate currency (symbol, code and exchange rate) are returned.
See http://www.geoplugin.com/webservices/php for more specific details of this free service
*/
class geoPlugin
{
	//the geoPlugin server
	var $host = 'http://www.geoplugin.net/php.gp?ip={IP}&lang={LANG}';
	//the default language
	var $lang = 'es';
	var $ip = null;
	var $city = null;
	var $countryCode = null;
	var $countryName = null;
	var $continentCode = null;
	function __construct()
	{
	}
	function locate($ip = null)
	{
		global $_SERVER;
		if (is_null($ip)) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		$host = str_replace('{IP}', $ip, $this->host);
		$host = str_replace('{LANG}', $this->lang, $host);
		$data = array();
		$response = $this->fetch($host);
		if (empty($response)) {
			$this->ip = '127.0.0.1';
			$this->city = 'Madrid';
			$this->countryCode = 'ES';
			$this->countryName = 'España';
			$this->continentCode = 'EU';
		} else {
			$data = unserialize($response);
			$this->ip = $ip;
			$this->city = $data['geoplugin_city'];
			$this->countryCode = $data['geoplugin_countryCode'];
			$this->countryName = $data['geoplugin_countryName'];
			$this->continentCode = $data['geoplugin_continentCode'];
		}
	}
	function fetch($host)
	{
		if (function_exists('curl_init')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.1');
			$response = curl_exec($ch);
			curl_close($ch);
		} else if (ini_get('allow_url_fopen')) {
			$response = file_get_contents($host, 'r');
		} else {
			trigger_error('Error: No se puede obtener datos.', E_USER_ERROR);
			return;
		}
		return $response;
	}
}

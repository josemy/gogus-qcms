<?php
   if (getenv(HTTP_X_FORWARDED_FOR)) {
        $pipaddress = getenv(HTTP_X_FORWARDED_FOR);
        $ipaddress = getenv(REMOTE_ADDR);
echo "Your Proxy IPaddress is : ".$pipaddress. "(via $ipaddress)" ;
    } else {
        $ipaddress = getenv(REMOTE_ADDR);
       
    }
	$ip=$ipaddress;
	
    function get_ip_location($ip, $format="xml") {
        $formats_allowed = array("json", "xml", "raw");
        $query_url = "http://ipinfodb.com/ip_query.php?ip=";
        if(!in_array($format, $formats_allowed)) {
            $format = "xml";
        }
        $query_url = $query_url . "{$ip}&output={$format}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $query_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $xmlData=curl_exec($ch);
		
		if (empty($xmlData))
			throw new Exception('Error retrieving xml');

		$locationInfo = parseLocationData($xmlData);
		
		return $locationInfo;
		
    }
	
	
	function parseLocationData($xmlData)
	{
		// Use of Simple XML extension of PHP 5
		$xml = simplexml_load_string($xmlData);

		if (!is_object($xml))
		    throw new Exception('Error reading XML');
		
	
		$city = $xml->xpath('//City');
		$latitude = $xml->xpath('//Latitude');
		$longitude = $xml->xpath('//Longitude');
	
			
		
		$info = array (
			"City"  			=> (string) $city[0],
	"Latitude"  			=> (string) $latitude[0],
	"Longitude"  			=> (string) $longitude[0],
		);
		
		return $info;
	}
	
	
	?>
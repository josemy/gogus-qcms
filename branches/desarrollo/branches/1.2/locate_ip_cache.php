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
					$query_url = "http://backup.ipinfodb.com/ip_query.php?ip=";
					
			
			
					if(!in_array($format, $formats_allowed)) {
						$format = "xml";
					}
					$query_url = $query_url . "{$ip}&output={$format}";
								$chtime = "0"; //hours
								$timeout = "10"; //secconds
								$localfile = preg_replace("/[^A-Za-z0-9_\.]/", "_", $query_url);
								$localfile="cache/".$localfile.".xml";
					
			if (file_exists($localfile)){
					   
							$localfile_stat = stat($localfile);
							if ($localfile_stat['mtime'] < strtotime("-$chtime hours")){
						   
						$chresponse = @curl_init($query_url);
						$ret = @curl_setopt($chresponse, CURLOPT_HEADER, 1);
						$ret = @curl_setopt($chresponse, CURLOPT_FOLLOWLOCATION, 1);
						$ret = @curl_setopt($chresponse, CURLOPT_TIMEOUT,        $timeout);
						$ret = @curl_setopt($chresponse, CURLOPT_RETURNTRANSFER, 1);
						$ret = @curl_exec($chresponse);
			
								if (empty($ret)) {
										die(@curl_error($chresponse));
										@curl_close($chresponse);
								} else {
									$info = @curl_getinfo($chresponse);
									@curl_close($chresponse);
											if ($info['http_code'] == "200") {
											   
														$ch = @curl_init($query_url);
												$fp = fopen($localfile, "w");
							
												@curl_setopt($ch, CURLOPT_FILE, $fp);
												@curl_setopt($ch, CURLOPT_HEADER, 0);
												@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
												@curl_exec($ch);
												@curl_close($ch);
												fclose($fp);            
												}else{
													touch($localfile);
												}
								}
					}
			}else{
				$ch = @curl_init($query_url);
				$fp = fopen($localfile, "w");
				@curl_setopt($ch, CURLOPT_FILE, $fp);
				@curl_setopt($ch, CURLOPT_HEADER, 0);
				@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				@curl_exec($ch);
				@curl_close($ch);
				fclose($fp);    
			}
	
		
				if ($d = fopen($localfile, "r")) {
		//Prueba de rendimiento, se baja el valor del fread a 50, ya que no necesita leer mas
        //$gcsv = @fread($d, 30000);
		
		$xmlData = fread($d, 500);
        fclose($d);
				}
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
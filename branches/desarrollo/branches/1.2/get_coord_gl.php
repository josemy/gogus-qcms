<?php
   if (getenv(HTTP_X_FORWARDED_FOR)) {
        $pipaddress = getenv(HTTP_X_FORWARDED_FOR);
        $ipaddress = getenv(REMOTE_ADDR);
echo "Your Proxy IPaddress is : ".$pipaddress. "(via $ipaddress)" ;
    } else {
        $ipaddress = getenv(REMOTE_ADDR);
       
    }
	$ip=$ipaddress;
	
    function ver_citt($pat) {
					$formats_allowed = array("json", "xml", "raw");
					$GoogleMapsApiKey = 'ABQIAAAAsfZ3WhPrjeePQbQ_0RWTRBTIu1KiFe28F4Nw1cnpSoAJjSwXMBR-1y-kGIMTRpZ6_A71qPiaPPz16g';
					$patr=rawurlencode($pat);
					$query_url = "http://maps.google.com/maps/geo?q=$patr&oe=utf8&output=xml&sensor=false&gl=es&key=$GoogleMapsApiKey";
					
			
			
					if(!in_array($format, $formats_allowed)) {
						$format = "xml";
					}
					
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
		
		$xmlData = fread($d, 10000);
        fclose($d);
				}
		if (empty($xmlData))
			throw new Exception('Error retrieving xml');

		$locationInfo = parseLocationData3($xmlData);
		
		return $locationInfo;
		
    }
	
	
	function parseLocationData3($xmlData)
	{
		// Use of Simple XML extension of PHP 5
		$xml = simplexml_load_string($xmlData);

		if (!is_object($xml))
		    throw new Exception('Error reading XML');
		
	
		//$city = $xml->xpath('//kml/Response/Placemark   id="p1"/AddressDetails/Country/AdministrativeArea/SubAdministrativeArea/Locality');
$res=$xml->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->LocalityName;
$ges=$xml->Response->Placemark->Point->coordinates;

				$info = array (
			"LocalityNamee"  			=> (string) $res,
			"coordinates"  			=> (string) $ges,

		);
		return $info;
	}
	
	
	?>
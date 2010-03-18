<?
    $myAppToken = 'f5cc1c33e072cf290b40ed2e97ea7638';
    $secret = '6f2f47bb930373fc2e77a8acc1a49d13';
    $generatedAuthSign = md5($myAppToken.$secret);
	
echo($generatedAuthSign);
?>
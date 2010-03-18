<?
    $myAppToken = '';
    $secret = '';
    $generatedAuthSign = md5($myAppToken.$secret);
	
echo($generatedAuthSign);
?>
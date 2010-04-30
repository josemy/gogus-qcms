<?php
function postToTwitter($username,$password,$message){

    $host = "http://twitter.com/statuses/update.xml?status=".urlencode(stripslashes(urldecode($message)));

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $host);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);

    $result = curl_exec ($ch); //Ojo, hay un espacio en exec
    $resultArray = curl_getinfo($ch);
    curl_close($ch);
    if($resultArray['http_code'] == "200"){
       // echo "<br />OK! postedo en http://twitter.com/".$username."/<br />";
    } else {
        //echo "<br />Error! ha ocurrido un problema<br />";
    }
}

?>
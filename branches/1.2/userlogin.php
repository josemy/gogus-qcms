<?
error_reporting(0);
session_start();
include("config.php");
$return_url=$_GET['return'];
if (isset($_POST['submit'])){
  $username=$_POST['userpost'];   //Get the username the user has entered
  $username=strtolower($username); //fuerza a minusculas
  $password=$_POST['clavepost']; //Get the password the user has entered
  $password=md5($password.$mdkey); //turn the password they entered into md5 to compare with the DB
  $loginname=$_SESSION['userpost'];
  //if username was entered, continue
  if($username && $password){
      $result=mysql_query($sql);
      //If the user gets to here, then they have typed both a username and password, so we may now go onto finding out if they excist in the DB
      $sql="SELECT * FROM usuarios WHERE (username='$username') AND password='$password'"; //get rows where the username feild matches the username or email feild in the database with same password
      $result=mysql_query($sql);
      //check to see if the account is activated
      $moorow=mysql_fetch_array($result);
	  
	  if ($moorow['active'] == "no"){
	  //si la cuenta no esta activa
	  printf("<script>document.location.href='index.php?action=info&item=acterror'</script>");

	  }
      if ($moorow['active'] == "yes"){
      //if there was a row returned, then obiously there is an account with the correct username/password. They may login!
			if (mysql_num_rows($result) > 0){
			$_SESSION['loggedin']="TRUE"; //set the global session varible for loggedin to true
			$row=mysql_fetch_array($result);
			$sitio=$moorow['direccion'];

					if($sitio){
						$location["CountryCode"]="ES";
						include('get_coord_gl.php');
						$ver_city = ver_citt($sitio);
						$city=$ver_city["LocalityNamee"];
						$precoord=$ver_city["coordinates"];
						$tsp = explode(",", $precoord);
						$new_lat=$tsp[1];
						$new_long=$tsp[0];

						$location['City']=$city;
						$location["Longitude"]=$new_long;
						$location["Latitude"]=$new_lat;
						$_SESSION['Longitude']=$location["Longitude"];
						$_SESSION['Latitude']=$location["Latitude"];
						//echo($new_lat);
						//echo($new_long);
						//echo($sitio);
							if($new_lat==''){
								include("logerror.php");	
							}else{
								$haydirec=true;
							}
					}
			$_SESSION['username']=$username;
			//registro de ip al logarse
			$ip=$_SERVER['REMOTE_ADDR'];
			//
			if ($moorow['changepwd'] == "yes"){
	printf("<script>llamarasincrono('changepass.php','contenido');</script>");
			}else{
	printf("<script>llamarasincrono('main.php','contenido');</script>");
			}
			//header('location: main.php');
			//printf("<script language='JavaScript' type='text/JavaScript'>document.location.href='main.php'
			$verlas=mysql_query("SELECT * FROM lastlogon WHERE username = '$username'");
			while($verlast=mysql_fetch_array($verlas)){
			$lastime=$verlast['last'];
			$lastip=$verlast['ip'];
			$_SESSION['last']=$lastime;
			$_SESSION['ip']=$lastip;
			
			}
			
			 $hoy = date("y.m.d"); 
				$fecha =  $hoy;
				$times=time();
			mysql_query("INSERT INTO `lastlogon` ( `username` , `last` , `ip` ) VALUES ('$username', '$fecha' , '$ip') ON DUPLICATE KEY UPDATE  last='$fecha', ip='$ip';");
			//registro de sesiones
			date_default_timezone_set('UTC');
				$hora=date('h:i:s A');
			mysql_query("INSERT INTO `sesiones` ( `username` , `time` , `timestamp`) VALUES ('$username', '$hora', '$times') ON DUPLICATE KEY UPDATE  time='$hora' , timestamp='$times';");
			

			//registro de sesiones
//recordar contraseña
			if (isset($_POST['recordar'])){
			$usercode=$moorow['unique'];
			$_SESSION['createcookie']=true;
			$_SESSION['unique']=$usercode;
					}			
//fin recordar contraseña
			
			//die("");
			
			
			}else{
		   // die("Incorrect Login!");
			}
        }else{
				$_SESSION['e']="1";
	include("logerror.php");
				printf("<script>document.location.href='index.php?action=info&item=passerror'</script>");

       
        }
  }else{
	  	$_SESSION['e']="1";
	include("logerror.php");
 printf("<script>document.location.href='index.php?action=info&item=passerror'</script>");

  }
}
$urlback=$_SESSION['product_back'];
if ($username){
	$motivo='inicio de sesion';
mysql_query("INSERT INTO `logs` ( `id` , `motivo` , `username` , `timestamp` ,`ip` ) VALUES ('' , '$motivo' , '$username', '$times' , '$ip')");
	if(!$return_url){
	printf("<script>document.location.href='/".$quecomespath."'</script>");
}else{
	printf("<script>document.location.href='".$return_url."'</script>");
	}
}

?>
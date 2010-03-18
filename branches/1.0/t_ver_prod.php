<?
//$idd=$_GET['pid'];
$verpid=mysql_query("SELECT * FROM products WHERE products_id = '$idd'");

while ($pid_c=mysql_fetch_array($verpid)){
			$gis=$cat_name['products_idd'];
			$foto_ruta=$pid_c['products_image'];
			$precio=$pid_c['products_price'];
			$precio=round($precio,2);
			$geta=mysql_query("SELECT * FROM products_description WHERE products_id = '$idd'");
								while ($m_get=mysql_fetch_array($geta)){
													$prod_n=$m_get['products_name'];
													$descrip=$m_get['products_description'];
								}
						
}
  $vercname=mysql_query("SELECT * FROM products_to_categories WHERE products_id = '$idd'");
                          while ($catc=mysql_fetch_array($vercname)){
							$cid=$catc['categories_id'];
						    }
  $vercc=mysql_query("SELECT * FROM categories_description WHERE categories_id = '$cid'");
                          while ($catn=mysql_fetch_array($vercc)){
							$cname=$catn['categories_name'];
						    }							
?>                 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin título</title>
</head>

<body>
<div align="right">><? echo($cname); ?>&nbspc; </div>
<table width="100%" border="0" cellpadding="4" cellspacing="4">

  <tr>
  	 <td width="100" rowspan="2" align="left" valign="top" class="textonormal"><img src="resize_image.php?image=<? echo($foto_ruta); ?>&new_width=100&new_height=100" alt="" /><br />
click en la foto<br />
<br />
<br /><? print_r($precio." "); ?><br />
<img src="alcarrito.PNG" alt="" onclick="document.location.href='carrito_add.php?item=<? echo($idd); ?>&cantidad=1'"  /></td>
  	    <td class="textonormal" valign="top"><? echo($prod_n); ?></td>
   
    
  </tr>
    <tr>
<td valign="top" class="textonormal"><? echo($descrip); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td></td>
  </tr>
</table>
</body>
</html>
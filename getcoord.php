<?php
session_start();
/**
* Google Maps HTTP Request 1.0
*
* Copyright (C) 2007 Özgür Karatag <oezguer@karatag.de>
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA
*
* @class        googleRequest
* @version      V1.0 04 April 2007
* @author       Özgür Karatag <oezguer@karatag.de>
* @copyright    2007 Özgür Karatag
*/

class googleRequest {

  /**
   * @var string gKey
   * @access private
   */
  var $gKey;

  /**
   * @var int code
   * @access private
   */
  var $code;

  /**
   * @var int Accuracy
   * @access private
   */
  var $Accuracy;

  /**
   * @var float latitude
   * @access private
   */
  var $latitude;

  /**
   * @var float longitude
   * @access private
   */
  var $longitude;

  /**
   * @var string address
   * @access private
   */
  var $address;

  /**
   * @var string city
   * @access private
   */
  var $city;

  /**
   * @var string country
   * @access private
   */
  var $country;

  /**
   * @var string error
   * @access private
   */
  var $error;

  /**
  * @constructor
  * @param string address
  * @param string city
  * @param string country
  * @param string zip
  * @author Özgür Karatag
  * @description Constructor
  */
  function googleRequest($address = '', $city = '', $country = '', $zip = '') {

    if (strlen($address) > 0 && strlen($city) > 0 && strlen($country) > 0 && strlen($zip) > 0) {
      $this->setcode($address, $city, $country, $zip);
    }
  }

  /**
  * @function setcode
  * @param string address
  * @param string city
  * @param string country
  * @param string zip
  * @author Özgür Karatag
  * @description Sets the value
  */
  function setcode($address = '', $city = '', $country = '', $zip = '') {
    $this->address = $address;
    $this->city    = $city;
    $this->country = $country;
    $this->zip     = $zip;
  }

  function setGoogleKey($value) {
    $this->gKey = $value;
  }

  /**
  * @function GetRequest
  * @author Özgür Karatag
  * @description Gets the CSV-File of Google
  */
  function GetRequest() {
//Solucionada: Issue 4, modificada direccion contra google geo. &gl=es

    if (strlen($this->gKey) > 1) {
     //$q = str_replace(' ', '_', $this->address.','.$this->zip.'+'.$this->city.','.$this->country);
	 $q = $this->city;
	  
      //if ($d = @fopen("http://maps.google.com/maps/geo?q=$q&output=csv&key=".$this->gKey, "r")) {
		if ($d = @fopen("http://maps.google.com/maps/geo?q=$q&oe=utf8&sensor=false&gl=es&output=csv&key=".$this->gKey, "r")) {
        $gcsv = @fread($d, 30000);
        @fclose($d);
        //echo "<br />CSV:".$gcsv;
        $tmp = explode(",", $gcsv);
        //print_r($tmp);
        $this->code      = $tmp[0];
        $this->Accuracy  = $tmp[1];
        $this->latitude  = $tmp[2];
        $this->longitude = $tmp[3];

		
      } else {
        $error = "NO_CONNECTION" ;
      }
    } else {
      $error = "No Google Maps Api Key" ;
    }
  }

  /*
  * @function     getVar
  * @returns      mixed
  * @param        $name
  * @author       Özgür Karatag
  * @description  Gets the value of $name
  */
  function getVar($name)
  {
	return $this->{$name};
  }
}
?>
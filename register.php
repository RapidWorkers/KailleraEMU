<?

/*
 * Kaillera Master Server Emulator in PHP
 *
 * Copyright 2014 Pirate
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

require 'include/geoip.inc';
require 'include/config.php';
require 'include/anti_inject.php'; //basic anti inject(DO NOT USE HTMLSPECIALCHARS IF YOU WANT TO USE ANSI ENCODE)

$servername = $_GET['servername'];
$port = $_GET['port'];
$nbusers = $_GET['nbusers'];
$maxconn = $_GET['maxconn'];
$version = $_GET['version'];
$nbgames = $_GET['nbgames'];
$url = $_GET['url'];


$ip = $_SERVER['REMOTE_ADDR'];
if ($ip == $gatewayip) {
$ip = $realip;	
}

$location = GetLoc($ip);

$getlist = "select ip from masterserver where ip = '$ip';";
$cresult = mysqli_query($conn,$getlist);
$rows = mysqli_num_rows($cresult);

if (!$rows){

if ($stmt = mysqli_prepare($conn, "INSERT INTO masterserver (servername, ip, port, user, maxuser, version, game, location, url)  VALUES(?,?,?,?,?,?,?,?,?)")) {
    mysqli_stmt_bind_param($stmt, "ssiiisiss", $servername,$ip,$port,$nbusers,$maxconn,$version,$nbgames,$location,$url);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

}else{

if ($stmt = mysqli_prepare($conn, "UPDATE masterserver set servername = ?, port = ?, user = ?, maxuser = ?, version = ?, game = ?, url = ?, lastupdate = NOW() where ip = ?")) {
    mysqli_stmt_bind_param($stmt, "siiisiss", $servername,$port,$nbusers,$maxconn,$version,$nbgames,$url,$ip);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

}

mysqli_close();

function GetLoc($ip) {
$gi = geoip_open("include/GeoIP.dat",GEOIP_STANDARD);
return geoip_country_name_by_addr($gi, $ip);
geoip_close($gi);
};

?>
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

require 'include/config.php';
mysqli_query($conn,"CALL cleanList();");

$query = "SELECT * FROM masterserver;";
$result = mysqli_query($conn,$query) or die(mysqli_error());

while($server = mysqli_fetch_array($result)){
$servername = $server['servername'];
$port = $server['port'];
$nbusers = $server['user'];
$maxconn = $server['maxuser'];
$version = $server['version'];
$nbgames = $server['game'];
$url = $server['url'];
$ip = $server['ip'];
$location = $server['location'];

echo "$servername\r\n$ip:$port;$nbusers/$maxconn;$nbgames;$version;$location\r\n";
};

mysqli_close();
?>
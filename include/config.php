<?php

/*
 * Kaillera Master Server Emulator in PHP
 *
 * Copyright 2014 Pirate
 *
 */


$gatewayip = "192.168.0.1"; //If You're Using NAT then Enter Your Gateway ip.
$realip = "0.0.0.0"; //and real ip(External ip).

$dbhost =  "localhost";
$dbid = "root";
$dbpwd = "";
$dbname = "kaillera";

$conn = mysqli_connect($dbhost,$dbid,$dbpwd,$dbname) or die(mysqli_error());
mysqli_query($conn,'set names euckr;'); // Set Your Language Encoding
?>
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
 *
 */
 
$_POST = array_map('strip_tags',$_POST);
$_GET = array_map('strip_tags',$_GET);

//$_POST = array_map('htmlspecialchars',$_POST);
//$_GET = array_map('htmlspecialchars',$_GET);

array_walk($_POST, function(&$string) use ($conn) { 
  $string = mysqli_real_escape_string($conn, $string);
});
array_walk($_GET, function(&$string) use ($conn) { 
  $string = mysqli_real_escape_string($conn, $string);
});
?>
<?php 
$mysqli = new mysqli("148.227.227.7","usuario06","06usuario","usuario06");
if($mysqli->connect_errno){
  echo "Fallo en el establecimiento de la conexión:(" . $mysqli->connect_errno .")" .$mysqli->connect_errno;};  
?>

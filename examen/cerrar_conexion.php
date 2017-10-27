<?php
$mysqli = new mysqli("127.0.0.1","root","","vendimia",3306);
if($mysqli->connect_errno){
  echo "Fallo en el establecimiento de la conexión:(" . $mysqli->connect_errno .")" .$mysqli->connect_errno;};  
mysqli_close($mysqli);
?>
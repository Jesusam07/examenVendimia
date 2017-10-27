<?php
  $idCliente = $_POST['idCliente'];
  echo getRFC($idCliente);

  function getRFC($id){
    if($id == "") {
      exit;
    }
      include ("conexion.php");
      $sql="SELECT RFC FROM cliente WHERE idCliente = ". $id;
      $resulti=mysqli_query($mysqli, $sql);
      $rfc=mysqli_fetch_array($resulti); 
      include ("cerrar_conexion.php");
      echo $rfc['RFC'];
  }
?>
<?php
  $idArticulo = $_POST['idArticulo'];
  echo getModelo($idArticulo);

  function getModelo($id1){
    if($id1 == "") {
      exit;
    }
      include ("conexion.php");
      $sql="SELECT modelo FROM articulo WHERE idArticulo = ". $id1;
      $resulti=mysqli_query($mysqli, $sql);
      $modelo=mysqli_fetch_array($resulti); 
      include ("cerrar_conexion.php");
      echo $modelo['modelo'];
  }
?>
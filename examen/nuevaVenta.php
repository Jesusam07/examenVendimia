<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Ventas</title>
	<meta name="'viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimum-scale=1.0">
	<META name='robot' content='noindex, nofollow'> 

  <link rel="stylesheet" href="css/bootstrap_3.3.6.min.css" /> 
  <link rel="stylesheet" href="css/prism.css" /> 
  <link rel="stylesheet" href="css/chosen.css" /> 
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="estilos.css">
<?php 
date_default_timezone_set('America/Mazatlan');
$fecha_actual = strftime("%d/%m/%Y",time());

include ("conexion.php");
$sql="SELECT COALESCE(MAX(idFolio),0)+1 AS k FROM venta";
$resulti=mysqli_query($mysqli, $sql);
$idfolio=mysqli_fetch_array($resulti); 

$sql="SELECT * FROM cliente";
$resultCliente=mysqli_query($mysqli, $sql); 

$sql="SELECT * FROM articulo";
$resultArt=mysqli_query($mysqli, $sql); 

include ("cerrar_conexion.php");


  function getRFC(){
    if ($this->input->is_ajax_request()) {
      $id = $this->input->post("id");

      include ("conexion.php");
      $sql="SELECT rfc FROM cliente WHERE id = ". $id;
      $resulti=mysqli_query($mysqli, $sql);
      $rfc=mysqli_fetch_array($resulti); 
      include ("cerrar_conexion.php");
      echo $rfc;
    }
  }

  function getModelo(){
    if ($this->input->is_ajax_request()) {
      $id1 = $this->input->post("id1");

      include ("conexion.php");
      $sql="SELECT modelo FROM articulo WHERE idArticulo = ". $id1;
      $result=mysqli_query($mysqli, $sql);
      $modelo=mysqli_fetch_array($result); 
      include ("cerrar_conexion.php");
      echo $modelo;
    }
  }


?>  
	
</head>
<body>

<header>
    <div class="container-fluid">
      <center><h1> Tienda de Muebles "La Vendimia" </h1></center><br>

      <nav width="100%">
        <ul class="nav">
        <li><a href="index.html">Inicio</a>
          <ul>
            <li><a href="venta.php">Ventas</a>
              <ul>
                <li><a href="cliente.php">Clientes</a></li>
                <li><a href="articulo.php">Articulos</a></li>
                <li><a href="config.php">Configuracion</a></li>
              </ul>
            </li> 
          </ul>
        </li>
        <li><a href="acerca.php">Acerca de</a></li>
      </ul>
      </nav>
      
    </div>
  </header>

	<br>
  <div class="title">
    <div class=""><h1>Nuevas Ventas</h1>
      <input disabled="" type="text" name="fecha_actual" value="<?php echo $fecha_actual; ?>">  
      <input disabled="" type="text" name="id_folio" value="<?php echo $idfolio['k']; ?>">
    </div>
  </div><br>

  <form action="" method="POST">
    <div class="row">
      <div class="col-md-4">
        <label>Cliente</label>
        <select id="idCliente"  class="form-control  chosen-select">
            <option value="">Seleccionar</option>
            <?php
                while($row=mysqli_fetch_row($resultCliente)) {
            ?>
                <option value=<?=$row[0]?>><?=$row[1]?> <?=$row[2]?> <?=$row[3]?></option>
            <?php
                }
            ?>
        </select>
      </div>      
      <div class="col-md-4">
        <label>RFC:</label>
        <input type="text" id="rfc" class="form-control" readonly>
      </div>
      <hr color=" #fff" size="100">
    </div>
    <div class="row">
      <div class="col-md-4">
        <label>Articulo</label>
          <select id="idArticulo"  class="form-control  chosen-select">
            <option value="">Seleccionar</option>
            <?php
                while($row=mysqli_fetch_row($resultArt)) {
            ?>
                <option value=<?=$row[0]?>><?=$row[1]?></option>

            <?php
                }
            ?>
        </select> 
      </div>
      <div class="col-md-4">
        <label>Cantidad:</label>
        <input type="number" id="cantidad" class="form-control">
         <input type="text" id="modelo" class="form-control" readonly>
      </div>
      <div class="col-md-2"><br>
        <button type="button" class="btn btn-primary" id="btnAgregarArticulo" onclick="agregarArticulo()"> Agregar </button>
      </div>
      <hr color=" #fff" size="10" >
    </div>    
  </form><br>

  <table class="table table-bordered table-striped" id="tabla-detalles">
    <tr>
      <td> Descripcion </td>
      <td>Modelo</td>
      <td>Cantidad</td>
      <td>Precio</td>
      <td>Importe</td>
      <td>Eliminar</td>
    </tr>
  </table>    


<?php  

echo"
";

?> 
<script src="js/jquery_2.2.0.min.js"></script>
<script src="js/bootstrap_3.3.6.min.js"></script>
<script src="js/chosen.jquery.js"></script>

<script src="js/venta.js"></script>
</body>
</html>
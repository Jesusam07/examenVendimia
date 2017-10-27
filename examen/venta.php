<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Ventas</title>
	<meta name="'viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimum-scale=1.0">
	<META name='robot' content='noindex, nofollow'> 
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="estilos.css">
<?php 
date_default_timezone_set('America/Mazatlan');
$fecha_actual = strftime("%d/%m/%Y",time());
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

	<br><div class="title">
  <div class="col-xs-12 col-sm-6 col-md-10"><h1>Ventas Activas</h1></div>
  <input disabled="" type="text" name="fecha_actual" value="<?php echo $fecha_actual; ?>">
	</div>

	<div class="container">
              <form action="" method="POST">
                      <article class="col-xs-12 col-sm-6 col-md-2">
                           <hr>
                          <div class="container-fluid">
                            <button class="btn btn-primary" type="button"  onclick="location.href = 'venta.php'" >Nueva Venta</button>
                          </div>
                           <hr> 
                      </article> 
<?php  
include "conexion.php";
$sql2="SELECT * FROM venta ORDER BY idFolio";

$result=mysqli_query($mysqli,$sql2);
echo"
<div class=form-group has-success form-inline>
<article class=col-md-12 col-md-offset-0 >
<div class=col-md-1 ><label>Folio Venta </label></div>
<div class=col-md-1 ><label>Clave Cliente</label></div>
<div class=col-md-1 ><label>Nombre</label></div>
<div class=col-md-1 ><label>Total</label></div>
<div class=col-md-2 ><label>Fecha</label></div>
<div class=col-md-1 ><label>Estatus</label></div>
</article>
</div>";

while($row=mysqli_fetch_row($result)){

  echo"
  <div class= has-success form-inline>
  <article class=col-md-12 col-md-offset-0 >
  <div class=col-md-1 ><input value='".$row[0]."' disabled> </input></div> 
  <div class=col-md-1 ><input value='".$row[1]."' disabled> </input></div>
  <div class=col-md-1 ><input value='".$row[2]."' disabled> </input></div>
  <div class=col-md-1 ><input value='".$row[3]."' disabled> </input></div>
  <div class=col-md-1 ><input value='".$row[4]."' disabled> </input></div>
  <div class=col-md-2 ><input value='".$row[5]."' disabled> </input></div>
  </article>
</div>
</section>";
}
include "cerrar_conexion.php";
?> 

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
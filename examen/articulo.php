<!DOCTYPE html>
<html lang="en">
<head> 

	<meta charset="UTF-8">
	<title>Articulos</title>
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
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-10 col-md-6"><h1>Registro de Articulos</h1><input type="text" name="fecha_actual" value="<?php echo $fecha_actual; ?>" readonly></div> 
            <div class="col-xs-12 col-sm-2 col-md-6"></div>                   
          </div>
        <div class="row">
          <form action="" method="POST">
            <div class="col-xs-12 col-sm-2 col-md-2">
              <label>
                <input class="form-control" id="idArticulo"  maxlength='5' onKeypress='if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;' placeholder="ID :"type="text" name="idArticulo"><br>    
              </label>
            </div>
              <div class="col-xs-12 col-sm-10 col-md-10">
                 <article>                
                      <div class="form-group has-success">  
                        <div class="container"> 
                          <button class="btn btn-primary" type="submit" id="btnvalidaId" name="busca" onclick="validaId()">Actualizar Articulo</button>
                          <button class="btn btn-primary" method="POST" type="submit" id="btnvalidaId" name="elimina" onsubmit="return confirmation()" onclick="validaId()">
                          Eliminar Articulo</button>
                          <button class="btn btn-primary" type="button"  onclick="location.href = 'nuevoarticulo.php'" >Nuevo Articulo</button>
                        </div>
                       </div>
                    </article> 
              </div>
          </form>  
        </div>    
      </div>
<?php  


//if (isset($_POST["todos"])){
include "conexion.php";
$sql2="SELECT * FROM articulo ORDER BY idArticulo";

$result=mysqli_query($mysqli,$sql2);
echo"
<div class=form-group has-success form-inline>
<article class=col-md-12 col-md-offset-0 >
<div class=col-md-1 ><label>Clave Articulo </label></div>
<div class=col-md-1 ><label>Descipcion</label></div>
<div class=col-md-1 ><label>Modelo</label></div>
<div class=col-md-1 ><label>Precio</label></div>
<div class=col-md-2 ><label>Existencia</label></div>

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

  </article>
</div>
</section>";
}
include "cerrar_conexion.php";
//}


if (isset($_POST["busca"])){

$idC = $_POST["idArticulo"]; 
if($idC==""){
?>  
  <script type="text/javascript">alert("! Ingrese un ID valido!");</script>
<?php
return;  
}
include('conexion.php');   
    $consulta="select * from articulo where idArticulo=".$idC;
    $resultado=mysqli_query($mysqli, $consulta);
      if (mysqli_num_rows($resultado)>0){
        $query = "select * from articulo where idArticulo = '$idC'"; 
        $result3 = mysqli_query($mysqli,$query); 

        while ($registro = mysqli_fetch_array($result3)){ 

        echo " 
        <body> 

        <div align='center'> 
            <table width='600' id='table1'> 
                <tr> 
                    <td colspan='2'><h3 align='center'>Actualice los datos que considere</h3></td> 
                </tr> 
                <tr> 
                    <td colspan='2'>  <h3 class='text-success'>En los campos del formulario puede ver los valores actuales, <small>si no se cambian los valores se mantienen iguales.</small></h3></td> 
                </tr> 
                <form method='POST' action=''> 
                <tr> 
                    <td width='50%'>&nbsp;</td> 
                    <td width='50%'>&nbsp;</td> 
                </tr> 
                <tr> 
                    <td width='50%'><p align='center'><b>Descripcion:</b></td> 
                    <td width='50%'><p align='center'><input type='text' onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;' name='descripcion' size='20' value='".$registro['descripcion']."'></td> 
                </tr>
                <tr> 
                    <td width='50%'><p align='center'><b>Modelo:</b></td> 
                    <td width='50%'><p align='center'><input type='text' onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;' name='modelo' size='20' value='".$registro['modelo']."'></td> 
                </tr>
                <tr> 

                <tr> 
                    <td width='50%'><p align='center'><b>Precio:</b></td>
                    <td width='50%'><p align='center'><input type='text' maxlength='10' onKeypress='if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;' name='precio' size='20' value='".$registro['precio']."'></td> 
                </tr> 
                <tr> 
                    <td width='50%'><p align='center'><b>Existencias:</b></td> 
                    <td width='50%'><p align='center'><input type='text' maxlength='5' onKeypress='if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;'name='existencia' size='20' value='".$registro['stock']."'></td> 
                </tr>  
                <tr> 
                    <td width='50%'>&nbsp;</td> 
                    <td width='50%'>&nbsp;</td> 
                </tr> 
                <input type='hidden' name='idArticulo' value='$idC'> 
                <tr> 
                    <td width='100%' colspan='2'> 
                    <p align='center'> 
                    <button type='submit' class='btn btn-success center' name='B1'>Actualizar Datos</button></td>

                   </tr>
                </form>
            </table>
        </div> 
        "; 
        } 
        include("cerrar_conexion.php");
         header("location:articulo.php");
      }else{ 
        ?>  
          <script type="text/javascript">alert("! El ID ingresado no existe!");</script>
        <?php
        return;
      }  
    
}

if (isset($_POST["B1"])){

include("conexion.php");    
    $idC = $_POST["idArticulo"];
    $descripcion = $_POST["descripcion"];
    $modelo = $_POST["modelo"];
    $precio = $_POST["precio"];
    $stock = $_POST["existencia"];

$sSQL="UPDATE articulo SET descripcion='$descripcion',modelo='$modelo',precio='$precio',stock='$stock' where idArticulo='$idC'"; 
$result2=mysqli_query($mysqli, $sSQL); 
include('cerrar_conexion.php');   
echo " 
<p>Actualizacion Exitosa.</p>";
}


if (isset($_POST["elimina"])){
$idC = $_POST["idArticulo"]; 
if($idC==""){
?>  
  <script type="text/javascript">alert("! Ingrese un ID valido para eliminar!");</script>
<?php
return;  
}
include('conexion.php');   
    $consulta="select * from articulo where idArticulo=".$idC;
    $resultado=mysqli_query($mysqli, $consulta);
      if (mysqli_num_rows($resultado)==$idC){
        $query = "DELETE from articulo where idArticulo='$idC'";  
        $result4 = mysqli_query($mysqli, $query); 
        include("cerrar_conexion.php");   
        header("location:articulo.php");
        echo "<p>El registro ha sido eliminado con exito.</p> ";
      }else{ 
        ?>  
          <script type="text/javascript">alert("! El ID ingresado no existe!");</script>
        <?php
        return;
      }  
}

?> 

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
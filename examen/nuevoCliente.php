<!DOCTYPE html>
<html lang="en">
<head> 

        <meta charset="UTF-8">
        <title>Nuevo Cliente</title>
        <meta name="'viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimum-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="estilos.css">

        
        
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
          <center>Nuevo Cliente</center>
        </div>

     		<div class="container">
        <form action="" class="form-horizontal" method="POST">
 <?php
include ("conexion.php");
$sql="SELECT MAX(idCliente)+1 AS k FROM   cliente";
$resulti=mysqli_query($mysqli, $sql);
$id=mysqli_fetch_array($resulti); 
    include ("cerrar_conexion.php");

?>
                   
           <div class="form-group has-success form-horizontal">    
             <label class="control-label col-md-4" for="nombre">Clave Cliente : </label> 
              <div class="col-md-5">                           
                <input class="form-control" disabled="" type="text" placeholder="ID : " name="id" value="<?php echo $id['k']; ?>">
              </div>
                
              <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre">Nombre : </label>
                  <div class="col-md-5">
                    <input class="form-control" id="nombre" maxlength="20" type="text" placeholder="Nombre : " name="nombre" onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;'>
                  </div>                   
              </div>

              <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre"> Apellido Paterno:</label>
                 <div class="col-md-5">
                  <input class="form-control" id="ape_pat" maxlength="20" type="text" placeholder="Apellido Paterno : " name="ape_pat" onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;'>
                 </div>
             </div>

             <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre"> Apellido Materno:</label>
                 <div class="col-md-5">
                  <input class="form-control" id="ape_mat" type="text" placeholder="Apelido Materno : " name="ape_mat" onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;'>
                 </div>
             </div>


             <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre"> RFC:</label>
                 <div class="col-md-5">
                  <input class="form-control" id="rfc" maxlength="13" type="text" placeholder="RFC : " name="rfc">
                 </div>
             </div>

          
          <div class="form-group">
              <div class="col-md-5 col-md-offset-5">
                  <button class="btn btn-primary" type="button"  onclick="location.href = 'cliente.php'" >Cancelar</button>
                  <button class="btn btn-primary" type="submit" name="guarda">Guardar</button>
              </div>
          </div>
                     
          </div>
            
         </form>
           </div>


    <?php
include ("conexion.php");
if (isset($_POST["guarda"])){
    $nombre = $_POST["nombre"];
    $apellidoPaterno = $_POST["ape_pat"];
    $apellidoMaterno = $_POST["ape_mat"];
    $rfc = $_POST["rfc"];

    if($nombre==""||$apellidoPaterno==""||$apellidoMaterno==""||$rfc==""){
      ?><script type="text/javascript">alert("! No se premiten campos vacios ingrese datos por favor!");</script><?php
      return;  
    }
    
    $sql1="INSERT INTO cliente
    (nombre,apellidoPaterno,apellidoMaterno,RFC) VALUES
('$nombre','$apellidoPaterno','$apellidoMaterno','$rfc') ";
    $result=mysqli_query($mysqli, $sql1);
    echo" <h3>Los datos han sido guardados</h3>";
    include ("cerrar_conexion.php");
 header("location:nuevoCliente.php");
} 
?>
            <script src="http://code.jquery.com/jquery-latest.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

           
            </body>
            </html>

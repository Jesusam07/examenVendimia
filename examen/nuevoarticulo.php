<!DOCTYPE html>
<html lang="en">
<head> 

        <meta charset="UTF-8">
        <title>Nuevo Articulo</title>
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
          <center>Nuevo Articulo</center>
        </div>

     		<div class="container">
        <form action="" class="form-horizontal" method="POST">
 <?php
include ("conexion.php");
$sql="SELECT MAX(idArticulo)+1 AS k FROM articulo";
$resulti=mysqli_query($mysqli, $sql);
$id=mysqli_fetch_array($resulti); 
    include ("cerrar_conexion.php");

?>
                   
           <div class="form-group has-success form-horizontal">    
             <label class="control-label col-md-4" for="nombre">Clave Articulo : </label> 
              <div class="col-md-5">                           
                <input class="form-control" disabled="" type="text" placeholder="ID : " name="id" value="<?php echo $id['k']; ?>">
              </div>
                
              <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre">Descripcion : </label>
                  <div class="col-md-5">
                    <input class="form-control" id="descripcion" maxlength="25" type="text" placeholder="Descripcion : " name="descripcion" onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;'>
                  </div>                   
              </div>

              <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre"> Modelo:</label>
                 <div class="col-md-5">
                  <input class="form-control" id="modelo" maxlength="25" type="text" placeholder="Modelo: " name="modelo" onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;'>
                 </div>
             </div>

             <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre"> Precio $:</label>
                 <div class="col-md-5">
                  <input class="form-control" id="precio" maxlength="6" type="text" placeholder="$: " name="precio" onKeypress='if (event.keyCode < 46 || event.keyCode > 46 && event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;'>
                 </div>
             </div>


             <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre"> Existencia:</label>
                 <div class="col-md-5">
                  <input class="form-control" id="existencia" type="text" maxlength="3" placeholder="Existencia: " name="existencia" onKeypress='if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;'>
                 </div>
             </div>

          
          <div class="form-group">
              <div class="col-md-5 col-md-offset-5">
                  <button class="btn btn-primary" type="button"  onclick="location.href = 'articulo.php'" >Cancelar</button>
                  <button class="btn btn-primary" type="submit" name="guarda">Guardar</button>
              </div>
          </div>
                     
          </div>
            
         </form>
           </div>


    <?php
include ("conexion.php");
if (isset($_POST["guarda"])){
    $descripcion = $_POST["descripcion"];
    $modelo = $_POST["modelo"];
    $precio = $_POST["precio"];
    $existencia = $_POST["existencia"];
    
    if($descripcion==""||$modelo==""||$precio==""||$existencia==""){
      ?><script type="text/javascript">alert("! No se premiten campos vacios ingrese datos por favor!");</script><?php
      return;  
    }

    $sql1="INSERT INTO articulo
    (descripcion,modelo,precio,stock) VALUES
    ('$descripcion','$modelo','$precio','$existencia') ";
    $result=mysqli_query($mysqli, $sql1);
    echo" <h3>Los datos han sido guardados</h3>";
    include ("cerrar_conexion.php");
    header("location:nuevoarticulo.php");
    } 
?>
            <script src="http://code.jquery.com/jquery-latest.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

           
            </body>
            </html>

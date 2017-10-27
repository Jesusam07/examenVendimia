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
 
              <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre">Taza Financiamiento : </label>
                  <div class="col-md-5">
                    <input class="form-control" id="taza" type="text" placeholder="Taza de Financiamiento : " name="taza">
                  </div>                   
              </div>

              <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre"> % Enganche:</label>
                 <div class="col-md-5">
                  <input class="form-control" id="enganche" type="text" placeholder="% Enganche: " name="enganche">
                 </div>
             </div>

             <div class="form-group has-success form-horizontal">
                <label class="control-label col-md-4" for="nombre"> Plazo Maximo:</label>
                 <div class="col-md-5">
                  <input class="form-control" id="plazo" type="text" placeholder="Plazo Maximo: " name="plazo">
                 </div>
             </div>
             <div class="form-group">
              <div class="col-md-5 col-md-offset-5">
                  <button class="btn btn-primary" type="button"  onclick="location.href = 'index.html'" >Cancelar</button>
                  <button class="btn btn-primary" type="submit" name="guarda">Guardar</button>
              </div>
          </div>
                     
          </div>
            
         </form>
           </div>


    <?php
$idC = 1; 
include ("conexion.php");
if (isset($_POST["guarda"])){
    $taza = $_POST["taza"];
    $enganche = $_POST["enganche"];
    $plazo = $_POST["plazo"];
    if($taza==""||$enganche==""||$plazo==""){
      ?><script type="text/javascript">alert("! No se premiten campos vacios ingrese datos por favor!");</script><?php
      return;  
    }
    $consulta="select * from configuracion where idConfiguracion=".$idC;
    $resultado=mysqli_query($mysqli ,$consulta);
      if (mysqli_num_rows($resultado)>0)
      {
      $sSQL="UPDATE configuracion SET tazaFin='$taza',enganche='$enganche',plazoMax='$plazo' where idConfiguracion=".$idC; 
      $result2=mysqli_query($mysqli, $sSQL);
      echo" <h3>Los datos han sido Actualizados</h3>";
      include ("cerrar_conexion.php"); 
      } else {
        $sql1="INSERT INTO configuracion
        (tazaFin,enganche,plazoMax) VALUES
        ('$taza','$enganche','$plazo')";
        $result=mysqli_query($mysqli, $sql1);
        echo" <h3>Los datos han sido guardados</h3>";
        include ("cerrar_conexion.php");
      }   
} 
?>

            <script src="http://code.jquery.com/jquery-latest.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

           
            </body>
            </html>

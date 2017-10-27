<!DOCTYPE html> 
<html lang="en">
<head> 

	<meta charset="UTF-8">
	<title>Clientes</title>
	<meta name="'viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimum-scale=1.0">
	<META name='robot' content='noindex, nofollow'> 
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/prism.css" /> 
  <link rel="stylesheet" href="css/chosen.css" /> 
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="estilos.css">
  <script type="text/javascript">
    function confirmation() {
        if(!confirm("Realmente desea eliminar?")) return false;    
    }
  </script>
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
          <div class="col-xs-12 col-sm-10 col-md-6"><h1>Registro de Clientes</h1><input type="text" name="fecha_actual" value="<?php echo $fecha_actual; ?>" readonly></div> 
            <div class="col-xs-12 col-sm-2 col-md-6"></div>                   
          </div>
        <div class="row">
          <form action="" method="POST">
            <div class="col-xs-12 col-sm-2 col-md-2">
              <label>
                <input class="form-control" id="idCliente"  maxlength='5' onKeypress='if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;' placeholder="ID :"type="text" name="idCliente"><br>    
              </label>
            </div>
              <div class="col-xs-12 col-sm-10 col-md-10">
                 <article>                
                      <div class="form-group has-success">  
                        <div class="container"> 
                          <button class="btn btn-primary" type="submit" id="btnvalidaId" name="busca" onclick="validaId()">Actualizar Cliente</button>
                          <button class="btn btn-primary" method="POST" type="submit" id="btnvalidaId" name="elimina" onsubmit="return confirmation()" onclick="validaId()">
                          Eliminar Cliente</button>
                          <button class="btn btn-primary" type="button"  onclick="location.href = 'nuevoCliente.php'" >Nuevo Cliente</button>
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
$sql2="SELECT * FROM cliente ORDER BY idCliente";
$result = mysqli_query($mysqli, $sql2);
echo"
<div class=form-group has-success form-inline>
<article class=col-md-12 col-md-offset-0 >
<div class=col-md-1 ><label>Clave Cliente </label></div>
<div class=col-md-1 ><label>Nombre</label></div>
<div class=col-md-1 ><label>Apellido Paterno</label></div>
<div class=col-md-1 ><label>Apellido Materno</label></div>
<div class=col-md-2 ><label>RFC</label></div>

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
$idC = $_POST["idCliente"]; 
if($idC==""){
?>  
  <script type="text/javascript">alert("! Ingrese un ID valido!");</script>
<?php
return;  
}
include('conexion.php');
    $consulta="select * from cliente where idCliente=".$idC;
    $resultado= mysqli_query($mysqli, $consulta);
      if (mysqli_num_rows($resultado)>0){
        
    $query = "select * from cliente where idCliente = '$idC'"; 
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
                      <td colspan='2'>  <h2 class='text-success'>En los campos del formulario puede ver los valores actuales, <small>si no se cambian los valores se mantienen iguales.</small></h2></td> 
                  </tr> 
                  <form method='POST' action=''> 
                  <tr> 
                      <td width='50%'>&nbsp;</td> 
                      <td width='50%'>&nbsp;</td> 
                  </tr> 
                   <tr> 
                      <td width='50%'><p align='center'><b>Nombre:</b></td> 
                      <td width='50%'><p align='center'><input type='text' onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;' name='nombre' size='20' value='".$registro['nombre']."'></td> 
                  </tr>
                  <tr> 
                      <td width='50%'><p align='center'><b>Apellido Paterno:</b></td> 
                      <td width='50%'><p align='center'><input type='text' onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;' name='apellidoPaterno' size='20' value='".$registro['apellidoPaterno']."'></td> 
                  </tr>
                   <tr> 
                      <td width='50%'><p align='center'><b>Apellido Materno:</b></td> 
                      <td width='50%'><p align='center'><input type='text' onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;' name='apellidoMaterno' size='20' value='".$registro['apellidoMaterno']."'></td> 
                  </tr>
                   <tr> 
                      <td width='50%'><p align='center'><b>RFC:</b></td> 
                      <td width='50%'><p align='center'><input type='text' onKeypress='if (event.keyCode < 32 || event.keyCode > 32 && event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;' name='RFC' size='20' value='".$registro['RFC']."'></td> 
                  </tr>

                          
                   
                  <tr> 
                      <td width='50%'>&nbsp;</td> 
                      <td width='50%'>&nbsp;</td> 
                  </tr> 
                  <input type='hidden' name='clave' value='$idC'> 
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
      }else{
        ?>  
          <script type="text/javascript">alert("! El ID ingresado no existe!");</script>
        <?php
        return;
      }
}

if (isset($_POST["B1"])){

include("conexion.php"); 
    $clave = $_POST["clave"];
    $nom = $_POST["nombre"];
    $ape_pat = $_POST["apellidoPaterno"];
    $ape_mat = $_POST["apellidoMaterno"];
    $rfc = $_POST["RFC"];
    


$sSQL="UPDATE cliente SET nombre='$nom',apellidoPaterno='$ape_pat',apellidoMaterno='$ape_mat',RFC='$rfc' where idCliente='$clave'"; 
$result2=mysqli_query($mysqli, $sSQL); 
include('cerrar_conexion.php');   
echo " 
<p>Actualizacion Exitosa.</p>";
 header("location:cliente.php");
}

if (isset($_POST["elimina"])){
$idC = $_POST["idCliente"]; 
if($idC==""){
?>  
  <script type="text/javascript">alert("! Ingrese un ID valido para eliminar!");</script>
<?php
return;  
}
include("conexion.php");  
    $consulta="select * from cliente where idCliente=".$idC;
    $resultado=mysqli_query($mysqli, $consulta);
      if (mysqli_num_rows($resultado)>0)
      {
        $query = "DELETE from cliente where idCliente='$idC'";  
        $result4 = mysqli_query($mysqli, $query); 
        include("cerrar_conexion.php");   
        header("location:cliente.php");
        echo "<p>El registro ha sido eliminado con exito.</p> ";
      }else{ 
        ?>  
          <script type="text/javascript">alert("! El ID ingresado no existe!");</script>
        <?php
        return;
      }   

}


?> 

<script src="js/jquery_2.2.0.min.js"></script>
<script src="js/bootstrap_3.3.6.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/venta.js"></script>
</body>
</html>
<?php
$tipoViejo=$_GET["tipoAModificar"];
$tipoNuevo=$_GET["tipoNuevo"];
$tipoNuevo=strtolower($tipoNuevo);
$tipoViejo=strtolower($tipoViejo);
$link=mysqli_connect('localhost','root') or die('No se pudo seleccionar la base de datos');
mysqli_select_db($link,'couchinn');
if($tipoNuevo==false && $tipoViejo==false){
  echo '<script type="text/javascript">
                    alert("Ambos campos estan vacio");
                     window.location="http://localhost/agregarTipoDeHospedaje.php"
                      </script>"';
}else{
  if( $tipoViejo==false){
    echo '<script type="text/javascript">
                      alert("El campo del tipo a modificar esta vacio");
                       window.location="http://localhost/agregarTipoDeHospedaje.php"
                        </script>"';
  }else{
    if($tipoNuevo==false){
    echo '<script type="text/javascript">
                      alert("El campo del tipo nuevo esta vacio");
                       window.location="http://localhost/agregarTipoDeHospedaje.php"
                        </script>"';
                      }else{
    $sql="SELECT * FROM tipos_de_hospedajes";
    $consulta=mysqli_query($link,$sql);
    $Encontrado=false;
    $EncontradoTipoNuevo=false;
  while($fila=mysqli_fetch_row($consulta)){
    if(strtolower($fila[1])==$tipoViejo){
        $Encontrado=true;}
    if(strtolower($fila[1])==$tipoNuevo){
       $EncontradoTipoNuevo=true;
     }
    }
  if($Encontrado && !$EncontradoTipoNuevo){
    $sql="UPDATE `tipos_de_hospedajes` SET `Nombre` = '$tipoNuevo' WHERE `tipos_de_hospedajes`.`Nombre` = '$tipoViejo'";
    mysqli_query($link,$sql) or die ('Falla enlaconsulta');
    echo '<script type="text/javascript">
                      alert("Modificacion exitosa");
                       window.location="http://localhost/agregarTipoDeHospedaje.php"
                        </script>"';
}
  else{
    if($Encontrado==false){
       echo '<script type="text/javascript">
                      alert("El campo amodificar noexiste");
                       window.location="http://localhost/agregarTipoDeHospedaje.php"
                        </script>"';
                      }else {
                        echo '<script type="text/javascript">
                                       alert("El campo nuevo esta repetido");
                                        window.location="http://localhost/agregarTipoDeHospedaje.php"
                                         </script>"';
                      }
                    }
  }
}
}
mysqli_close($link);
?>

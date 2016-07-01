<?php
require("establece_conexion.php");
establecer_conexion($conexion);
$tabla=$_POST["tabla"];
$tupla=$_POST["tupla"];
$sql="SELECT p.idPUBLICACIONES,p.FECHA_PUBLICADO,p.TITULO,p.CAPACIDAD,c.NOMBRE,prov.NOMBRE,t.NOMBRE,p.idUSUARIOS
      FROM publicaciones p INNER JOIN ciudades c ON (p.idCIUDADES=c.idCIUDADES)
        INNER JOIN provincias prov ON (c.idPROVINCIAS=prov.idPROVINCIAS)
        INNER JOIN tipos_de_hospedajes t ON (p.idTIPOS_DE_HOSPEDAJES=t.idTIPOSDEHOSPEDAJES)
      WHERE ACTIVA=1";
$busqueda=$_POST["busqueda"];
if($busqueda!=""){
  $sql=$sql." AND p.TITULO LIKE '%".$busqueda."%'";
}
switch ($tabla) {
  case 'PROVINCIAS':
    $sql=$sql." AND prov.idPROVINCIAS=".$tupla;
  break;
  case 'CIUDADES':
    $sql=$sql." AND c.idCIUDADES=".$tupla;
  break;
  case 'TIPOS_DE_HOSPEDAJES':
    $sql=$sql." AND t.idTIPOSDEHOSPEDAJES=".$tupla;
  break;
  default:
  break;
}
$sql=$sql." ORDER BY FECHA_PUBLICADO DESC";
$resultado=mysqli_query($conexion,$sql);
mysqli_close();
$cantResultados=mysqli_num_rows($resultado);
echo $cantResultados;
mysqli_free_result();
?>

Notice: Undefined index: tabla in C:\xampp\htdocs\couchinn\cuenta_resultados.php on line 4

Notice: Undefined index: tupla in C:\xampp\htdocs\couchinn\cuenta_resultados.php on line 5

Notice: Undefined index: busqueda in C:\xampp\htdocs\couchinn\cuenta_resultados.php on line 11
5
Warning: mysqli_free_result() expects exactly 1 parameter, 0 given in C:\xampp\htdocs\couchinn\cuenta_resultados.php on line 32

Warning: mysqli_close() expects exactly 1 parameter, 0 given in C:\xampp\htdocs\couchinn\cuenta_resultados.php on line 33

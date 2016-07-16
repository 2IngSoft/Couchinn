<?php
session_start();
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
$cantResultados=mysqli_num_rows($resultado);
echo $cantResultados;
if(mysqli_num_rows($resultado)>0){
  echo "<div id='contenedor'>";
  while($fila=mysqli_fetch_row($resultado)){
    $sql_imagenes="SELECT IMAGEN FROM IMAGENES WHERE idPUBLICACIONES='$fila[0]'";
    $resultado_imagenes=mysqli_query($conexion,$sql_imagenes);
    echo "<div id=".$fila[0]." class='publicacion_borde' onclick='cargar(this.id)'>";
    echo "<div id='publicacion' class='publicacion'>";
    $imagen=mysqli_fetch_row($resultado_imagenes);
    echo "<div id='publicacion_contenido' class='publicacion_contenido'>";
    echo "<div id='imagen' class='imagen'>";
    echo "<img src='";
    $sqlPremium="SELECT Premium FROM USUARIOS WHERE idUSUARIOS='$fila[7]'";
    $resultado_premium=mysqli_query($conexion,$sqlPremium);
    $esPremium=mysqli_fetch_row($resultado_premium);
    if($esPremium[0]){
      echo $imagen[0];
    }else{
      echo "CouchInnLogo.png";
    }
    echo "' height='185' width='265'/>";
    echo"</div>";
    echo "<div id='datos' class='datos'>";
    echo "<div class='titulo'>".$fila[2]."</div>";
    echo "<div class='hospedaje_y_capacidad'>".$fila[6]." para ".$fila[3]." personas en</div>";
    echo "<div class='ubicacion'>".$fila[4].", </div>";
    echo "<div>".$fila[5].".</div>";
    echo "<div class='fecha'>Publicado el día ";
    $fecha=date_create($fila[1]);
    echo date_format($fecha,'d-m-y')."</div>";
    echo "</div></div></div></div>";
  }
  echo "</div>";
} else {
  echo "<div class='contenedor_cartel'>
          <div class='cartel_sin_publicaciones'>
            Parece que no hay publicaciones de lo que estas buscando
            <div class='carita'>
            :/
            </div>
          </div>
        </div>";
}
mysqli_free_result();
mysqli_close();
?>

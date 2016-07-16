<?php

if(isset($_POST['accion'])){
  switch ($_POST['accion']) {

    case 1:
      $link = mysql_connect('localhost', 'root', '') or die('No se pudo conectar: ' . mysql_error());
      mysql_select_db('couchinn') or die('No se pudo seleccionar la base de datos');

      $query="SELECT * FROM PROVINCIAS";
      $result = mysql_query($query) or die("Ocurrio un error en la consulta SQL");
      mysql_close();
      echo '<option value="0">Provincia</option>';
      while (($fila = mysql_fetch_array($result)) != NULL) {
          echo '<option value="'.$fila["idPROVINCIAS"].'">'.$fila["NOMBRE"].'</option>';
      }
      // Liberar resultados
      mysql_free_result($result);

      // Cerrar la conexión
      mysql_close($link);
    break;

    case 2:
      $link = mysql_connect('localhost', 'root', '')
          or die('No se pudo conectar: ' . mysql_error());
      mysql_select_db('couchinn') or die('No se pudo seleccionar la base de datos');
      $valor=$_POST["valorCiudad"];
      $query="SELECT * FROM CIUDADES WHERE idPROVINCIAS=$valor";
      /*if($valor!=0){
        $query="SELECT * FROM CIUDADES WHERE idPROVINCIAS=$valor";
      } else {
        $query="SELECT * FROM CIUDADES";
      }*/
      $result = mysql_query($query) or die("Ocurrio un error en la consulta SQL");
      mysql_close();
      if(isset($_POST["valorCero"]) && $_POST["valorCero"]==1){
        echo '<option value="0">Ciudad</option>';
      }
      while (($fila = mysql_fetch_array($result)) != NULL) {
          echo '<option value="'.$fila["idCIUDADES"].'">'.$fila["NOMBRE"].'</option>';
      }
      // Liberar resultados
      mysql_free_result($result);

      // Cerrar la conexión
      mysql_close($link);
    break;

    case 3:
      $link = mysql_connect('localhost', 'root', '')
          or die('No se pudo conectar: ' . mysql_error());
      mysql_select_db('couchinn') or die('No se pudo seleccionar la base de datos');
      $query="SELECT * FROM TIPOS_DE_HOSPEDAJES";
      $result = mysql_query($query) or die("Ocurrio un error en la consulta SQL");
      mysql_close();
      echo '<option value="0">Tipo del hospedaje</option>';
      while (($fila = mysql_fetch_array($result)) != NULL) {
          echo '<option value="'.$fila["idTIPOSDEHOSPEDAJES"].'">'.$fila["NOMBRE"].'</option>';
      }
      // Liberar resultados
      mysql_free_result($result);

      // Cerrar la conexión
      mysql_close($link);
    break;
  }
}

?>

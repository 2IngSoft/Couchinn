<?php
require("establece_conexion.php");
establecer_conexion($conexion);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      .largor{
        width:200px;
      }
    </style>
  </head>
  <body>
    <form method="post">
      <input type="text" name="ciudad" placeholder="ciudad">
      <select class="largor" name="provincia">
        <?php
          $sql="SELECT * FROM `provincias`";
          $resultado=mysqli_query($conexion,$sql);
          while ($fila=mysqli_fetch_row($resultado)) {
            echo "<option value=$fila[0]>";
            echo $fila[1];
            echo "</option>";
          }
        ?>
      </select>
      <input type="submit" name="enviar">
    </form>
    <?php
      if(isset($_POST["enviar"])){
        $ciudad=$_POST["ciudad"];
        $prov=$_POST["provincia"];
        $sql="INSERT INTO `ciudades`(`NOMBRE`, `idPROVINCIAS`) VALUES ('$ciudad','$prov')";
        $resultado=mysqli_query($conexion,$sql);
        if($resultado==false){
          echo "ERROR";
        } else {
          echo $ciudad . ", ";
          echo "$prov";
        }
      }
    ?>
  </body>
</html>

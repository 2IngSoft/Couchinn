<?php
  session_start();
  $publicacion=$_POST['publicacion'];
  require("establece_conexion.php");
  establecer_conexion($conexion);
  $sql="SELECT Nombre, Comentario, Respuesta, Fecha_y_hora FROM COMENTARIOS WHERE idHospedaje='$publicacion'";
  $resultado=mysqli_query($conexion,$sql);
  mysqli_close($conexion);
  if(mysqli_num_rows($resultado)>0){
    while($fila=mysqli_fetch_row($resultado)){
      echo "<div id='contenedor_pregunta'>";
      echo "<div id='fecha'>".$fila[3]."</div>";
      echo "<div id='encabezado_pregunta'>".$fila[0]."</div>";
      echo "<div id='pregunta'>".$fila[1]."</div>";
      echo "<div id='respuesta'>".$fila[2]."</div>";
      echo "</div><br>";
    }
  } else {
    echo "<div id='cartel_sin_preguntas' class='cartel_sin_preguntas'>Parece que nadie ha preguntado nada...</div>";
  }
  mysqli_free_result($resultado);
?>

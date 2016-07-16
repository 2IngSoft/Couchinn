<?php
  session_start();
  require("establece_conexion.php");
  establecer_conexion($conexion);
  $publicacion=$_POST["publicacion"];
  //PARA TRAER AL USUARIO DUEÑO DE LA PUBLICACION
  /*$sql="SELECT * FROM USUARIOS WHERE EMAIL='$email'";
  $resultado=mysqli_query($conexion,$sql);
  $fila=mysqli_fetch_row($resultado);
  $id=$fila[0];*/
  $sql="SELECT p.TITULO, prov.NOMBRE, c.NOMBRE, h.NOMBRE, p.CAPACIDAD, p.DESCRIPCION, p.FECHA_ALTA FROM publicaciones p INNER JOIN ciudades c ON(p.idCIUDADES = c.idCIUDADES) INNER JOIN provincias prov ON (prov.idPROVINCIAS = c.idPROVINCIAS) INNER JOIN tipos_de_hospedajes h ON (p.idTIPOS_DE_HOSPEDAJES = h.idTIPOSDEHOSPEDAJES) WHERE idPUBLICACIONES=$publicacion";
  $resultado=mysqli_query($conexion,$sql);
  $fila=mysqli_fetch_row($resultado);
  $sql2 = "SELECT IMAGEN FROM IMAGENES WHERE idPUBLICACIONES='$publicacion'";
  $resultado2=mysqli_query($conexion,$sql2);

  $email=$_SESSION["usuario"];
  $conn = mysqli_connect("localhost","root","","couchinn");
  $sql3="SELECT `idUSUARIOS` FROM `usuarios` WHERE `EMAIL`='$email'";
  $idUsuario=mysqli_query($conn,$sql3);
  $rowU = mysqli_fetch_row($idUsuario);
  $idU=$rowU[0];
  $sql3="SELECT `idUSUARIOS` FROM `publicaciones` WHERE `idPUBLICACIONES`='$publicacion'";
  $idUsuario=mysqli_query($conn,$sql3);
  $rowU = mysqli_fetch_row($idUsuario);
  $idU2=$rowU[0];
  if ($idU==$idU2) {
    $propietario=true;
  } else {
    $propietario=false;
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Estilos_Detalle_Publicacion.css" media="screen" title="no title" charset="utf-8">
    <script src="jquery-3.0.0.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {

      });
      function carga_preguntas(){
        $("#cargar_preguntas").empty();
        var id = document.getElementById("idPublicacion").value ;
        $("#cargar_preguntas").load("carga_preguntas.php",{"publicacion":id})
      }
      function preguntar(){
        var pregunta = $("#pregunta").val();
        var id = $("#idPublicacion").val();
        var datos = { "pregunta":pregunta, "idHospedaje":id };
        if(pregunta!=""){
          $.ajax({
            type:"POST",
            url:"detalle_publicacion_preguntar.php",
            data:datos
          });
          carga_preguntas();
          document.getElementById("pregunta").value="";
        }
        return false;
      }
      function cargaHospProp(idComentario){
        $("#divHospPropietario").empty();
        var id = document.getElementById("idPublicacion").value ;
        $("#divHospPropietario").load("HospedajePropietarioV2(2).php",{"publicacion":id, "idComent":idComentario})
      }
      function responder(){
        var resp = $("#respuesta").val();
        var id = $("#botonResp").val();
        var datos = { "respuesta":resp, "idComent":id };
        $.ajax({
          type:"POST",
          url:"HospedajePropietarioV2.php",
          data:datos
        });
        cargaHospProp('Vacio');
        return false;
      }
    </script>
  </head>
  <body>
    <div class="contenedor_publicacion_detalle">
      <div class="titulo_detalle">
        <?php echo $fila[0]; ?>
      </div>
      <div class="galeria">
        <div class="seleccion">
          <?php
            $imagenes = mysqli_fetch_row($resultado2);
            echo "<img src='" . $imagenes[0] ."' height='250px' width='450px'/>";
          ?>
        </div>
        <div class="otras">
          <?php
            while($imagenes = mysqli_fetch_row($resultado2)){
              echo "<img src='" . $imagenes[0] ."' height='100px' width='100px'/>";
            }
          ?>
        </div>
      </div>
      <div class="">
        <?php echo $fila[1] . ", " . $fila[2] . "."; ?>
      </div>
      <div class="">
        <?php echo $fila[3] . ", para " . $fila[4] . " personas." ?>
      </div>
      <div class="descripcion_detalle">
        <?php echo $fila[5]; ?>
      </div>
      <div class="">
        Publicado el dia:
        <?php echo $fila[6]; ?>
      </div>
    </div>
    <div class="divPreguntas">
      <h3>Preguntas</h3>
      <?php
          echo "<input type='hidden' id='idPublicacion' value=\"$publicacion\">";
          if ($propietario) {
            echo "<script> cargaHospProp('Vacio'); </script>";
          }else {
            echo "<script> carga_preguntas(); </script>";
          }
        ?>
      <div id="contenedor_preguntas" class="cajaPregs">
        <div id="cargar_preguntas"></div>
        <?php
          if (!($propietario)) {
            echo "<form class=\"formResp\" onsubmit=\"return preguntar()\">";
            echo "<textarea name=\"comentario\" id=\"pregunta\" rows=\"3\" cols=\"50\" maxlength=\"200\" class=\"cajaComs2\"></textarea>";
            echo "<input type=\"submit\" name=\"Coment\" value=\"Preguntar\" class=\"Bcomnt\">";
            echo "</form>";
          }
         ?>
      </div>
      <div id="divHospPropietario" class="cajaPregs">

      </div>
    </div>
  </body>
</html>

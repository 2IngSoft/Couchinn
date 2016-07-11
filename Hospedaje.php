<?php
  require("cabecera_estandar_sesion_iniciada.php");
  //session_start();
  $conn = mysqli_connect("localhost","root","","couchinn");
  $email=$_SESSION['usuario'];
  $idHospedaje=$_SESSION['idHosp']; //Variable Global
  $sql="UPDATE `comentarios` SET `Visto`='1' WHERE `Nombre`='$email' AND `Respuesta`!='' AND `idHospedaje`='$idHospedaje'";
  mysqli_query($conn, $sql);
  if ($_POST) {
    if (!($_POST['comentario']=="")) {
      $comen=$_POST['comentario'];
      $ins="INSERT INTO `comentarios`(`Nombre`, `Comentario`, `idHospedaje`) VALUES ('$email','$comen','$idHospedaje')";
      $result=mysqli_query($conn,$ins);
      //header("Location: HospedajePropietario.php");
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="HospedajeEstilo.css">
    <title>Hospedaje</title>
  </head>
  <body>
    <section class="wrapper"> <!-- CONTENEDOR -->
      <section class="main">
        <article>
          <?php
            $sql="SELECT p.TITULO, prov.NOMBRE, c.NOMBRE, h.NOMBRE, p.CAPACIDAD, p.DESCRIPCION, p.FECHA_ALTA FROM publicaciones p INNER JOIN ciudades c ON(p.idCIUDADES = c.idCIUDADES) INNER JOIN provincias prov ON (prov.idPROVINCIAS = c.idPROVINCIAS) INNER JOIN tipos_de_hospedajes h ON (p.idTIPOS_DE_HOSPEDAJES = h.idTIPOSDEHOSPEDAJES) WHERE idPUBLICACIONES='$idHospedaje'";
            $result=mysqli_query($conn,$sql);
            $row = mysqli_fetch_row($result);
           ?>
          <h2><?php echo "$row[0]"; ?></h2>
          <div class="datos">
            <p><?php echo $row[1] . ", " . $row[2] . "."; ?></p>
            <p><?php echo $row[3] . ", para " . $row[4] . " personas."; ?></p>
            <p><?php echo $row[5]; ?></p>
            <p><?php echo $row[6]; ?></p>
          </div>
          <?php
            $sql="SELECT `IMAGEN` FROM `imagenes` WHERE `idPUBLICACIONES`='$idHospedaje'";
            $result=mysqli_query($conn,$sql);
            $row = mysqli_fetch_row($result);
           ?>
          <div class="imgs">
            <img src='<?php echo "$row[0]"; ?>' alt="" height="300px" width="300px" />
          </div>
          <div class="imgs2">
            <?php
              while($row = mysqli_fetch_row($result)){
                echo "<img src='" . $row[0] ."' height='100px' width='100px'/>";
              }
            ?>
          </div>
        </article>
      </section>
      <aside>
        <h3>Reservar</h3>
      </aside>
    </section>
  </body>
  <footer>
    <h3>Preguntas</h3>
    <form class="formResp" action="" method="post">
      <div class="cajaComs1">
        <?php
          $sql = "SELECT * FROM `comentarios` WHERE `idHospedaje` = '$idHospedaje'";
          if ($findcomments=mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_row($findcomments)) {
              $nom = $row[1];
              $com = $row[2];
              $rta=$row[3];
              echo "<p>";
              if ($nom==$email) {
                echo "* <span class='RnomB'>$nom</span> - $com";
              } else {
                echo "* <span class='Rnom'>$nom</span> - $com";
              }
              echo "</p>";
              if (! $rta=="") {
                echo "<p class='Rrespuesta'>-$rta</p>";
              }
              //echo "<br>";
            }
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
         ?>
      </div>
      <textarea name="comentario" rows="3" cols="50" maxlength="200" class="cajaComs2"></textarea>
      <input type="submit" name="Coment" value="Publicar" class="Bcomnt">
    </form>
  </footer>
</html>

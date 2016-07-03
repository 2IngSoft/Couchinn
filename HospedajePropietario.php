<?php
  require("cabecera_estandar_sesion_iniciada.php");
  $conn = mysqli_connect("localhost","root","","couchinn");
  $NumComent="Vacio";
  $idHospedaje=$_SESSION['idHosp']; //Variable Global
  if ($_POST) {
    //session_start();
    if (!($_POST['comentario']=="")) {
      $email=$_SESSION['usuario'];
      $comen=$_POST['comentario'];
      if (isset($_POST['Coment'])) { // (IF) SIN FUNCION SI BOTON PUBLICAR NO ESTA
          $ins="INSERT INTO `comentarios`(`Nombre`, `Comentario`, `idHospedaje`) VALUES ('$email','$comen','$idHospedaje')";
      }else {
        foreach($_POST as $kkey => $vvalue) {
          if (substr($kkey,0,3)=="sub") {
            $NumComent=substr($kkey,3);
          }
        }
        $ins = "UPDATE `comentarios` SET `Respuesta` = '$comen' WHERE `comentarios`.`ID` = '$NumComent' ";
      }
      $result=mysqli_query($conn,$ins);
      //header("Location: HospedajePropietario.php");
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="HospedajePropietarioEstilo.css">
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
              $id = $row[0];
              $nom = $row[1];
              $com = $row[2];
              $rta=$row[3];
              echo "* <span class='Rnom'>$nom</span> - $com";
              echo "<br>";
              if ($rta=="") {
                echo "<input type='submit' name=\"sub$id\" value=\"Responder\" class='Rresponder'>";
              }else {
                echo "<span class='Rrespuesta'>-$rta</span>";
              }
              echo "<br>";
            }
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
         ?>
      </div>
      <textarea name="comentario" rows="3" cols="50" maxlength="200" class="cajaComs2"></textarea>
      <!--<input type="submit" name="Coment" value="Publicar" class="Bcomnt">-->
    </form>
  </footer>
</html>

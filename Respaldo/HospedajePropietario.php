<?php
  require("cabecera_estandar_sesion_iniciada.php");
  $conn = mysqli_connect("localhost","root","","couchinn");
  $idHospedaje=$_SESSION['idHosp']; //Variable Global
  if (! isset($_SESSION['idComent'])) {
    $_SESSION['idComent']='Vacio';
  }
  if ($_POST) {
    //session_start();
    if (isset($_POST['Coment'])) {
      if (!($_POST['comentario']=="")) {
        $kkey=$_SESSION['idComent'];
        $NumComent=substr($kkey,3);
        $comen=$_POST['comentario'];
        $ins = "UPDATE `comentarios` SET `Respuesta` = '$comen' WHERE `comentarios`.`ID` = '$NumComent' ";
        $result=mysqli_query($conn,$ins);
      }
    }else {
      foreach($_POST as $kkey => $vvalue) {
        if (substr($kkey,0,3)=="sub") { //checkea si se apreto un responder
          $_SESSION['idComent']=$kkey;
        }
      }
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
              echo "<p>* <span class='Rnom'>$nom</span> - $com</p>";
              //echo "<br>";
              if ($rta=="") {
                $kkey=$_SESSION['idComent'];
                if ((substr($kkey,0,3)=="sub") & (substr($kkey,3)=="$id")) {
                  $vvalue=substr($kkey,3);
                  echo "<div><textarea name=\"comentario\" rows=\"3\" cols=\"50\" maxlength=\"200\" class=\"cajaComs2\"></textarea>";
                  echo "<input type=\"submit\" name=\"Coment\" value=\"Publicar\" class=\"Bcomnt\"></div>";
                  $_SESSION['idComent']="IdC$vvalue";
                } else {
                  echo "<input type='submit' name=\"sub$id\" value=\"Responder\" class='Rresponder'>";
                }
              }else {
                echo "<p class='Rrespuesta'>-$rta</p>";
              }
              //echo "<br>";
            }
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
         ?>
      </div>
    </form>
  </footer>
</html>

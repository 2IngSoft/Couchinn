<?php
  //ssession_start();
  $conn = mysqli_connect("localhost","root","","couchinn");
  $email=$_SESSION['usuario'];
  $idHospedaje=$_SESSION['idHosp']; //Variable Global
  $sql="UPDATE `comentarios` SET `Visto`='1' WHERE `Nombre`='$email' AND `Respuesta`!='' AND `idHospedaje`='$idHospedaje'";
  mysqli_query($conn, $sql);
  if ($_POST) {
    if (isset($_POST["Coment"])) {
      if (!($_POST['comentario']=="")) {
        $comen=$_POST['comentario'];
        $ins="INSERT INTO `comentarios`(`Nombre`, `Comentario`, `idHospedaje`) VALUES ('$email','$comen','$idHospedaje')";
        $result=mysqli_query($conn,$ins);
        //header("Location: HospedajePropietario.php");
      }
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="HospedajeEstiloV2.css">
  </head>
  <footer>
    <h3>Preguntas <?php echo "$idHospedaje"; ?></h3>
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

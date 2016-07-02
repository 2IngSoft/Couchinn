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
          <h2>Hospedaje</h2>

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
              echo "* <span class='Rnom'>$nom</span> - $com";
              echo "<br>";
              if (! $rta=="") {
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
      <input type="submit" name="Coment" value="Publicar" class="Bcomnt">
    </form>
  </footer>
</html>

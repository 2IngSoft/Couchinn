<?php
  session_start();
  $email=$_SESSION['usuario'];
  $publicacion=$_POST["publicacion"];
  $sql = "SELECT * FROM `comentarios` WHERE `idHospedaje` = '$publicacion'";
  $conn = mysqli_connect("localhost","root","","couchinn");
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
  $sql="UPDATE `comentarios` SET `Visto`='1' WHERE `Nombre`='$email' AND `Respuesta`!='' AND `idHospedaje`='$publicacion'";
  mysqli_query($conn, $sql);
  mysqli_close($conn);
?>

<?php
  $conn = mysqli_connect("localhost","root","","couchinn");
  if (!($_POST['respuesta']=="")) {
    $NumComent=$_POST["idComent"];
    $comen=$_POST['respuesta'];
    $ins = "UPDATE `comentarios` SET `Respuesta` = '$comen' WHERE `comentarios`.`ID` = '$NumComent' ";
    $result=mysqli_query($conn,$ins);
  }
?>

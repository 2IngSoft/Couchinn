<?php
function comprobacion(){
  if(isset($_POST["enviarFormulario"])){
    $usuario=$_POST["nombre"];
    if($usuario == "hola"){
      echo "uiiiii";
    } else {
      echo "NOOOOOOOOOODKALÑSJFKASJDÑFLKJAÑL JAKLSF ÑKJASDÑKFJÑAJFÑLAKJFÑKLAJDÑSLASDF";
    }
  }
}
comprobacion();
?>

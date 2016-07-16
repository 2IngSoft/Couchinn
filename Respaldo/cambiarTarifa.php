<?php
   $nuevo=$_GET["tarifaNueva"];
   if(!empty($nuevo)){
     $fp = fopen("precio.txt", "w");
      fputs($fp, $nuevo);
      echo '<script type="text/javascript">
                        alert("Operacion exitosa! Ha generado una nueva tarifa.");
                         window.location="agregarTipoDeHospedaje.php"
                          </script>';
   }

 ?>

<?php
   $nuevo=$_GET["tarifaNueva"];
   if(!empty($nuevo)){
     $fp = fopen("\Users\Ivana\Desktop\precio.txt", "w");
      fputs($fp, $nuevo);
      echo '<script type="text/javascript">
                        alert("Operacion exitosa! Ha generado una nueva tarifa.");
                         window.location="http://localhost/informes_modificar_tarifas.php"
                          </script>';
   }

 ?>

<?php header("location: index.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div id="contenedor_publicaciones" class="contenedor_publicaciones">
      <!--DENTRO DE ESTE CONTENDOR VAN TODAS LAS PUBLICACIONES-->
      <div id="publicacion" class="publicacion">
        <div id="img_portada" class="img_portada">
          <img src="CouchInnLogo.png" height="50px" width="150px"/>
        </div>
        <div id="titulo" class="titulo">
          ACA VA EL TITULO DE LA PUBLICACION.
        </div>
        <div id="solicitudes" class="solicitudes">
          <div id="literal_solicitudes" class="literal_solicitudes">Solicitudes:</div>
          <div id="cant_solicitudes" class="cant_solicitudes">100</div>
        </div>
      </div>
      <div id="contenedor_despublicar" class="contenedor_despublicar">
        <input type="button" id="despublicar" class="despublicar" value="Despublicar">
      </div>
      <!---->
    </div>
  </body>
</html>

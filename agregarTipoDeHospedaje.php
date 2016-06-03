<?php
    header('Content-type: text/html; charset=iso-8859-1') ;
    ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Estilos/EstilosCabeceraEstandar.css">
    <link rel="stylesheet" href="Estilos/EstiloAdministrador.css">
    <title>CouchInn</title>
  </head>
  <body>
<header id="encabezadoPrincipal">
  <figure id=logoCouchInn><a href="index.php"><img src="Imagenes/CouchInnLogo.png" width="270px" height="80px"/></a></figure>
  <form id="opcion_usuario" method="post">
    <input class="boton2" type="submit" name="cerrar_sesion" value="Cerrar Sesion" id="submit_opcion_usuario">
  </form>
  <?php if(isset($_POST['cerrar_sesion'])){session_destroy();header("location: index.php");}?>
</header>
<aside>
    <p id= "encapsulador2"> Tipos de Hospedajes: </p>
    <div id= "opciones">
      <?php
      $link = mysqli_connect('localhost','root')
          or die('No se pudo conectar: ' . mysql_error());
      mysqli_select_db($link,'couchinn') or die('No se pudo seleccionar la base de datos');
      $consul="SELECT * FROM tipos_de_hospedajes";
      $datos=mysqli_query($link,$consul);
      if($datos==false){
        echo "CONSULTA FALLIDA";
    }

      while($fila=mysqli_fetch_row($datos)){
        echo ($fila['1']);
        echo"<br>";
        echo "<br>";}
      mysqli_close($link);   ?>
       </div>
  <form action="insertarTipo.php" method="get" id="opciones" >
       <input type="text" name="tipoNuevo" placeholder="Ingrese un nuevo tipo">
       <input type="submit" name="agregar" value="Agregar"><a i></a>
  </form>
  <br>
  <br>
  <form action=" eliminar.php"  method ="get" >
      <input type= "text" name="tipoaEliminar" placeholder="Ingrese el tipo a eliminar">
      <input type="submit" name="eliminar" value="Eliminar"><a i></a>
  <br>
  <br>
</form>
  <form action="modificar.php" method = "get">
     <input size="30" type="text" name="tipoAModificar" placeholder="Ingrese el tipo que quiere modificar">
     <br>
     <br>
     <input type="text" name="tipoNuevo" placeholder="Ingrese el nuevo tipo">
     <input type="submit" name="modificar" value="Modificar">
   </form>
</aside>
  </body>
  </html>

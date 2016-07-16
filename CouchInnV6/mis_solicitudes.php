<?php
  session_start();
  if(!isset($_SESSION["usuario"])){
    header("location: index.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CouchInn</title>
    <link rel="stylesheet" href="EstilosCabeceraSesionIniciada.css">
    <link rel="stylesheet" href="Estilos_solicitudes.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="Estilos_filtros_solicitudes.css" media="screen" title="no title" charset="utf-8">
    <script src="jquery-3.0.0.min.js" charset="utf-8"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#activas").toggleClass("activas_seleccion");
        cargar_pendientes();
      });
      var hacer = true;
      function click_activas(){
        if(!$("#inactivas").hasClass("inactivas_seleccion")){
          cargar_confirmadas();
          $("#inactivas").toggleClass("inactivas_seleccion");
          $("#activas").toggleClass("activas_seleccion");
        }
      }
      function click_inactivas(){
        if(!$("#activas").hasClass("activas_seleccion")){
          cargar_pendientes();
          $("#activas").toggleClass("activas_seleccion");
          $("#inactivas").toggleClass("inactivas_seleccion");
        }
      }
      function cargar_pendientes() {
        $.ajax({
          type: "POST",
          data: { "accion":0 },
          url:"get_solicitudes_pendientes_y_confirmadas.php",
          success: function(response){
            $('#carga_solicitudes').html(response).fadeIn();
          }
        });
      }
      function cargar_confirmadas() {
        $.ajax({
          type: "POST",
          data: { "accion":1 },
          url:"get_solicitudes_pendientes_y_confirmadas.php",
          success: function(response){
            $('#carga_solicitudes').html(response).fadeIn();
          }
        });
      }
      function aceptar_solicitud(solicitud) {
        $.ajax({
          type:"POST",
          data:{ "solicitud":solicitud },
          url:"aceptar_solicitud.php",
          success: function(){
            cargar_pendientes();
            alert("Solicitud confirmada con exito :D");
          }
        });
      }
      function rechazar_solicitud(solicitud){
        var id=solicitud*-1;
        alert(id);
        $.ajax({
          type:"POST",
          data:{ "solicitud":id },
          url:"rechazar_solicitud.php",
          success:function() {
            alert("Solicitud rechazada con exito");
            cargar_pendientes();
          }
        });
      }
    </script>
  </head>
  <body>
    <header id="encabezadoPrincipal">
      <table id="encabezado">
        <tr>
          <td>
            <figure id=logoCouchInn><a href="couchInnIndexSesionIniciada.php"><img src="CouchInnLogo.png" width="270px" height="80px"/></a></figure>
          </td>
          <td>
            <table id="premium_foto_crearPost">
              <tr>
                <td id="contieneCartel">
                  <?php
                  if($_SESSION["premium"]!=0){
                    echo '¡Premium!';
                  }else{
                    echo '<span id="cartel_premium">¿Todavía no sos PREMIUM?<br><a href="Premiun.php" id="cartel_premium_sub">¡Hacé click aquí!</a></span>';
                  }?>
                <td>
                  <!--<figure id="sectorImagenUsuario"><a href=""><img src="lenny_concentrado.png" height="90px" width="90px" id="imagenPerfil"/></a>
                  <figcaption>--><a href="Perfil.php"><span id="nombreApellido"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'];?></span></a><!--</figcaption>
                </figure>--><!--CONECTAR CON BD Y TRAER IMAGEN DEL USUARIO-->
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table id="tabla_opciones">
              <tr>
                <td>
                  <form id="opcion_usuario" action="Perfil.php" method="post">
                    <input class="boton1" type="submit" name="mi_perfil" value="Mi Perfil" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="PendientesPreguntas.php" method="post" onclick="this.form.submit()">
                    <input type="submit" name="publicar" value="Pendiente" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="crear_publicacion.php" method="post" onclick="this.form.submit()">
                    <input type="submit" name="publicar" value="Publicar" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="mis_reservas.php" method="post">
                    <input type="submit" name="mis_reservas" value="Mis Reservas" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="ver_publicaciones.php" method="post">
                    <input type="submit" name="mis_publicaciones" value="Mis Publicaciones" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="mis_solicitudes.php" method="post">
                    <input type="submit" name="mis_solicitudes" value="Mis Solicitudes" id="desabilitado" disabled="true">
                  </form>
                </td>
                <td>
                  <form action="cerrar_sesion.php" id="opcion_usuario" method="post">
                    <input class="boton2" type="submit" name="cerrar_sesion" value="Cerrar Sesion" id="submit_opcion_usuario">
                  </form>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </header>
    <div class="contenedor_filtros">
      <div class="filtros">
        <div id="activas" class="activas" onclick="click_inactivas(); hacer='despublicar';">Pendientes</div>
        <div id="inactivas" class="inactivas" onclick="click_activas(); hacer='publicar';">Confirmadas</div>
      </div>
    </div>
    <div id="carga_solicitudes" class="carga_solicitudes"></div>
  </body>
</html>

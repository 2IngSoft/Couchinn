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
    <link rel="stylesheet" href="EstilosCabeceraSesionIniciada.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="Estilos_ver_publicaciones.css" media="screen" title="no title" charset="utf-8">
    <title>CouchInn</title>
    <script src="jquery-3.0.0.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#contenedor_fixed").hide();
        click_activas();
        $("#inactivas").toggleClass("inactivas_seleccion");
      });
      var hacer = true; //true = despublicar
      function click_activas(){
        if(!$("#activas").hasClass("activas_seleccion")){
          cargar_publicaciones_activas();
          $("#activas").toggleClass("activas_seleccion");
          $("#inactivas").toggleClass("inactivas_seleccion");
          $("#des_pub").html("Despublicar");
        }
      }
      function cargar_publicaciones_activas(){
        $("#contenedor_publicaciones").load("carga_ver_publicaciones.php",{"operar":1},function(response){
          $("#contenedor_publicaciones").html(response).fadeIn();
        });
      }
      function click_inactivas(){
        if(!$("#inactivas").hasClass("inactivas_seleccion")){
          cargar_publicaciones_inactivas();
          $("#inactivas").toggleClass("inactivas_seleccion");
          $("#activas").toggleClass("activas_seleccion");
          $("#des_pub").html("Publicar");
        }
      }
      function cargar_publicaciones_inactivas(){
        $("#contenedor_publicaciones").load("carga_ver_publicaciones.php",{"operar":0},function(response){
          $("#contenedor_publicaciones").html(response).fadeIn();
        });
      }
      function despublicar(id_publicacion){
        var datos = {"publicacion":id_publicacion, "accion":0};
        $.ajax({
          type: "POST",
          data: datos,
          url: "modifica_activa_publicacion.php",
          success: function(){
            cargar_publicaciones_activas();
            alert("Despublicación exitosa");
          }
        });
      }
      function publicar(id_publicacion){
        var datos = {"publicacion":id_publicacion, "accion":1};
        $.ajax({
          type: "POST",
          data: datos,
          url: "modifica_activa_publicacion.php",
          success: function(){
            cargar_publicaciones_inactivas();
            alert("Publicación exitosa");
          }
        });
      }
      function volver(){
        $("#Contenedor_contenido").show();
        $("#contenedor_carga").hide();
        $("#contenedor_fixed").hide();
        document.getElementsByClassName("opcion_despublicar")[0].id="des_pub";
      }
      function accion(id, accion){
        var idElem = "#" + id;
        var elem = $(idElem);
        alert(idElem);
        if(accion==true){    //true = despublicar
          despublicar(id);
          elem.html("");
          elem.html("Publicar");
        } else {
          publicar(id);
          elem.html("");
          elem.html("Despublicar");
        }
      }
    </script>
  </head>
  <body>
    <header id="encabezadoPrincipal">
      <table>
        <tr>
          <td>
            <figure id=logoCouchInn><a href="couchInnIndexSesionIniciada.php"><img src="CouchInnLogo.png" width="270px" height="80px"/></a></figure>
          </td>
          <td>
            <table id="premium_foto_crearPost">
              <tr>
                <td id="contieneCartel">
                  <span id="cartel_premium">¿Todavía no sos PREMIUM?<br><a href="" id="cartel_premium_sub">¡Hacé click aquí!</a></span>
                </td>
                <td>
                  <!--<figure id="sectorImagenUsuario"><a href=""><img src="lenny_concentrado.png" height="90px" width="90px" id="imagenPerfil"/></a>
                  <figcaption>--><a href="Perfil.html"><span id="nombreApellido"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'];?></span></a><!--</figcaption>
                </figure>--><!--CONECTAR CON BD Y TRAER IMAGEN DEL USUARIO-->
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table id="tabla_opciones">
              <tr>
                <td>
                  <form id="opcion_usuario" action="" method="post">
                    <input class="boton1" type="submit" name="mi_perfil" value="Mi Perfil" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="crear_publicacion.php" method="post" onclick="this.form.submit()">
                    <input type="submit" name="publicar" value="Publicar" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="" method="post">
                    <input type="submit" name="mis_reservas" value="Mis Reservas" id="submit_opcion_usuario">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="ver_publicaciones.php" method="post">
                    <input type="submit" name="mis_publicaciones" value="Mis Publicaciones" id="desabilitado" disabled="true">
                  </form>
                </td>
                <td>
                  <form id="opcion_usuario" action="" method="post">
                    <input type="submit" name="mis_solicitudes" value="Mis Solicitudes" id="submit_opcion_usuario">
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
    <div id="Contenedor_contenido">
      <div class="contendor_filtros">
        <div class="filtros">
          <div id="activas" class="activas" onclick="click_activas(); hacer='despublicar';">Activas</div>
          <div id="inactivas" class="inactivas" onclick="click_inactivas(); hacer='publicar';">Despublicadas</div>
        </div>
      </div>
      <div id="contenedor_publicaciones" class="contenedor_publicaciones"></div>
      <script>
        function cargar(valor){
          $("#contenedor_fixed").show();
          $("#contenedor_carga").show().load("detalle_publicacion.php",{"publicacion":valor});
          $("#Contenedor_contenido").hide();
          document.getElementById("des_pub").id = valor;
        }
      </script>
    </div>
    <div id="contenedor_fixed" class="contenedor_fixed">
      <div class="contiene_opciones_borde">
        <div class="contiene_opciones">
          <div class="opcion_volver" onclick="volver()">
            << Volver
          </div>
          <div class="opcion_solicitud">
            Solicitudes
          </div>
          <!--<div id="des_pub" class="opcion_despublicar" onclick="accion(this.id,hacer); hacer = !hacer;"></div>
          <div class="opcion_eliminar">
            Eliminar
          </div>-->
        </div>
      </div>
    </div>
    <div id="contenedor_carga"></div>
  </body>
</html>

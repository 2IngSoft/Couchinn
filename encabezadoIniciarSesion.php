<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="EstilosCabeceraEstandar_Prueba.css" charset="utf-8">

    <title>CouchInn</title>
  </head>
  <body>

    <header id="encabezadoPrincipal">
      <table id="tabla_encabezadoPrincipal">
        <tr>
          <td id="celda_tabla_encabezado_principal">
            <figure id=logoCouchInn><a href="index.php"><img src="CouchInnLogo.png" width="270px" height="80px"/></a></figure>
          </td>
          <td id="celda_tabla_encabezado_principal">
            <div id="linkRegistrarse">
              <a href="couchinnRegistrarse.php">¡Registrate!</a>(es gratis)
            </div>
          </td>
          <td id="celda_iniciar_sesion">
            <form action="iniciar_sesion.php" method="get" id="formularioIniciarSesion">
              <table>
                <tr>
                  <td>
                    <label>Correo electrónico: <input type="email" name="email" placeholder="alguien@algo.com" required="true"></label>
                  </td>
                  <td>
                    <label>Contraseña: <input type="password" name="contraseña" required="true"></label>
                  </td>
                  <td>
                    <input type="submit" name="iniciar_sesion" value="Ingresar!">
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <a href="calculadora.php" id="mjeContrasenia">¿Olvidaste tu contraseña?</a>
                  </td>
                  <td></td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
    </header>

  </body>
</html>

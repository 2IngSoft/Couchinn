<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="EstilosCabeceraEstandar.css" charset="utf-8">

    <title>CouchInn</title>
  </head>
  <body>

    <header id="encabezadoPrincipal">
      <figure id=logoCouchInn><a href="index.php"><img src="CouchInnLogo.png" width="270px" height="80px"/></a></figure>
      <div id="linkRegistrarse">
        <a href="couchinnRegistrarse.php">¡Registrate!</a>(es gratis)
      </div>
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
    </header>

  </body>
</html>

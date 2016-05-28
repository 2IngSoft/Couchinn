<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="EstilosCabeceraEstandar.css">
    <link rel="stylesheet" href="EstilosPrincipales.css">
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

    <aside>
      <div id="buscador">
        <form id="encapsulador2">
          <input type="text" name="buscadorPorTexto" value="Buscar">
          <input type="button" name="buscar" value="O">
          <!--EL BOTON DEBERÍA TENER UNA LUPA-->
        </form>
      </div>
      <div id="filtros">
      <p id="filtrar">Filtrar:</p>
      <table>
        <tr>
          <td>Provincia: </td>
          <td>
            <select name="Provincia">
              <option value="buenos Aires">Buenos Aires</option>
              <option value="cordoba">Córdoba</option>
              <option value="salta">Salta</option>
              <option value="tierra del fuego">Tierra del Fuego</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            Ciudad:
          </td>
          <td>
            <select name="Ciudad">
              <option value="la plata">La Plata</option>
              <option value="cordoba">Córdoba</option>
              <option value="villa carlos paz">Villa Carlos Paz</option>
              <option value="salta">Salta</option>
              <option value="usuahia">Usuahia</option>
              <option value="buenos aires">Buenos Aires</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            Tipo:
          </td>
          <td>
            <select name="tipoHospedaje">
              <option value="casa">Casa</option>
              <option value="departamento">Departamento</option>
              <option value="cabaña">Cabaña</option>
              <option value="choza">Choza</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            Calificacion:
          </td>
          <td>
            <select name="tipoHospedaje">
              <option value="5estrellas">5 estrellas</option>
              <option value="4estrellas">4 estrellas</option>
              <option value="3estrellas">3 estrellas</option>
              <option value="2estrellas">2 estrellas</option>
              <option value="1estrella">1 estrella</option>
              <option value="sinCalificar">Sin calificar</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            Fecha:
          </td>
          <td>
            <input type="date" name="fecha" value="2016/5/16">
          </td>
        </tr>
      </table>
      </div>
    </aside>

    <section>

    </section>

  </body>
</html>

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
  </head>
  <body>
    
  </body>
</html>

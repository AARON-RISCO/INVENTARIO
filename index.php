<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://kit.fontawesome.com/03a89292db.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Inventario</title>
</head>
<body>
    <div class="container">
        <div class="content">
          <h1>Iniciar Sesión</h1>
          <form class="content__form"  method="post" action="">
            <?php
            include "conexion/conexion.php";
            include "php/controlador_login.php";
            ?>
            <div class="content__inputs">
              <label>
                <input required="" type="text" name="dni_usu" maxlength="8" onkeypress="return soloNumeros(event)" autocomplete="current-password">
                <span >Ingrese DNI de Usuario</span>
                <div id="user"><svg xmlns="http://www.w3.org/2000/svg" height="12" width="10" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg></div>
              </label>
              <label>
                <input required="" type="password" id="clave" name="tclave" autocomplete="current-password">
                <span>Password</span>
                <div id="icono"><svg id="slash" xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><path d="M5.1 9.2C13.3-1.2 28.4-3.1 38.8 5.1l592 464c10.4 8.2 12.3 23.3 4.1 33.7s-23.3 12.3-33.7 4.1L9.2 42.9C-1.2 34.7-3.1 19.6 5.1 9.2z"/></svg><svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg></div>

              </label>
            </div>
            <input type="submit" name="bacceder" id="bacceder" value="Iniciar Sesión">
          </form>
          <div class="content__or-text">
            <span></span>
            <span>Inventario</span>
            <span></span>
          </div>
        </div>
      </div>
      <script src="js/main.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inicio.css">
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/navegador.js"></script>
    <script src="js/procesos_inicio.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="padre">
        <div class="hijos" id="mpro2">
            <img src="img/productos.svg" alt=""><div class="count">PRODUCTOS<label for="" id="pro"></label></div>
        </div>
        <div class="hijos" id="mven2">
            <img src="img/ventas.svg" alt=""><div class="count">VENTAS<label for="" id="ven"></label></div>
        </div>
        <div class="hijos" id="mcom2">
            <img src="img/compras.svg" alt=""><div class="count">COMPRAS<label for="" id="com"></label></div>
        </div>
        <div class="hijos" id="mdeu2">
            <img src="img/deudores.svg" alt=""><div class="count">DEUDORES<label for="" id="deu"></label></div>
        </div>
        <div class="hijos" id="mper2">
            <img src="img/usuario.svg" alt=""><div class="count">PERSONAL<label for="" id="per"></label></div>
        </div>
        <div class="hijos" id="minfo">
            <img src="img/info.svg" alt=""><div class="count">INF SISTEMA<label for="" id="info"></label></div>
        </div>
    </div>
    <div class="overlay" id="overlay">
        <div class="alert-box" id="alertBox">
            <span class="close-btn">&times;</span>
            <h2>¡Alerta!</h2>
            <p>Este es un mensaje de alerta personalizado.</p>
        </div>
    </div>
</body>
</html>

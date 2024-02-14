<?php
session_start();

if (empty($_SESSION['dni'])) {
    header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <script src="js/jquery-3.6.1.min.js"></script>
    <script type="text/JavaScript" src="js/cdnjs.cloudflare.com_ajax_libs_jQuery.print_1.6.0_jQuery.print.min.js"></script>
    <script src="js/navegador.js"></script>
    <title>Inventario</title>
</head>
<body>
<?php

if ($_SESSION['cargo'] == "VENDEDOR") {

        echo '<script>
                // Cargar contenido en contenedor usando jQuery
                $(document).ready(function() {
                    $(".contenedor").load("registrar_ventas.php");
                    $("#nav").css("margin-left", "-90%");
                    $("#opacar2").css("display", "none");
                });
              </script>';

}else if ($_SESSION['cargo'] == "ADMINISTRADOR"){

        echo '<script>
        // Cargar contenido en contenedor usando jQuery
        $(document).ready(function() {
            $(".contenedor").load("inicio.php");
            $("#nav").css("margin-left", "-90%");
            $("#opacar2").css("display", "none");
        });
        </script>';

}
?>
 <!-- Ventana modal de caja inicial-->
<!-- Fondo negro -->
<div id="opacar2"></div>
 <?php
    if ($_SESSION['nivel']==1) {
        $_SESSION['nivel']=0;
    
    ?>

    <!-- Fondo negro -->
    <div id="opacar"></div>

    <!-- Fondo negro -->
    <div class="caja" id="caja">
        <label>Ingrese monto de caja inicial</label>
        <div>
            <input type="hidden" id="id_pero" value="<?php echo $_SESSION['dni']; ?>">
            <input type="text" id="tinicio" class="input_caja">
        </div>
        <button id="continuar">Continuar</button>
    </div>
    
    <?php } ?>

    <!-- Menu de navegacion -->
    <nav class="nav" id="nav">
        <img src="img/cerrar.svg" class="cerrar" >
        <div class="logo">
            <img src="img/logo.png" alt="">
            </div>
        <ul class="list">
        
            <li class="list_item">
                <div class="list__button">
                    <img src="img/home.svg" class="list_img">
                    <label id="mhome" class="nav_link">Inicio</label >
                </div>
            </li>
            
            <li class="list_item list__item--click">
                <div class="list__button list_button--click">
                    <img src="img/productos.svg" class="list_img">
                    <label class="nav_link">Productos</label >
                    <img src="img/flecha.svg" class="list_arrow">
                </div>
                <ul class="list_show">
                    <li class="list_inside">
                        <label id="mpro" class="nav_link nav_link--inside">Ver / Agregar Productos</label >
                    </li>

                    <li class="list_inside">
                        <label id="mcat" class="nav_link nav_link--inside">Categorias</label >
                    </li>

                    <li class="list_inside">
                        <label id="mpromo" class="nav_link nav_link--inside">Promociones</label >
                    </li>

                    <!-- <li class="list_inside">
                        <label id="msp" class="nav_link nav_link--inside">Stock / Precios</label >
                    </li> -->
                </ul>
            </li>

            <li class="list_item list__item--click">
                <div class="list__button list_button--click">
                    <img src="img/ventas.svg" class="list_img">
                    <label class="nav_link">Ventas</label >
                    <img src="img/flecha.svg" class="list_arrow">
                </div>
                <ul class="list_show">
                    <li class="list_inside">
                        <label id="mrven" class="nav_link nav_link--inside">Registrar venta</label >
                    </li>

                    <li class="list_inside">
                        <label id="mvven" class="nav_link nav_link--inside">Ver ventas</label >
                    </li>
                </ul>
            </li>

            <li class="list_item list__item--click">
                <div class="list__button list_button--click">
                    <img src="img/compras.svg" class="list_img">
                    <label class="nav_link">Compras</label >
                    <img src="img/flecha.svg" class="list_arrow">
                </div>
                <ul class="list_show">
                    <li class="list_inside">
                        <label id="mrcom" class="nav_link nav_link--inside">Registrar Compras</label >
                    </li>

                    <li class="list_inside">
                        <label id="mvcom" class="nav_link nav_link--inside">Ver compras</label >
                    </li>
                </ul>
            </li>



            <li class="list_item">
                <div class="list__button">
                    <img src="img/deudores.svg" class="list_img">
                    <label id="mdeu" class="nav_link">Deudores</label >
                </div>
            </li>

            <li class="list_item list__item--click" >
                <div class="list__button list_button--click">
                    <img src="img/caja.svg" class="list_img">
                    <label class="nav_link">Caja</label >
                    <img src="img/flecha.svg" class="list_arrow">
                </div>
                <ul class="list_show">
                    <li class="list_inside">
                        <label id="mvcaja" class="nav_link nav_link--inside">Ver cajas</label >
                    </li>

                    <li class="list_inside">
                        <label  class="nav_link nav_link--inside">Ingresos / Egresos</label >
                    </li>
                </ul>
            </li>

            <li class="list_item list__item--click">
                <div class="list__button list_button--click">
                    <img src="img/servicios.svg" class="list_img">
                    <label class="nav_link">Reportes</label >
                    <img src="img/flecha.svg" class="list_arrow">
                </div>
                <ul class="list_show">
                    <li class="list_inside">
                        <label id="mreve" class="nav_link nav_link--inside">Reportes Ventas</label >
                    </li>

                    <li class="list_inside">
                        <label id="mreco" class="nav_link nav_link--inside">Reporte Compras</label >
                    </li>
                    <!-- <li class="list_inside">
                        <label class="nav_link nav_link--inside">Venta día / mes</label >
                    </li>

                    <li class="list_inside">
                        <label class="nav_link nav_link--inside">Ventas por vendedor</label >
                    </li> -->

                    <li class="list_inside">
                        <label id="marga" class="nav_link nav_link--inside">Margen de ganancia</label >
                    </li>
                </ul>
            </li>
          
            <li class="list_item">
                <div class="list__button">
                    <img src="img/usuario.svg" class="list_img">
                    <label id="musu" class="nav_link">Personal</label >
                </div>
            </li>

            <li class="list_item">
                <div class="list__button">
                    <img src="img/salir.svg" class="list_img">
                    <a  href="php/cerrar_sesion.php" class="nav_link">Salir</a >
                </div>
            </li>

        </ul>
    </nav>
    <!-- Cabecera --->
    <div class="cabecera">
        <div class="navegacion">
        <img src="img/menu.svg" id="mostrar_menu" ><label for="">Inventario ACADEMIA ÉLITE</label> 
        </div>
        <div class="usuario" id="usuario">
        <?php
        // Establecer la zona horaria de Perú
        date_default_timezone_set('America/Lima');

        // Obtener la fecha actual en la zona horaria especificada
        $fecha_actual = date('Y-m-d');
        ?>
        
        <img src="img/user.svg" id="mostrar_menu"><label class="user"><?php echo $_SESSION['nom'].' '.$_SESSION['ape'] . ' '. ' / '. ' '.$_SESSION['cargo']; ?></label> <label> <?php echo $fecha_actual ?></label>
        </div>
    </div>
    
    <!-- Contenedor -->
    <div class="contenedor">
    </div>
    
    <!-- Script-->
    <script src="js/menu.js"></script>
</body>
</html>
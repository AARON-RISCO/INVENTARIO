<?php
session_start();
if($_SESSION['cargo']=='VENDEDOR')
{
    // echo '<script>alert("Usted no tiene acceso a este espacio.");</script>';
    echo '<script>window.location.href = window.location.href;</script>';
    
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registrar_compras.css">
    <script src="js/procesos_reg_com.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="conteiner">
        
        <div class="datos_det_com">
                <div class="filtro">
                    <label for="">Ingrese Nombre del Producto</label>
                    <div class="buscar"><input type="text" name="bus_nom" id="bus_nom" class="bus" placeholder="Buscar por Nombre"></div>
                    <div class="añadir"><input type="submit" value="Añadir Nuevo Producto" class="añadir_nuevo" id="nuevo_pro"></div>
                </div>

                <div id="listado"> 
                    <table >
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Sabor</th>
                                <th>Unidad Medida</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_productos3">
                            
                        </tbody>
                    </table>
                </div>
                <div id="listado_temporal"> 
                    <table >
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Sabor</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_temporal_com">
                            
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

    <div class="datos_compras">
            <label for="">Registrar Nueva Compra</label><br>
            <input type="text" class="oculto" id="cod_com">
            <input type="text" class="cajas_com bloquear" placeholder="" id="id_cod">
            <input type="date" class="cajas_com" id="fecha" value="" >
            <input type="text" class="oculto" value="<?php echo $_SESSION['dni']; ?>" id="dni_per">
            <input type="text" class="cajas_com bloquear" value="<?php echo $_SESSION['nom'].' '.$_SESSION['ape'] ?>">

            <input type="text" class="cajas_com bloquear" placeholder="Neto a pagar" id="ttot">
            
            <div class="botones">
                <input type="button" value="Registrar Compra" class="btn-guardar btn" id="bguardar_com"> 
                <input type="button" value="Cancelar" class="btn-cancelar btn" id="bcancelar_com">
            </div>

        </div>
        
    <!--Registrar nuevo producto -->
    <div class="fondo"></div>
    <!--Ventana modal de agregar nuevo producto-->
    <div class="modal">
        <img src="img/cerrar2.svg" alt="" class="cerrar_modal">
        <label>Registrar Nuevo Producto</label><br>
        <select name="tcat" id="tcat" class="cajas-modal"></select></select><div id="ir_cat" class="ir_cat ir"> <img src="img/agregar.png" id="icon-suma" ></div>
        <input type="text" id="tnom" class="cajas_modal MT" placeholder="Ingrese nombre">
        <input type="text" id="tsa" class="cajas_modal MT" placeholder="Ingrese sabor">
        <input type="text" id="tmin" class="cajas_modal INT" placeholder="Ingrese stock Minimo">
        <input type="text" id="tpre" class="cajas_modal NUMP" placeholder="Ingrese precio de venta">        
        <div class="botones">
        <input type="button" value="Guardar" class="btn-guardar btn" id="bguardar_pro">
        </div>
    </div>
    <!-- Registrar nueva categoria-->
    <div class="modal_cat">
        <img src="img/cerrar2.svg" alt="" class="cerrar_modal_cat">
        <label>Agregar nueva categoria</label><br>
        <input type="text" name="tnom_cat" id="tnom_cat" placeholder="Ingrese Nombre de categoria" class="cajas_modal MT" ><br>
        <input type="button" value="Guardar" id="bguardar_cat">
    </div>
</body>
</html>
<?php
session_start();
if (empty($_SESSION['dni'])){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registrar_ventas.css">
    <script src="js/procesos_reg_ven.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="conteiner">
        <div class="datos_ventas">
            <label for="">Registrar Nueva Venta</label><br>
            <input type="text" class="cajas_ven bloquear" placeholder="" id="id_cod">
            <input type="text" class="cajas_ven bloquear" value="<?php echo date('Y-m-d') ?>" id="fecha" >
            <input type="text" class="oculto" value="<?php echo $_SESSION['dni']; ?>">
            <input type="text" class="cajas_ven bloquear" value="<?php echo $_SESSION['nom'].' '.$_SESSION['ape'] ?>">
            <input type="text" class="oculto" placeholder="Ingrese DNI del cliente" value="11111111" id="dni">
            <input type="text" class="cajas_ven bloquear" placeholder="Cliente" id="cliente">
            <select name="" id="est_pago">
                <option value="0">SELECCCIONE ESTADO DE VENTA</option>
                <option value="1">PAGADA</option>
                <option value="2">PENDIENTE</option>
            </select>
            <select name="" id="ttipo_pago" class="cajas_ven">
                <option value="0">SELECCCIONE TIPO DE PAGO</option>
                <option value="1">EFECTIVO</option>
                <option value="2">YAPE</option>
                <option value="3">PENDIENTE</option>
            </select>
            <div class="debe">
            <select name="" id="tdeudores"></select><img src="img/agregar.png" class="reg_deudores"> 
            </div>
            <input type="text" class="cajas_ven" placeholder="Neto a pagar">
            
            <div class="botones">
                <input type="button" value="Nueva Venta" class="btn-nueva btn" id="bnueva_ven"> 
                <input type="button" value="Registrar Venta" class="btn-guardar btn" id="bguardar_ven"> 
                <input type="button" value="Cancelar" class="btn-cancelar btn" id="bcancelar_ven">
            </div>

        </div>
        <div class="datos_det_ven">
                <div class="filtro">
                    <label for="">Ingrese Nombre del Producto</label>
                    <div class="buscar"><input type="text" name="bus_nom" id="bus_nom" class="bus" placeholder="Buscar por Nombre"></div>
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
                        <tbody id="cuerpo_tabla_productos">
                            
                        </tbody>
                    </table>
                </div>
                <div id="listado_temporal"> 
                    <table >
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Sabor</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Remover</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_temporal">
                            
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    <!-- Registrar nuevo deudor -->
    <div class="fondo"></div>
    <!--Ventana modal de agregar nuevo deudor-->
    <div class="modal">
        <img src="img/cerrar2.svg" alt="" class="cerrar_modal">
        <label>Agregar nuevo deudor</label><br>
        <input type="text" name="tnom_cat" id="tnom_cat" class="cajas_modal" placeholder="Ingrese Nombres"><br>
        <input type="text" name="tnom_cat" id="tnom_cat" class="cajas_modal" placeholder="Ingrese Apellidos"><br>
        <input type="button" value="Guardar" id="bguardar_deudor">
    </div>
</body>
</html>
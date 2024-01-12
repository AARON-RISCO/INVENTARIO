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
    <title>Document</title>
</head>
<body>
    <div class="conteiner">
        <div class="datos_ventas">
            <label for="">Registrar Nueva Venta</label><br>
            <input type="text" class="cajas_ven" placeholder="" id="id_cod">
            <input type="text" class="cajas_ven" value="<?php echo date('Y-m-d') ?>" id="fecha">
            <input type="text" class="cajas_ven" value="<?php echo $_SESSION['nom'].' '.$_SESSION['ape'] ?>">
            <input type="text" class="cajas_ven" placeholder="Ingrese DNI del cliente" value="11111111">
            <input type="text" class="cajas_ven" placeholder="Nombres del cliente">
            <input type="text" class="cajas_ven" placeholder="Apellidos del cliente">
            <select name="" id="">
                <option value="0">PAGADA</option>
                <option value="1">PENDIENTE</option>
            </select>
            <select name="" id="tdeudores"></select><img src="img/agregar.png" style="width:30px; heigth:30px"> 
            <input type="text" class="cajas_ven" placeholder="Neto a pagar">
        </div>
        <div class="datos_det_ven">
                <div class="filtro">
                    <label for="">Ingrese Nombre del Producto</label>
                    <input type="text">
                </div>

                <div id="listado"> 
                    <table >
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Sabor</th>
                                <th>Categoria</th>
                                <th>Unidad Medida</th>
                                <th>Precio</th>
                                <th>Stock</th>
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
</body>
</html>
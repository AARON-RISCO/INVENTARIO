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
    <title>Document</title>
    <link rel="stylesheet" href="css/margen_ganancia.css">
    <script src="js/margen_ganancia.js"></script>
</head>
<body>
<div class="conteiner">
        <div class="datos_reporte_ventas">

            <input type="hidden" class="cajas_ven" value="<?php echo date('Y-m-d') ?>" id="fecha">
            <input type="hidden" value="<?php echo $_SESSION['dni']; ?>" id="dni_per">
            <input type="hidden" class="cajas_ven" value="<?php echo $_SESSION['nom'].' '.$_SESSION['ape'] ?>">


            <label for=""><b>MARGEN DE GANANCIA</b></label>
            <input type="text" class="cajas_ven MAYR" placeholder="Ingresa Titulo De tu Reporte" id="titrpv">
            
            <h5>Filtro por Nombre de Producto</h5>
            <input type="text" id="fnomp" class="cajas_ven MAYR" placeholder="Ingrese nombre de producto">
            
            <select name="" id="est_pago">
                <option value="">SLECCIONE RANGO DE STOCK(opcional)</option>
                <option value="1"> MAYOR O IGUAL A STOCK MINIMO</option>
                <option value="2"> MENOR O IGUAL A STOCK MINIMO</option>
            </select>
            <select name="" id="tcatpro" class="cajas_ven">

            </select>

            <select name="" id="testado" class="cajas_ven">
                <option value="">SELECCCIONE ESTADO(opcional)</option>
                <option value="0">HABILITADO</option>
                <option value="1">DESHABILITADO</option>
            </select>

            <!-- <div class="debe">
            <select name="" id="tdeudores"></select><img src="img/agregar.png" class="reg_deudores"> 
            </div> -->
            <!-- <input type="text" class="cajas_ven" placeholder="Neto a pagar" id="ttot"> -->
            
            <div class="botones">
                <input type="button" value="IMPRIMIR" class="btn-guardar btn" id="bimprimirv"> 
                <input type="button" value="CANCELAR" class="btn-cancelar btn" id="bcancelar_ven">
            </div>

        </div>
        <div class="datos_det_ven" id="contenido_reporte_venta">
        
                <div class="filtro_rpve" id="filtro_rpve">
                    <div class="logo_repv"><img src="img/logo.png" ><label>Academia Élite</label></div>    

                    <div class="fec_rep"><input type="text"  value="<?php  echo strftime('%A, %e %B %Y'); ?>" id="fecha" disabled></div>
                </div>
                <div class="titulo_rpve" id="titulo_rpve">
                    <h1 class="vtit_rpv" id="vtit_rpv"></h1>
                </div>
                
                <div id="listado_rema"> 
                    <table >
                        <thead>
                            <tr>
                                <th>#.</th>
                                <th>PRODUCTO</th>
                                <th>PRE.VENTA</th>
                                <th>CANT.</th>
                                <th>PRE.COMPRA</th>
                                <th>MARGEN/U</th>
                                <th>NETO</th>
                                
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_rema">
                            
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</body>
</html>     
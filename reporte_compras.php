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
    <link rel="stylesheet" href="css/reportes_ventas.css">
    <script src="js/procesos_rcompras.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="conteiner">
        <div class="datos_reporte_ventas">

            <input type="hidden" class="cajas_ven" value="<?php echo date('Y-m-d') ?>" id="fecha">
            <input type="hidden" value="<?php echo $_SESSION['dni']; ?>" id="dni_per">
            <input type="hidden" class="cajas_ven" value="<?php echo $_SESSION['nom'].' '.$_SESSION['ape'] ?>">

            <label for=""><b>CREA TU REPORTE DE COMPRAS</b></label>
            <input type="text" class="cajas_ven MAYR" placeholder="Ingresa Titulo De tu Reporte" id="titrpv">
            <label for="rangoFechas"><h5>selecciona rango de fecha</h5></label>
            <div class="ccajas_ven"><input type="date" id="rangoFechas" class="cajas_ven2"><input type="date" id="rangoFechas2" class="cajas_ven2"></div>

            <select name="" id="cvrp" class="cajas_ven"></select>
            
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
                
                <div id="listado_reve"> 
                    <table >
                        <thead>
                            <tr>
                                <th>COD.</th>
                                <th>PERSONAL</th>
                                <th>FECHA</th>
                                <th>NETO</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_reve">
                            
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
   
</body>
</html>
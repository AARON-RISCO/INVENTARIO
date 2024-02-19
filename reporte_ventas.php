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
    <script src="js/procesos_rventas.js"></script>
    <script src="js/cdnjs.cloudflare.com_ajax_libs_jQuery.print_1.6.0_jQuery.print.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="conteiner">
        <div class="datos_reporte_ventas">
            <?php
            // Establecer la zona horaria de Perú
            date_default_timezone_set('America/Lima');

            // Obtener la fecha actual en la zona horaria especificada
            $fecha_actual = date('Y-m-d');
            $fecha_actual2 = strftime('%A %e de %B del %Y');
            ?>
            <input type="hidden" class="cajas_ven" value="<?php echo $fecha_actual; ?>" id="fecha">
            <input type="hidden" value="<?php echo $_SESSION['dni']; ?>" id="dni_per">
            <input type="hidden" class="cajas_ven" value="<?php echo $_SESSION['nom'].' '.$_SESSION['ape'] ?>">


            <label for=""><b>CREA TU REPORTE DE VENTAS</b></label>
            <input type="text" class="cajas_ven MAYR" placeholder="Ingresa Titulo De tu Reporte" id="titrpv">
            <label for="rangoFechas"><h5>selecciona rango de fecha</h5></label>
            <div class="ccajas_ven"><input type="date" id="rangoFechas" class="cajas_ven2"><input type="date" id="rangoFechas2" class="cajas_ven2"></div>
            
            

            <select name="" id="cvrp" class="cajas_ven">
                
            </select>
            
            <!-- <input type="text" class="oculto" placeholder="Ingrese DNI del cliente" value="11111111" id="dni"> -->
            <!-- <input type="text" class="cajas_ven" placeholder="Cliente" id="cliente"> -->
            <select name="" id="est_pago">
                <option value="">SELECCCIONE ESTADO DE VENTA(opcional)</option>
                <option value="1">PAGADA</option>
                <option value="2">PENDIENTE</option>
            </select>
            <select name="" id="ttipo_pago" class="cajas_ven">
                <option value="">SELECCCIONE TIPO DE PAGO(opcional)</option>
                <option value="EFECTIVO">EFECTIVO</option>
                <option value="YAPE">YAPE</option>
                <option value="PENDIENTE">PENDIENTE</option>
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

                    <div class="fec_rep"><input type="text"  value="<?php  echo $fecha_actual2; ?>" id="fecha" disabled></div>
                </div>
                <div class="titulo_rpve" id="titulo_rpve">
                    <h1 class="vtit_rpv" id="vtit_rpv"></h1>
                </div>
                
                <div id="listado_reve" class="listado_reve"> 
                    <table >
                        <thead>
                            <tr>
                                <th>COD.</th>
                                <th>FECHA</th>
                                <th>CLIENTE</th>
                                <th>PERSONAL</th>
                                <th>TIPO PAGO</th>
                                <th>ESTADO</th>
                                <th>NETO</th>
                                <!-- <th>Opciones</th> -->
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_reve">
                            
                        </tbody>
                    </table>

                    
                </div>

                <div><input type="text" id="totvenre"></div>
        </div>
    </div>
    
  
</body>
</html>
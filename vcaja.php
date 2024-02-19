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
    <link rel="stylesheet" href="css/vcaja.css">
    <script src="js/procesos_vcaja.js"></script>
    <script src="https://kit.fontawesome.com/03a89292db.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<?php
            // Establecer la zona horaria de Perú
            date_default_timezone_set('America/Lima');
            // Obtener la fecha actual en la zona horaria especificada
            $fecha_actual = date('Y-m-d');
            ?>
<input type="hidden" value="<?php echo $fecha_actual ?>" id="fecha_hoy" >
<body>

    <div id="conteiner">
        <div class="listado">
                    <label for="">Listado Detalle de Caja</label>
                    
                    <div class="encabezado">
                        <div><h5>Fecha</h5><input type="date" name="" id="fecha_caja" class="encabe"></div>
                        <div><h5>Apertura</h5><input type="text" id="taper" class="encabe"></div>
                        <div><h5>Ingresos</h5><input type="text" id="tingr" class="encabe"></div>
                        <div><h5>Egresos</h5><input type="text" id="tegre" class="encabe"></div>
                        <div><h5>Total en Caja</h5><input type="text" id="ttot" class="encabe"></div>
                    </div>
                    <div id="listado_contenido"> 
                        <table >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Personal</th>
                                    <th>Movimiento</th>
                                    <th>Motivo</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_caja">
                                    
                            </tbody>
                        </table>
                    </div>
            
            <div>
                
            </div>
       </div>
       <div class="mantenimiento">
                <label>Registro de Movimientos de Caja</label>
                <input type="hidden" name="" id="id_de_caja">
                <input type="hidden" name="" id="dni_per" value="<?php echo $_SESSION['dni']; ?>">
                <div><h5>Nro caja</h5><input type="text" id="nro_caja" disabled></div>
                <input type="hidden" name="" id="id_deca">
                <div><h5>Personal</h5><input type="text" id="id_perso" value="<?php echo $_SESSION["nom"]." ".$_SESSION["ape"];?>" ></div>
                <div><h5>Tipo de Movimiento</h5>
                    <select id="tipo_mov" class="caja1t bloc2">
                        <option value="0">SELECCIONA TIPO DE MOVIMIENTO</option>
                        <option value="EGRESO">EGRESO</option>
                        <option value="INGRESO">INGRESO</option>
                    </select>
                    <input type="text" id="tvoc" class="caja2t bloc" disabled>
                </div>
                <div><h5>Motivo de Movimiento</h5><input type="text" id="motivo_m" class="bloc MAYR"  placeholder="Ingrese Motivo de Movimiento" disabled></div>
                <div><h5>Monto de Movimiento</h5><input type="text" id="total_mo" class="bloc NUMP" placeholder="Ingrese Monto de Movimiento" disabled></div>
                
                
               
                <!--Botones-->
                <div class="botones">
                    <input type="button" value="Nuevo" class="btn-nuevo  btn" id="bnuevo_ca">
                    <input type="button" value="Guardar" class="btn-guardar btn" id="bguardar_ca">
                    <input type="button" value="Actualizar" class="btn-modificar btn" id="bmodificar_ca">
                    <input type="button" value="Cancelar" class="btn-cancelar btn" id="bcancelar_ca">
                </div>  
                
       </div> 
    </div>

</body>
</html>
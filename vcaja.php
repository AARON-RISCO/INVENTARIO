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
<body>

    <div id="conteiner">
        <div class="listado">
            <div class="todos">
                    <label for="">Listado Detalle de Caja</label>
                    <div class="filtros">
                        <fieldset class="filtros_per">
                                <legend>Filtros</legend>
                                <div class="buscar_per"><input type="text" name="bus_dni" id="bus_dni" class="bus SN" placeholder="Buscar por Personal"></div>
                                <div class="buscar_per"><input type="date" name="bus_nom" id="bus_nom" class="bus MT" placeholder="Buscar por Fecha"></div>
                        </fieldset>
                    </div>
                    <div class="encabezado">
                        <div><h5>Fecha</h5><input type="date" name="" id="" disabled></div>
                        <div><h5>Apertura</h5><input type="text" disabled></div>
                        <div><h5>Ingresos</h5><input type="text" disabled></div>
                        <div><h5>Egresos</h5><input type="text" disabled></div>
                        <div><h5>Total</h5><input type="text" disabled></div>
                    </div>
                    <div id="listado"> 
                        <table >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Personal</th>
                                    <th>Ingresos</th>
                                    <th>Egresos</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_caja">
                                    
                            </tbody>
                        </table>
                    </div>
            </div>
            <div>
                
            </div>
       </div>
       <div class="mantenimiento">
                <label>Mantenimiento caja</label>
                <div><img src="" alt=""  class="da-usu"><input type="text" name="tdni_usu" id="tdni_usu" class="cajas-usu SN" ></div>
                <div><img src="" alt=""  class="da-usu"><input type="text" name="tape_usu" id="tape_usu" class="cajas-usu MT" ></div>
                <div><img src="" alt=""  class="da-usu"><input type="text" name="tnom_usu" id="tnom_usu" class="cajas-usu MT" ></div>
                <div>
                    <!-- <img src="" alt=""  class="da-usu"> -->
                    <select name="" id="ttipo">
                        <option value="0">SELECCIONE CARGO</option>
                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                        <option value="VENDEDOR">VENDEDOR</option>
                    </select>
                </div>
                <div><img src="" alt=""  class="da-usu"><input type="text" name="tclave" id="clave" class="cajas-usu " placeholder="Ingrese Contraseña"></div>
                
               
                <!--Botones-->
                <div class="botones">
                    <input type="button" value="Nuevo" class="btn-nuevo  btn" id="bnuevo_usu">
                    <input type="button" value="Guardar" class="btn-guardar btn" id="bguardar_usu">
                    <input type="button" value="Actualizar" class="btn-modificar btn" id="bmodificar_usu">
                    <input type="button" value="Cancelar" class="btn-cancelar btn" id="bcancelar_usu">
                </div>  
                
       </div> 
    </div>

</body>
</html>
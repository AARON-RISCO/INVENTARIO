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
    <link rel="stylesheet" href="css/personal.css">
    <script src="js/procesos_personal.js"></script>
    <script src="https://kit.fontawesome.com/03a89292db.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>

    <div id="conteiner">
        <div class="listado">
        <div class="todos">
                    <label for="">Todas los personal</label>
                    <div class="filtros">
                    <fieldset class="filtros_per">
                            <legend>Filtros</legend>
                            <div class="buscar_per"><input type="text" name="bus_dni" id="bus_dni" class="bus SN" placeholder="Buscar por DNI"></div>
                            <div class="buscar_per"><input type="text" name="bus_nom" id="bus_nom" class="bus MT" placeholder="Buscar por Nombres"></div>
                            <div class="buscar_per"><input type="text" name="bus_ape" id="bus_ape" class="bus MT" placeholder="Buscar por Apellidos"></div>         
                            <div class="buscar_per"><input type="text" name="bus_car" id="bus_car" class="bus MT " placeholder="Buscar por Cargo"></div> 
                    </fieldset>
                    </div>
                    <div id="listado"> 
                    <table >
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombres y Apellidos</th>
                                <th>Cargo</th>
                                <th>Estado</th>
                                <th>Contraseña</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_personal">
                            
                        </tbody>
                    </table>
            </div>
        </div>
       </div>
       <div class="mantenimiento">
                <label>Mantenimiento personal</label><br>
                <img src="" alt=""  class="da-usu"><input type="text" name="tdni_usu" id="tdni_usu" class="cajas-usu SN" placeholder="Ingrese DNI">
                <img src="" alt=""  class="da-usu"><input type="text" name="tape_usu" id="tape_usu" class="cajas-usu MT" placeholder="Ingrese Apellidos">
                <img src="" alt=""  class="da-usu"><input type="text" name="tnom_usu" id="tnom_usu" class="cajas-usu MT" placeholder="Ingrese Nombres">
                <div class="bloquear"><img src="" alt=""  class="da-usu"><select name="" id="ttipo">
                    <option value="0">SELECCIONE CARGO</option>
                    <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                    <option value="VENDEDOR">VENDEDOR</option>
                </select></div>
                <img src="" alt=""  class="da-usu"><input type="text" name="tclave" id="clave" class="cajas-usu " placeholder="Ingrese Contraseña">
                <div id="icono" class="bloquear"><svg id="slash" xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><path d="M5.1 9.2C13.3-1.2 28.4-3.1 38.8 5.1l592 464c10.4 8.2 12.3 23.3 4.1 33.7s-23.3 12.3-33.7 4.1L9.2 42.9C-1.2 34.7-3.1 19.6 5.1 9.2z"/></svg><svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg></div>
                
                <!--Botones-->
                <div class="botones">
                <input type="button" value="Nuevo" class="btn-nuevo  btn" id="bnuevo_usu">
                <input type="button" value="Guardar" class="btn-guardar btn" id="bguardar_usu">
                <input type="button" value="Actualizar" class="btn-modificar btn" id="bmodificar_usu">
                <input type="button" value="Cancelar" class="btn-cancelar btn" id="bcancelar_usu">
                </div>
                
       </div> 
    </div>
    <div id="sombra_modal_per" class="sombra_modal_per">
        
    </div>
    <div id="caja_modal_per" class="caja_modal_per">
        <p id="namcamo" class="msjmod"> </p>
        <button id="bamo" class="botomo bos"> ACEPTAR</button>   
        <button id="bcamo"class="botomo2 bos"> CANCELAR</button>
        <input type="hidden" name="" id="idce">
        <input type="hidden" name="" id="estadocategoriamo">
    </div>
    <script src="js/main.js"></script>
</body>
</html>
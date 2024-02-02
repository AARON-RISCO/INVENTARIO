<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/personal.css">
    <script src="js/procesos_personal.js"></script>
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
                            <div class="buscar_per"><input type="text" name="bus_nom" id="bus_nom" class="bus MTU" placeholder="Buscar por DNI"></div>
                            <div class="buscar_per"><input type="text" name="bus_nom" id="bus_nom" class="bus MTU" placeholder="Buscar por Nombres"></div>
                            <div class="buscar_per"><input type="text" name="bus_ape" id="bus_ape" class="bus MTU" placeholder="Buscar por Apellidos"></div>         
                            <div class="buscar_per"><input type="text" name="bus_ape" id="bus_ape" class="bus MTU" placeholder="Buscar por Cargo"></div> 
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
                <img src="" alt=""  class="da-usu"><input type="text" name="tnom_usu" id="tnom_usu" class="cajas-usu MT" placeholder="Ingrese DNI">
                <img src="" alt=""  class="da-usu"><input type="text" name="tnom_usu" id="tnom_usu" class="cajas-usu MT" placeholder="Ingrese Apellidos">
                <img src="" alt=""  class="da-usu"><input type="text" name="tnom_usu" id="tnom_usu" class="cajas-usu MT" placeholder="Ingrese Nombres">
                <img src="" alt=""  class="da-usu"><select name="" id="ttipo" class="cajas-usu">
                    <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                    <option value="VENDEDOR">VENDEDOR</option>
                </select>
                <img src="" alt=""  class="da-usu"><input type="password" name="tnom_usu" id="tnom_usu" class="cajas-usu MT" placeholder="Ingrese Contraseña">
                
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
</body>
</html>
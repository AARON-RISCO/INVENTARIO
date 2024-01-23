<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/deudores.css">
    <script src="js/procesos_deudores.js"></script>
    <title>Document</title>
</head>
<body>

    <div id="conteiner">
        
        <div class="listado">
        <div class="todos">
                    <label for="" id="todos_deudores">Todos los deudores</label> <label for="" id="ruta"></label>
                    <div class="todos_todos">
                    <fieldset class="filtros_deudores">
                        <legend>Filtros</legend>
                            <div class="buscar_deudores"><input type="text" name="bus_nom" id="bus_nom" class="bus MAYP" placeholder="Buscar por Nombre"></div>
                            <div class="buscar_deudores"><input type="text" name="bus_sa" id="bus_ape" class="bus MAYP" placeholder="Buscar por Apellidos"></div>         
                    </fieldset>
                    <div id="listado"> 
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apllidos</th>
                                    <th>Total de Deuda</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_deudores">
                                
                            </tbody>
                        </table>
                    </div> 
                    </div>
                    <div class="todos_detalle">
                        <div id="listado_detalle"> 
                            <table id="detalle">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Vendedor</th>
                                        <th>Deuda</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpo_tabla_detalle_deudores">
                                    
                                </tbody>
                            </table>
                        </div> 
                    </div>
        </div>    
        </div>
        
       <div class="mantenimiento">
                <label>Mantenimiento Deudores</label><br>
                <img src="" alt=""  class="da-pro"><input type="text" name="tnom_deu" id="tnom_deu" class="cajas-pro MAYP" placeholder="Ingrese nombre">
                <img src="" alt=""  class="da-pro"><input type="text" name="tape_deu" id="tape_deu" class="cajas-pro MAYP" placeholder="Ingrese Apellidos">
                <input type="text" class="oculto2 esconder">
                <input type="text" class="oculto esconder">
                <div class="botones">
                <input type="button" value="Nuevo" class="btn-nuevo  btn" id="bnuevo_deu">
                <input type="button" value="Guardar" class="btn-guardar btn" id="bguardar_deu">
                <input type="button" value="Actualizar" class="btn-modificar btn" id="bmodificar_deu">
                <input type="button" value="Cancelar" class="btn-cancelar btn" id="bcancelar_deu">
                </div>
                
       </div> 
    </div>
</body>
</html>
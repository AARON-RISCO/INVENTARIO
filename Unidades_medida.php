<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/unidades.css">
    <script src="js/procesos_unidades.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="conteiner">
        <div class="listado">
        <div class="todos">
                    <label for="">Todas las Unidades de Medidas</label>
                    <div class="filtros">
                        <label for="" class="fil">Filtros</label>   
                        <div class="buscar"><input type="text" name="bus_nom" id="bus_nom" class="bus MTU" placeholder="Buscar por Nombre"></div>
                    </div>
                    <div id="listado"> 
                    <table >
                        <thead>
                            <tr>
                                <th>Unidad</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_unidades">
                            
                        </tbody>
                    </table>
            </div>
        </div>
       </div>
       <div class="mantenimiento">
                <label>Mantenimiento Unidades</label><br>
                <input type="text" id="tcod">
                <img src="" alt=""  class="da-cat"><input type="text" name="tnom_uni" id="tnom_uni" class="cajas-uni MTU" placeholder="Ingrese Nombre de Unidad">
                
                <!--Botones-->
                <div class="botones">
                <input type="button" value="Nuevo" class="btn-nuevo  btn" id="bnuevo_uni">
                <input type="button" value="Guardar" class="btn-guardar btn" id="bguardar_uni">
                <input type="button" value="Actualizar" class="btn-modificar btn" id="bmodificar_uni">
                <input type="button" value="Cancelar" class="btn-cancelar btn" id="bcancelar_uni">
                </div>
                
       </div> 
    </div>
    <div id="sombra_modal_uni" class="sombra_modal_uni">
        
    </div>
    <div id="caja_modal_uni" class="caja_modal_uni">
        <p id="namuni" class="msjmuni"> </p>
        <button id="bacun" class="botoun bosu"> ACEPTAR</button>   
        <button id="bcaun"class="botoun2 bosu"> CANCELAR</button>
        <input type="hidden" name="" id="idunim">
        <input type="hidden" name="" id="estunimod">
    </div>
    
</body>
</html>
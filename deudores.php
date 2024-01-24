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
                            <input type="text" class="oculto2 esconder">
                            <input type="text" class="oculto esconder">
                        </div> 
                    </div>
        </div>    
        </div>
        
    </div>
    <div id="sombra_modal_vventas" class="sombra_modal_vventas">
        
        </div>
        <div id="caja_modal_vventas" class="caja_modal_vventas">
            <table >
                <caption><b class="iddv" ></b> </caption>
                <thead>
                    <tr>
                        <th>CANT.</th>
                        <th>PROD.</th>
                        <th>PRE.U</th>
                        <th>ICE</th>
                        <th>TOT.</th>
                    </tr>
                </thead>
                <tbody id="cuerpo_tabla_vdventa">
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan=4>TOTAL DE LA VENTA</td>
                        <td><label id="ttdv" class="ttdv"></label></td>
                    </tr>
                </tfoot>
            </table>
            <p id="namuni" class="msjmuni"> </p>

            <div id="conteiner-boto" class="conteiner-boto">  
                <button id="bcavv"class="botovv2 bosv"> CERRAR DETALLE</button>
            </div>
            
            <input type="hidden" name="" id="tdeu">
            <input type="hidden" name="" id="teve">
            <input type="hidden" name="" id="tnee">
        </div>
</body>
</html>
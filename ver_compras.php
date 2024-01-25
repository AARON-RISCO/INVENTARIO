<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vcompras.css">
    <script src="js/procesos_vcompras.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="conteiner_vcompras">
    
        <div class="listado_vcompras">
            <div class="todos">
                    <label for=""><b>VISUALIZACION DE TODAS LAS COMPRAS</b></label>
                    <fieldset class="filtros_vcompras">
                        <legend>Filtros Para Ver Compras</legend>
                        <!-- <div class="buscar_vcompras">
                            <select name="tdesav" id="tdesav" class="bus_vcompras" > 
                                <option value="0">SELECCIONA ESTADO VENTA</option>
                                <option value="1">PAGADO</option>
                                <option value="2">PENDIENTE</option>
                            </select>
                        </div>  -->
                        <div class="buscar_vcompras">
                            <select name="ttfil" id="ttfil" class="bus_vcompras" > 
                                <option value="0">SELECCIONA TIPO DE FILTRO</option>
                                <option value="1">POR NOMBRE</option>
                                <option value="2">POR FECHA</option>
                            </select>
                        </div> 
                        <div class="buscar_vcompras uni2"><input type="text" name="bus_nom" id="bus_nom" class="bus_vcompras MTU" placeholder="Buscar por Nombre"></div>
                        <div class="buscar_vcompras uni"><input type="date" name="bus_date" id="bus_fec" class="bus_vcompras MTU" ></div>
                        <div class="buscar_vcompras uni"><input type="date" name="bus_date2" id="bus_fec2" class="bus_vcompras MTU" ></div>

                    </fieldset>
                    <div id="listado"> 
                        
                    <div class="conteiner_tab">
                        <table >
                            <thead>
                                <tr>
                                    <th>Nro.</th>
                                    <th>Personal</th>
                                    <th>Fecha </th>
                                    <th>Total Compra </th>
                                    <th>Opciones </th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_vcompras">
                                
                            </tbody>
                        </table>
                    </div>
                    
            </div>
        </div>
       </div>
        
    </div>
    <div id="sombra_modal_vcompras" class="sombra_modal_vcompras">
        
    </div>
    <div id="caja_modal_vcompras" class="caja_modal_vcompras">
        <table >
            <caption><b class=iddv ></b> </caption>
            <input type="hidden" name="" id="tcodc">
            <thead>
                <tr>
                    <th>NRO</th>
                    <th>PROD.</th>
                    <th>CANT.</th>
                    <th>PRE.U.COMPRA</th>
                    <th>TOT.</th>
                </tr>
            </thead>
            <tbody id="cuerpo_tabla_vdcompra">
                
            </tbody>
            <tfoot>
                <tr>
                    <td colspan=4>TOTAL DE LA COMPRA</td>
                    <td><input type="text" name="ttdv" id="ttdv" disabled></td>
                </tr>
            </tfoot>
        </table>
        <p id="namuni" class="msjmuni"> </p>
        <div id="conteiner-boto" class="conteiner-boto">
            <!-- <button id="bacvv" class="botovv bosv"> PAGAR DEUDA</button>    -->
            <button id="bcavv"class="botovv2 bosv"> CERRAR DETALLE</button>
        </div>
        
        <input type="hidden" name="" id="tdeu">
        <input type="hidden" name="" id="teve">
        <input type="hidden" name="" id="tnee">
    </div>
    
</body>
</html>
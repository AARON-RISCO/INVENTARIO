<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ver_ventas.css">
    <script src="js/procesos_vventas.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="conteiner_vventas">
   
        <div class="listado_vventas">
        <div class="todos">
                    <label for="">VISUALIZACION DE TODAS LAS VENTAS</label>
                    <fieldset class="filtros_vventas">
                        <legend>FILTRO PARA VER VENTAS</legend>
                        <div class="buscar_vventas">
                            <select name="tdesav" id="tdesav" class="bus_vventas" > 
                                <option value="0">SELECCIONA ESTADO VENTA</option>
                                <option value="1">PAGADO</option>
                                <option value="2">PENDIENTE</option>
                            </select>
                        </div> 
                        <div class="buscar_vventas">
                            <select name="ttfil" id="ttfil" class="bus_vventas" > 
                                <option value="0">SELECCIONA TIPO DE FILTRO</option>
                                <option value="1">POR NOMBRE</option>
                                <option value="2">POR FECHA</option>
                                <option value="3">POR TIPO DE PAGO</option>
                            </select>
                        </div> 
                        <div class="buscar_vventas uni2"><input type="text" name="bus_nom" id="bus_nom" class="bus_vventas MTU" placeholder="Buscar por Personal"></div>
                        <div class="buscar_vventas uni"><input type="date" name="bus_date" id="bus_fec" class="bus_vventas MTU" ></div>
                        <div class="buscar_vventas uni"><input type="date" name="bus_date2" id="bus_fec2" class="bus_vventas MTU" ></div>
                        <div class="buscar_vventas uni3" ><img src="img/dinero.png" alt="pagos en efectivo" class="bototp" id="bototp" data-cod="EFECTIVO"><img src="img/yape.png" alt="pagos en yape" data-cod="YAPE" class="bototp" id="bototp2"></div>

                    </fieldset>
                    <div id="listado"> 
                        
                    <div class="conteiner_tab">
                        <table >
                            <thead>
                                <tr>
                                    <th>Nro.</th>
                                    <th>Cliente</th>
                                    <th>Fecha </th>
                                    <th>Personal </th>
                                    <th>Tipo Pago </th>
                                    <th>Estado </th>
                                    <th>Opciones </th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_vventas">
                                
                            </tbody>
                        </table>
                    </div>
                    
            </div>
        </div>
       </div>
        
    </div>
    <div id="sombra_modal_vventas" class="sombra_modal_vventas">
        
    </div>
    <div id="caja_modal_vventas" class="caja_modal_vventas">
        <table >
            <caption><b class=iddv ></b> <input type="text" name="ttes" id="ttes" disabled></caption>
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
                    <td><input type="text" name="ttdv" id="ttdv" disabled></td>
                </tr>
            </tfoot>
        </table>
        <p id="namuni" class="msjmuni"> </p>
        <div id="conteiner-boto" class="conteiner-boto">
            <button id="bacvv" class="botovv bosv"> PAGAR DEUDA</button>   
            <button id="bcavv"class="botovv2 bosv"> CERRAR DETALLE</button>
        </div>
        
        <input type="hidden" name="" id="tdeu">
        <input type="hidden" name="" id="teve">
        <input type="hidden" name="" id="tnee">
    </div>
    
</body>
</html>
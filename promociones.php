<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/promociones.css">
    <script src="js/procesos_promociones.js"></script>
    <title>Document</title>
</head>
<body>

    <div id="conteiner">
        
        <div class="listado">
        <div class="todos">
                    <label for="" id="todos_promo">Todas las Promociones</label> <label for="" id="ruta"></label>
                    <div class="todos_todos">
                    <fieldset class="filtros_promo">
                        <legend>Filtros</legend>
                            <div class="buscar_promo"><input type="text" name="bus_nom" id="bus_nom" class="bus MAYP" placeholder="Buscar por Producto"></div>
                            <div class="buscar_promo"><input type="text" name="bus_sa" id="bus_ape" class="bus MAYP" placeholder="Buscar por Sabores"></div>         
                        </fieldset>
                    </div>
                    <div id="listado"> 
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Sabor</th>
                                <th>Cantidad</th>
                                <th>Precios</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_promociones">
                            
                        </tbody>
                    </table>
            </div>
        </div>
       </div>
       <div class="mantenimiento">
                <label>Mantenimiento Promociones</label><br>
                <input type="text" id="tcod">
                <img src="" alt=""  class="da-promo"><input type="text" name="tnom" id="tnom" class="cajas-promo MAYP" placeholder="Ingrese nombre">
                <img src="" alt=""  class="da-promo"><input type="text" name="tcan" id="tcan" class="cajas-promo NUMP" placeholder="Ingrese Cantidad">
                <img src="" alt=""  class="da-promo"><input type="text" name="tpre" id="tpre" class="cajas-promo NUMP" placeholder="Ingrese Precio">
                
                <div class="botones">
                <input type="button" value="Nuevo" class="btn-nuevo  btn" id="bnuevo_promo">
                <input type="button" value="Guardar" class="btn-guardar btn" id="bguardar_promo">
                <input type="button" value="Actualizar" class="btn-modificar btn" id="bmodificar_promo">
                <input type="button" value="Cancelar" class="btn-cancelar btn" id="bcancelar_promo">
                </div>
                
       </div> 
    </div>
    <!-- <div class="fondo"></div> -->
    <!--Ventana modal de agregar nueva categoria-->
    <!-- <div class="modal">
        <img src="img/cerrar2.svg" alt="" class="cerrar_modal">
        <label>Agregar nueva categoria</label><br>
        <input type="text" name="tnom_cat" id="tnom_cat" placeholder="Ingrese Nombre de categoria"><br>
        <input type="button" value="Guardar" id="bguardar_cat">
    </div>
    <div class="modal_uni">
        <img src="img/cerrar2.svg" alt="" class="cerrar_modal_uni">
        <label>Agregar nueva Unidad de Medida</label><br>
        <input type="text" name="tnom_uni" id="tnom_uni" placeholder="Ingrese Nombre de Unidad"><br>
        <input type="button" value="Guardar" id="bguardar_uni">
    </div>

    <div id="sombra_modal_pro" class="sombra_modal_pro">
        
    </div>
    <div id="caja_modal_pro" class="caja_modal_pro">
        <p id="nampro" class="msjpro"> </p>
        <button id="bapro" class="botpro bop"> ACEPTAR</button>   
        <button id="bcpro"class="botpro2 bop"> CANCELAR</button>
        <input type="hidden" name="" id="idcpro">
        <input type="hidden" name="" id="estpromo">
    </div> -->

</body>
</html>
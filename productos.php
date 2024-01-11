<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/productos.css">
    <script src="js/procesos_productos.js"></script>
    <title>Document</title>
</head>
<body>

    <div id="conteiner">
        
        <div class="listado">
        <div class="todos">
                    <label for="">Todos los productos</label>
                    <div class="filtros">
                        <label for="" class="fil">Filtros</label>   
                        <div class="buscar"><select name="tcat" id="tcategoria" class="bus" ></select></div>
                        <div class="buscar"><input type="text" name="bus_nom" id="bus_nom" class="bus" placeholder="Buscar por Nombre"></div>
                        <div class="buscar"><input type="text" name="bus_sa" id="bus_sa" class="bus" placeholder="Buscar por Sabores"></div>
                    </div>
                    <div id="listado"> 
                    <table >
                        <thead>
                            <tr>
                                <th>Categoria</th>
                                <th>Nombre</th>
                                <th>Sabores</th>
                                <th>Unidad Medida</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_productos">
                            
                        </tbody>
                    </table>
            </div>
        </div>
       </div>
       <div class="mantenimiento">
                <label>Mantenimiento Producto</label><br>
                <input type="text" id="tcod">
                <select name="tcat" id="tcat" class="cajas-pro cajas"></select></select><div id="ir_cat" class="ir_cat ir"> <img src="img/agregar.png" id="icon-suma" ></div>
                <img src="" alt=""  class="da-pro"><input type="text" name="tnom_pro" id="tnom_pro" class="cajas-pro" placeholder="Ingrese nombre">
                <img src="" alt=""  class="da-pro"><input type="text" name="tsabor" id="tsabor" class="cajas-pro" placeholder="Ingrese sabor">
                <select name="tuni" id="tuni" class="cajas-pro cajas"></select></select><div id="ir_uni" class="ir_uni ir"><img src="img/agregar.png" id="icon-suma"></div>
                <img src="" alt=""  class="da-pro"><input type="text" name="tpre" id="tpre" class="cajas-pro" placeholder="Ingrese precio">
                <img src="" alt=""  class="da-pro"><input type="text" name="tstock_min" id="tstock_min" class="cajas-pro" placeholder="Ingrese Stock Minimo">
                <img src="" alt=""  class="da-pro"><input type="text" name="tstock" id="tstock" class="cajas-pro" placeholder="Ingrese Stock">
                
                <div class="botones">
                <input type="button" value="Nuevo" class="btn-nuevo  btn" id="bnuevo_pro">
                <input type="button" value="Guardar" class="btn-guardar btn" id="bguardar_pro">
                <input type="button" value="Actualizar" class="btn-modificar btn" id="bmodificar_pro">
                <input type="button" value="Cancelar" class="btn-cancelar btn" id="bcancelar_pro">
                </div>
                
       </div> 
    </div>
    <div class="fondo"></div>
    <!--Ventana modal de agregar nueva categoria-->
    <div class="modal">
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
</body>
</html>
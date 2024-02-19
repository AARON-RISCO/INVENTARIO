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
    <link rel="stylesheet" href="css/categorias.css">
    <script src="js/procesos_categorias.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="conteiner">
        <div class="listado">
        <div class="todos">
                    <label for="">Todas las categorias</label>
                    <fieldset class="filtros">
                        <legend>Filtros</legend>
                        <div class="buscar"><input type="text" name="bus_nom" id="bus_nom" class="bus MT" placeholder="Buscar por Nombre"></div>
                    </fieldset>
                    <div id="listado"> 
                    <table >
                        <thead>
                            <tr>
                                <th>Categoria</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_tabla_categorias">
                            
                        </tbody>
                    </table>
            </div>
        </div>
       </div>
       <div class="mantenimiento">
                <label>Mantenimiento Categorias</label><br>
                <input type="text" id="tcod">
                <img src="" alt=""  class="da-cat"><input type="text" name="tnom_cat" id="tnom_cat" class="cajas-cat MT" placeholder="Ingrese Nombre de categoria">
                
                <!--Botones-->
                <div class="botones">
                <input type="button" value="Nuevo" class="btn-nuevo  btn" id="bnuevo_cat">
                <input type="button" value="Guardar" class="btn-guardar btn" id="bguardar_cat">
                <input type="button" value="Actualizar" class="btn-modificar btn" id="bmodificar_cat">
                <input type="button" value="Cancelar" class="btn-cancelar btn" id="bcancelar_cat">
                </div>
                
       </div> 
    </div>
    <div id="sombra_modal_cat" class="sombra_modal_cat">
        
    </div>
    <div id="caja_modal_cat" class="caja_modal_cat">
        <p id="namcamo" class="msjmod"> </p>
        <button id="bamo" class="botomo bos"> ACEPTAR</button>   
        <button id="bcamo"class="botomo2 bos"> CANCELAR</button>
        <input type="hidden" name="" id="idce">
        <input type="hidden" name="" id="estadocategoriamo">
    </div>
</body>
</html>
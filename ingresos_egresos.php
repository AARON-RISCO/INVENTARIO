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
    <link rel="stylesheet" href="css/in_eg.css">
    <script src="js/procesos_in_eg.js"></script>
    <title>Document</title>
</head>
<body>

    <div id="conteiner">
        <div class="mantenimiento">
            <fieldset class="field_caja">
                <legend> FILTRO DE CAJA</legend>
                <div class="cajas_ie">
                    <h5>RANGO DE FECHA CAJA</h5><br>
                    <div><input type="date" name="" id="tfci"><input type="date" name="" id="tfcf"></div>
                </div>
                
            </fieldset>
              
                
        </div> 
        <div class="listado_con">
                    
                   
                    <div id="listado_contenido_egin" class="listado_contenido_egin">    
                        <table >
                            <caption>LISTADO DE CAJAS</caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha Caja</th>
                                    <th>Apertura</th>
                                    <th>Ingresos</th>
                                    <th>Egresos</th>
                                    <th>Total</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_caja_cab">
                                    
                            </tbody>
                        </table>
                    </div>
            
       </div>
        
      
       
    </div>
    <div id="fondo_mc" class="fondo_mc">
        <div id="modal_caja" class="modal_caja">
            <div class="contic">
                 <div class="titcm">Detalle de Caja</div> <div class="ccm">X</div>
            </div>
            <div>
                <table >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Personal</th>
                            <th>Tipo Movimiento</th>
                            <th>Motivo</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo_tabla_dectca">

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
</body>
</html>
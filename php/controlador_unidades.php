<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];
//LLENAR UNIDADES
if ($opcion=="listar_unidades") {
        $listar="SELECT * fROM unidad_medida ORDER BY tipo_uni";
        $resultado=mysqli_query($cnn,$listar) or die("Error en listar");    
        echo "<option value='0'> SELECCIONE TIPO DE UNIDAD </option>";
        while ($fila=mysqli_fetch_array($resultado)) {
           $cod=$fila['id_uni'];    
           $nom=$fila['tipo_uni'];
           echo "<option value='".$cod."'>".$nom."</option>";
        }
}

?>
<?php
include("../conexion/conexion.php");
$opcion=$_GET['opcion'];

if($opcion=="listarv"){

    if(isset($_GET['f1']) && isset($_GET['f2'])){
        $f1=$_GET['f1'];
        $f2=$_GET['f2'];
           
        $con_listar_v = "SELECT t1.*, t3.ape_per, t3.nom_per
                    FROM compra as t1, personal as t3
                    WHERE t1.fecha_compra BETWEEN ? and ? 
                        AND t3.dni_per = t1.dni_per";

                    if(isset($_GET['cp']) && !empty($_GET['cp'])){
                        $cod = $_GET['cp'];
                        $con_listar_v .= " AND t1.dni_per = '$cod'";
                    }
                
                        $con_listar_v .= " ORDER BY t1.cod_compra ASC";
            // Utilizar parámetros preparados para evitar inyección de SQL
            $stmt = mysqli_prepare($cnn, $con_listar_v);
            mysqli_stmt_bind_param($stmt, 'ss' ,$f1,$f2);
            mysqli_stmt_execute($stmt);
    
            $res = mysqli_stmt_get_result($stmt);
    }
    
    
    $num = mysqli_num_rows($res);

    
        if ($num >= 1) {
            while ($f = mysqli_fetch_array($res)) {
                $json[] = array(
                    "cod" => $f['cod_compra'],
                    "fec" => $f['fecha_compra'],                    
                    "neto" => $f['total_general'],                    
                    "nomp" => $f['nom_per']." ".$f['ape_per'],                    
                );
            }
            $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
        } else {
            $jsonresponse = "vacio";
        }
        echo $jsonresponse;

}


if($opcion=="listar_per"){
    $consulta_per="SELECT dni_per, ape_per, nom_per, estado_per FROM personal ";
    $res=mysqli_query($cnn,$consulta_per);
    $num=mysqli_num_rows($res);
    echo "<option value=''> Selecciona Vendedor a Filtrar (opcional)</option>";   
        while($f=mysqli_fetch_array($res)){
            $dnip=$f['dni_per'];
            $nomp=$f['nom_per']." ".$f['ape_per'];
            $esta=$f['estado_per'];
            if($esta=="ACTIVO"){
                echo "<option value='".$dnip."'>".$nomp."</option>";
            }
        }

}



?>
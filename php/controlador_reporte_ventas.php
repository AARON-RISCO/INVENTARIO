<?php
include("../conexion/conexion.php");
$opcion=$_GET['opcion'];

if($opcion=="listarv"){

    if(isset($_GET['f1']) && isset($_GET['f2'])){
        $f1=$_GET['f1'];
        $f2=$_GET['f2'];
           
        $con_listar_v = "SELECT t1.*, t2.ape_cli, t2.nom_cli, t3.ape_per, t3.nom_per, t4.nom_deudor, t4.apellidos_deudor
                    FROM venta as t1, cliente as t2, personal as t3, deudores as t4
                    WHERE t1.fecha_venta BETWEEN ? and ? 
                        AND t2.dni_cli = t1.dni_cli 
                        AND t3.dni_per = t1.dni_per 
                        AND t4.id_deudor = t1.id_deudor";

                    if(isset($_GET['cp']) && !empty($_GET['cp'])){
                        $cod = $_GET['cp'];
                        $con_listar_v .= " AND t1.dni_per = '$cod'";
                    }
                    if(isset($_GET['ep']) && !empty($_GET['ep'])){
                        $ep = $_GET['ep'];
                        $con_listar_v .= " AND t1.estado = '$ep'";
                    }
                    if(isset($_GET['tp']) && !empty($_GET['tp'])){
                        $tp = $_GET['tp'];
                        $con_listar_v .= " AND t1.tipo_pago = '$tp'";
                    }

                        $con_listar_v .= " ORDER BY t1.id_venta ASC";
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
                    "cod" => $f['id_venta'],
                    "fec" => $f['fecha_venta'],
                    // "dnic" => $f['dni_cli'],
                    // "dnip" => $f['dni_per'],
                    "estd" => $f['estado'],
                    "idde" => $f['id_deudor'],
                    "neto" => $f['neto'],
                    "tpve" => $f['tipo_pago'],
                    "nomc" => $f['nom_cli']." ".$f['ape_cli'],
                    "nomp" => $f['nom_per']." ".$f['ape_per'],
                    "nomd" => $f['nom_deudor']." ".$f['apellidos_deudor'],
                );
            }
            $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
        } else {
            $jsonresponse = "vacio";
        }
        echo $jsonresponse;

}


// if($opcion=="listar"){

//     $con_listar_v="SELECT t1.*,t2.ape_cli,t2.nom_cli,t3.ape_per,t3.nom_per, t4.nom_deudor,t4.apellidos_deudor
//                    FROM venta as t1 , cliente as t2, personal as t3, deudores as t4
//                    WHERE  t2.dni_cli=t1.dni_cli and t3.dni_per=t1.dni_per and t4.id_deudor=t1.id_deudor ORDER BY t1.id_venta ASC";
//         $res=mysqli_query($cnn,$con_listar_v);


//     if($_GET['esta'] > 0){
//         $est=$_GET['esta'];
//         $con_listar_v="SELECT t1.*,t2.ape_cli,t2.nom_cli,t3.ape_per,t3.nom_per, t4.nom_deudor,t4.apellidos_deudor
//                        FROM venta as t1 , cliente as t2, personal as t3, deudores as t4
//                        WHERE t1.estado=? and t2.dni_cli=t1.dni_cli and t3.dni_per=t1.dni_per and t4.id_deudor=t1.id_deudor ORDER BY t1.id_venta ASC";
    
//             // Utilizar parámetros preparados para evitar inyección de SQL
//             $stmt = mysqli_prepare($cnn, $con_listar_v);
//             mysqli_stmt_bind_param($stmt, 'i' ,$est);
//             mysqli_stmt_execute($stmt);
    
//             $res = mysqli_stmt_get_result($stmt);

//     }
//     if(isset($_GET['name'])){
//         $name=$_GET['name'];
//         $con_listar_v="SELECT t1.*,t2.ape_cli,t2.nom_cli,t3.ape_per,t3.nom_per, t4.nom_deudor,t4.apellidos_deudor
//                        FROM venta as t1 , cliente as t2, personal as t3, deudores as t4
//                        WHERE t2.nom_cli LIKE CONCAT(?, '%')  and t2.dni_cli=t1.dni_cli and t3.dni_per=t1.dni_per and t4.id_deudor=t1.id_deudor ORDER BY t1.id_venta ASC";

//         // Utilizar parámetros preparados para evitar inyección de SQL
//         $stmt = mysqli_prepare($cnn, $con_listar_v);
//         mysqli_stmt_bind_param($stmt, 's' ,$name);
//         mysqli_stmt_execute($stmt);

//         $res = mysqli_stmt_get_result($stmt);

//     }
//     if(isset($_GET['fe1'])){
//             $fei=$_GET['name'];
//             $fef=$_GET['fe1'];
//             $con_listar_v="SELECT t1.*,t2.ape_cli,t2.nom_cli,t3.ape_per,t3.nom_per, t4.nom_deudor,t4.apellidos_deudor
//             FROM venta as t1 , cliente as t2, personal as t3, deudores as t4
//             WHERE t1.fecha_venta BETWEEN ? and ? AND t2.dni_cli=t1.dni_cli AND t3.dni_per=t1.dni_per AND t4.id_deudor=t1.id_deudor 
//             ORDER BY t1.id_venta ASC";
    
            

//             // Utilizar parámetros preparados para evitar inyección de SQL
//             $stmt = mysqli_prepare($cnn, $con_listar_v);
//             mysqli_stmt_bind_param($stmt, 'ss' ,$fei,$fef);
//             mysqli_stmt_execute($stmt);
    
//             $res = mysqli_stmt_get_result($stmt);
    
    
//     }
//     if(isset($_GET['tp'])){
//         $est=$_GET['tp'];
//         $con_listar_v="SELECT t1.*,t2.ape_cli,t2.nom_cli,t3.ape_per,t3.nom_per, t4.nom_deudor,t4.apellidos_deudor
//                        FROM venta as t1 , cliente as t2, personal as t3, deudores as t4
//                        WHERE t1.tipo_pago=? and t2.dni_cli=t1.dni_cli and t3.dni_per=t1.dni_per and t4.id_deudor=t1.id_deudor ORDER BY t1.id_venta ASC";
    
//             // Utilizar parámetros preparados para evitar inyección de SQL
//             $stmt = mysqli_prepare($cnn, $con_listar_v);
//             mysqli_stmt_bind_param($stmt, 's' ,$est);
//             mysqli_stmt_execute($stmt);
    
//             $res = mysqli_stmt_get_result($stmt);
//     }

//     $num = mysqli_num_rows($res);

    
//     if ($num >= 1) {
//         while ($f = mysqli_fetch_array($res)) {
//             $json[] = array(
//                 "cod" => $f['id_venta'],
//                 "fec" => $f['fecha_venta'],
//                 "dnic" => $f['dni_cli'],
//                 "dnip" => $f['dni_per'],
//                 "estd" => $f['estado'],
//                 "idde" => $f['id_deudor'],
//                 "neto" => $f['neto'],
//                 "tpve" => $f['tipo_pago'],
//                 "nomc" => $f['nom_cli']." ".$f['ape_cli'],
//                 "nomp" => $f['nom_per']." ".$f['ape_per'],
//                 "nomd" => $f['nom_deudor']." ".$f['apellidos_deudor'],
//             );
//         }
//         $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
//     } else {
//         $jsonresponse = "vacio";
//     }
//     echo $jsonresponse;

// }
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
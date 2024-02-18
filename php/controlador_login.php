<?php 
session_start();

if (!empty($_POST["bacceder"])) {
    
     if (!empty($_POST["dni_usu"]) and !empty($_POST["tclave"])) {
          $dni=$_POST['dni_usu'];
          $clave=$_POST['tclave'];
          $sql=$cnn->query("select* from personal
          where dni_per='$dni' and clave_per='$clave'");
          if ($datos=$sql->fetch_object()){
            $_SESSION["dni"]=$datos->dni_per;
            $_SESSION["nom"]=$datos->nom_per;
            $_SESSION["ape"]=$datos->ape_per;
            $_SESSION["estado"]=$datos->estado_per;
            $_SESSION["cargo"]=$datos->tipo_per;
            $_SESSION["nivel"]=1;
            $_SESSION["nivel2"]=1;
            if($_SESSION["estado"]=="ACTIVO"){
              header("location:home.php");
            }else{
              echo "<div class='error'>Acceso denegado</div>";
            } 
            
          } else {
            echo "<div class='error'>Acceso denegado</div>";
          }   
     }else{
      echo "<div class='error'>Ingrese Datos</div>";
     }
     
      
}
?>

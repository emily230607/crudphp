<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "confeitaria";


    if($conn = mysqli_connect($server, $user, $pass, $bd,3307)){
      //  echo "Conectou!";
    } else{
        echo "Erro!";
    }
    function mensagem ($texto, $tipo){
        echo "<div class='alert alert-primary' role='alert'>
    $texto
    </div>";
    }

?>

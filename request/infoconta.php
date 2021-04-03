<?php

    include '../config/mysql_connect.php';
    include '../config/Logic.php';
    ob_start();
    if (session_id() =='')session_start();
    

    
    $query = 'SELECT * FROM utilizadores WHERE CodUser="'.$_SESSION['coduser'].'"';
    $result = mysqli_query($conexao,$query);
    $rows=[]; 
    while($row=$result->fetch_assoc()){
        array_push($rows,$row);
       

        
    }
        
    echo json_encode($rows);
    //print_r($rows);
    //echo ("<br>");
    //print_r($row);   
    exit;

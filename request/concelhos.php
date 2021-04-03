<?php

    require_once('../config/mysql_connect.php');

    $distrito = $_POST["distrito"];;
    $query = 'SELECT Concelho FROM concelho INNER JOIN distrito on distrito.CodDistrito=concelho.CodDistrito WHERE Distrito = "'.$distrito.'" ORDER BY Distrito';
    $result = mysqli_query($conexao,$query);
    $rows=[]; 
    while($row=$result->fetch_assoc())
        array_push($rows,$row['Concelho']); 
    echo json_encode($rows);
    print_r($row);
 
        exit;



        
<?php
    include '../config/mysql_connect.php';
    include '../config/Logic.php';
    ob_start();
    if (session_id() =='')session_start();

    $where=$_POST['where'];
    $coduser=$_SESSION['coduser'];
    $query = 'SELECT Nome,Descricao,Dataini,Datafim,Horaini,Horafim,DATEDIFF(NOW(),Data_add) as Datadif,TipoEvento,evento.CodEvento,Media,srcdir FROM tipoeventos INNER JOIN ((((distrito INNER JOIN concelho ON distrito.CodDistrito = concelho.CodDistrito) INNER JOIN evento ON concelho.CodConcelho = evento.CodConcelho) INNER JOIN favoritos ON evento.CodEvento = favoritos.CodEvento) INNER JOIN media ON evento.CodEvento = media.CodEvento) ON tipoeventos.CodTipo = evento.CodTipo where '.$where.' AND favoritos.CodUser='.$coduser.' Group by evento.CodEvento ORDER BY Datafim';
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
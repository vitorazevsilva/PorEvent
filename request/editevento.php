<?php
    error_reporting(0);
    include '../config/mysql_connect.php';
    include '../config/Logic.php';
    
    $codevento = $_POST["codevento"];
    $nome = $_POST["nome"];
    $tipoevento = $_POST["tipoevento"];
    $dataini = $_POST["dataini"];
    $datafim = $_POST["datafim"];
    $concelho = $_POST["concelho"];
    $preco = $_POST["preco"];
    $reserva = $_POST["reserva"];
    $descricao = strip_tags($_POST["descricao"],'<p><a><strong><em>');
    //$descricao = $_POST["descricao"];
    $horaini = $_POST["horaini"];
    $horafim = $_POST["horafim"];
    $query = 'SELECT `CodConcelho` FROM `concelho` WHERE Concelho="'.$concelho.'"';
    $result = mysqli_query($conexao,$query);
    $row = mysqli_fetch_object($result);
    $codconcelho=$row->CodConcelho;
    $query = 'SELECT `CodTipo` FROM `tipoeventos` WHERE TipoEvento = "'.$tipoevento.'"';
    $result = mysqli_query($conexao,$query);
    $row = mysqli_fetch_object($result);
    $codtipo=$row->CodTipo;
    $query = 'UPDATE `evento` SET `CodTipo` = "'.$codtipo.'", `CodConcelho` = "'.$codconcelho.'", `Nome` = "'.$nome.'", `Descricao` = "'.$descricao.'", `Reserva` = "'.$reserva.'", `Valor` = "'.$preco.'", `Dataini` = "'.$dataini.'", `Datafim` = "'.$datafim.'", `Horaini` = "'.$horaini.'", `Horafim` = "'.$horafim.'", `Data_add` = "'.date('Y-m-d').'" WHERE `evento`.`CodEvento` ='.$codevento;
    $result = mysqli_query($conexao,$query);

    echo json_encode($codevento);
    exit;
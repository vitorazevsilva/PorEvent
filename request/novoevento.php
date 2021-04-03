<?php
    error_reporting(0);
    include '../config/mysql_connect.php';
    include '../config/Logic.php';
    ob_start();
    if (session_id() =='')session_start();
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
    $query = 'INSERT INTO `evento`( `CodTipo`, `CodConcelho`, `Nome`, `Descricao`, `Reserva`, `Valor`, `CodUser`, `Dataini`, `Datafim`, `Horaini`, `Horafim`, `Data_add`) VALUES ('.$codtipo.','.$codconcelho.',"'.$nome.'","'.$descricao.'","'.$reserva.'","'.$preco.'",'.$_SESSION['coduser'].',"'.$dataini.'","'.$datafim.'","'.$horaini.'","'.$horafim.'","'.date('Y-m-d').'")';
    $result = mysqli_query($conexao,$query);
    $query = 'SELECT `CodEvento` FROM `evento` WHERE CodTipo = '.$codtipo.' AND CodConcelho='.$codconcelho.' And Nome ="'.$nome.'" AND Descricao ="'.$descricao.'" AND Reserva ='.$reserva.' AND Valor ="'.$preco.'" AND CodUser ='.$_SESSION['coduser'].' AND Dataini ="'.$dataini.'" AND Datafim ="'.$datafim.'" AND Horaini ="'.$horaini.'" AND Horafim ="'.$horafim.'"';
    $result = mysqli_query($conexao,$query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_object($result);
        $codevento=$row->CodEvento; 
    }
    else
    $codevento=false;

    echo json_encode($codevento);
    exit;



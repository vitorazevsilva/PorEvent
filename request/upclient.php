<?php 
    include '../config/mysql_connect.php';
    include '../config/logic.php';
    ob_start();
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $datan=$_POST['data'];
    $sexo=$_POST['sexo'];
    $contacto=$_POST['contacto'];
    $pass=$_POST['pass'];
    if(session_id()=='')session_start();
    $assunto="Alteração de Dados";
    $mensagem=' 
    <h3>Caro(a) <b> '.$nome.' </b></h3><br>
    As suas informações da conta <a href="'.$localhost.'"> PorEvent </a> foram alteradas:<br><br>
    
    Nome: '.$nome.'<br>
    Email: '.$email.'<br>
    Data de Nascimento: '.$datan.'<br>
    Sexo: '.$sexo.'<br>
    Contacto: '.$contacto.'<br>
    Palavra-Passe: ******** <br><br>

    Se não tiver alterado, deve contactar o Suporte PorEvent.<br><br>
    
    Os melhores cumprimentos,<br>
    <i>Suporte da PorEvent </i><br>
    <img src="'.$localhost.'/img/logo.png" alt="">
    ';

    include '../request/bibmail_request.php';
    if($erros==null){
        $query='UPDATE utilizadores SET Nome="'.$nome.'", DataNascimento="'.$datan.'", Email="'.$email.'", Sexo="'.$sexo.'", Contacto="'.$contacto.'",PASSWORD="'.$pass.'" WHERE CodUser='.$_SESSION['coduser'];
        $result=mysqli_query($conexao,$query);
        $_SESSION['email']=$email;
        $_SESSION['passwd']=$pass;
        $_SESSION['nome']=$nome;
        $_SESSION['tel']=$contacto;
        $_SESSION['data']=$datan;
        $_SESSION['sexo']=$sexo;
    }
    echo json_encode($erros);
    exit(); 

<?php

    require_once('../config/mysql_connect.php');

    $email = $_POST["email"];
    $cod="";
    $nome="";
    $erro="";
    $query = 'SELECT * FROM utilizadores WHERE email = "'.$email.'" And Verficado = 1';
    $result = mysqli_query($conexao,$query);
        if(mysqli_num_rows($result) > 0){
            $rows=[]; 
                while($row=$result->fetch_assoc()){
                $user=$row['CodUser'];
                $nome=$row['Nome'];
                }
            $query = 'SELECT Uniqcode From auth Where CodUser ="'.$user.'"';
            $result=mysqli_query($conexao,$query);
            if(mysqli_num_rows($result) > 0){
                $rows=[]; 
                while($row=$result->fetch_assoc())// while
                    array_push($rows,$row['Uniqcode']);
                $cod=$rows[0];
            }
            else
            {
                $cod=uniqid();
                $query = 'SELECT * From auth Where Uniqcode="'.$cod.'"';
                $result=mysqli_query($conexao,$query);
                while(mysqli_num_rows($result) > 0){
                    $cod=uniqid();
                    $query = 'SELECT * From auth Where uniqcode="'.$cod.'"';
                    $result=mysqli_query($conexao,$query);
                }
                $query = 'INSERT INTO auth (Uniqcode,CodUser) Values ("'.$cod.'",'.$user.')';
                $result = mysqli_query($conexao,$query);
                
            }

            $assunto = "Recuperação de Conta";
             
            $mensagem='
            
            <h3>Caro(a) <b>'.$nome.'</b></h3><br>
            Este é o código que precisas para alterar as credenciais da tua conta PorEvent:<br>

            Codigo de Ativaçao: '.$cod.'<br><br>

            Efetue a alteração da password da sua conta.<br><br>
            <a href="'.$localhost.'/recup.php?code='.$cod.'">Clique aqui para alteração.</a><br><br>
            
            Os nossos melhores cumprimentos, <br>
            <i>Suporte da PorEvent</i><br>
            <img src="'.$localhost.'/img/logo.png" alt="">
            ';
            include '../request/bibmail_request.php';
            if($erros!=null){
                $query = 'DELETE FROM auth Where Uniqcode="'.$cod.'"';
                mysqli_query($conexao,$query);
                $erro=$erros['Developer'];
                
            }
        }    
        else {
            $erro = "O email não existe/não está verificado.";       
        }
          
        if($erro=="")
            $erro="true";

    echo json_encode($erro);
    
      exit;




      
<?php
//Inports

//Login
function login($conexao,$username,$pass,$url,$erros){         
    
       
        global $erros;
        $erros = null;

        //query que seleciona o login correspondente ao login e senha
        $query = 'SELECT *  FROM utilizadores WHERE Email ="'.$username.'" AND PASSWORD="'.$pass.'"';
        //executa query
        $result = mysqli_query($conexao,$query);
        //retorna os resultados da query
        $row = mysqli_fetch_object($result);	
        //se retornou resultado, login existe, então, inicia a sessao
        if(mysqli_num_rows($result) > 0){
            if($row->Verficado==1){
                if (session_id() ==''){session_start();}
                {  
                    $_SESSION['status']="true";
                    $_SESSION['coduser']= $row->CodUser;
                    $_SESSION['passwd'] = $pass;
                    $_SESSION['nome'] = $row->Nome;
                    $_SESSION['email'] = $row->Email;
                    $_SESSION['tel'] = $row->Contacto;
                    $_SESSION['data'] = $row->DataNascimento;
                    $_SESSION['sexo'] = $row->Sexo;
                    
                    header('Location:'.$url);
                }
            }
            else{
                $erros['sql'] = 'Tem de verificar a conta. <a style="text-decoration: underline;" href="./login.php?url='.$url.'&email='.$username.'" id="verif">Reenviar email de verificação<a>';
            }
   
        }
        else{
            
            $_SESSION['ERROLOGIN'] = 'true';
            $erros['sql'] = "Email ou Palavra-Passe Incorretos";
            
        }
    }

    
    function verificar($conexao,$localhost,$username,$url){

        $query = 'SELECT * FROM utilizadores inner join auth on utilizadores.CodUser=auth.CodUser WHERE Email ="'.$username.'"';
        $result = mysqli_query($conexao,$query);
        if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_object($result);	
        $nome=$row->Nome;
        $email=$row->Email;
        $data=$row->DataNascimento;
        $sexo=$row->Sexo;
        $tel=$row->Contacto;
        $cod=$row->Uniqcode;

        }


        $assunto = "Bem vindo(a) a PorEvent ";
             
            $mensagem='
                <h3>Caro(a) <b>'.$nome.'</b></h3><br>

                Obrigado pelo seu registo na <a href="'.$localhost.'">PorEvent</a>.<br><br>

                E-mail: '.$email.' <br>
                Data de Nacimento:'.$data.' <br>
                Sexo: '.$sexo.' <br>
                Contacto: '.$tel.' <br>
                Codigo de Ativaçao: '.$cod.'<br><br>

                Para que o seu registo seja válido, deverá efetuar a ativação.<br><br>
                <a href="'.$localhost.'/verif.php?code='.$cod.'">Clique aqui para ativação.</a><br><br>

                Ao efetuar login pode aceder à sua área de utilizador e editar os seus dados pessoais, ou alterar a sua password.<br><br>

                Os nossos melhores cumprimentos, <br>
                <i>Suporte da PorEvent</i><br>
                <img src="'.$localhost.'/img/logo.png" alt="">
                ';
            //smtp($assunto,$email,$mensagem);
            include './config/bibmail.php';
            if($erros==null)
                header('Location:./login.php?url='.$url);
            else{
            $query = 'DELETE FROM auth Where Uniqcode="'.$cod.'"';
                mysqli_query($conexao,$query);
                

    }
}
    function fill_loading($conexao){
        global $distritos;
        $query = "select Distrito from distrito ORDER BY Distrito";
        $distritos = mysqli_query($conexao,$query);

        global $eventos;
        $query = "select TipoEvento from tipoeventos ORDER BY TipoEvento";
        $eventos = mysqli_query($conexao,$query);
          
    }

    
    

    
    
   function register($conexao,$localhost,$nome,$email,$pass,$tel,$data,$sexo,$url){


        global $erros;
       

        $query = 'select * from utilizadores Where Email="'.$email.'"';
        $result = mysqli_query($conexao,$query);
        if(mysqli_num_rows($result) > 0)
            $erros['sql'] = "Email ja utilizado";

        if($tel!=null){
            $query = 'select * from utilizadores Where Contacto="'.$tel.'"';
            $result = mysqli_query($conexao,$query);
            if(mysqli_num_rows($result) > 0)
                $erros['sql'] = "Contacto já utilizado";
        }

        if($erros==null){
            $query = 'INSERT INTO utilizadores(Nome,DataNascimento,Email,Sexo,Contacto,PASSWORD,Verficado) VALUES ("'.$nome.'","'.$data.'","'.$email.'","'.$sexo.'","'.$tel.'","'.$pass.'",0)';
            $result=mysqli_query($conexao,$query);
            $cod=uniqid();
            $query = 'SELECT * From auth Where Uniqcode="'.$cod.'"';
            $result=mysqli_query($conexao,$query);
            while(mysqli_num_rows($result) > 0){
                $cod=uniqid();
                $query = 'SELECT * From auth Where uniqcode="'.$cod.'"';
                $result=mysqli_query($conexao,$query);
            }
            $query = 'SELECT CodUser From utilizadores Where Email="'.$email.'"';
            $result = mysqli_query($conexao,$query);
            $rows=[]; 
            while($row=$result->fetch_assoc())
            array_push($rows,$row['CodUser']);
            $usercode=$rows[0];
            $query = 'INSERT INTO auth (Uniqcode,CodUser) Values ("'.$cod.'",'.$usercode.')';
            $result = mysqli_query($conexao,$query);
            $assunto = "Bem vindo(a) a PorEvent ";
             
            $mensagem='
                <h3>Caro(a) <b>'.$nome.'</b></h3><br>

                Obrigado pelo seu registo na <a href="'.$localhost.'">PorEvent</a>.<br><br>

                E-mail: '.$email.' <br>
                Data de Nacimento:'.$data.' <br>
                Sexo: '.$sexo.' <br>
                Contacto: '.$tel.' <br>
                Codigo de Ativaçao: '.$cod.'<br><br>

                Para que o seu registo seja válido, deverá efetuar a ativação.<br><br>
                <a href="'.$localhost.'/verif.php?code='.$cod.'">Clique aqui para ativação.</a><br><br>

                Ao efetuar login pode aceder à sua área de utilizador e editar os seus dados pessoais, ou alterar a sua password.<br><br>

                Os nossos melhores cumprimentos, <br>
                <i>Suporte da PorEvent</i> <br>
                <img src="'.$localhost.'/img/logo.png" alt="">
                ';
            //smtp($assunto,$email,$mensagem);
            include './config/bibmail.php';
            if($erros==null)
                header('Location:./login.php?url='.$url);
            else{
                $query = 'DELETE FROM auth WHERE Uniqcode="'.$cod.'"';
                mysqli_query($conexao,$query);
                
            }
        }       

    }

    function delevento($conexao,$codevento){
        $query='SELECT CodEvento FROM evento WHERE CodEvento='.$codevento;
        $result= mysqli_query($conexao,$query);
        if(mysqli_num_rows($result)>0){
            $query='SELECT Media FROM media WHERE CodEvento='.$codevento;
            $result= mysqli_query($conexao,$query);
            if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_object($result);	
                $srcdir=$row->srcdir;
                
                $path = "img/eventos/";
                $diretorio = dir($path);
                while($arquivo=$diretorio -> read()){
                
                           $di = new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS);
                           $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
                           
                           foreach ( $ri as $file ) {
                               if ($file==$srcdir) 
                               $file->isDir() ?  rmdir($file) : unlink($file);
                           }
                        }

                $query='DELETE FROM media WHERE CodEvento='.$codevento;
                $result=mysqli_query($conexao,$query);
            }
            $query='SELECT CodFav FROM favoritos WHERE CodEvento='.$codevento;
            $result= mysqli_query($conexao,$query);
            if(mysqli_num_rows($result)>0){
                $query='DELETE FROM favoritos WHERE CodEvento='.$codevento;
                $result=mysqli_query($conexao,$query);
            }
            $query='DELETE FROM evento WHERE CodEvento='.$codevento;
            $result=mysqli_query($conexao,$query);
        }
    }
   function evento($conexao,$codevento){
        $query = 'SELECT evento.Nome as Nome_e, TipoEvento, Concelho, Distrito, Dataini, Datafim, Horaini, Horafim, Reserva, Valor, Descricao, utilizadores.Nome as Nome_u, Email, Contacto FROM utilizadores INNER JOIN (tipoeventos INNER JOIN ((distrito INNER JOIN concelho ON distrito.CodDistrito = concelho.CodDistrito) INNER JOIN evento ON concelho.CodConcelho = evento.CodConcelho) ON tipoeventos.CodTipo = evento.CodTipo) ON utilizadores.CodUser = evento.CodUser WHERE evento.CodEvento='.$codevento;
        $eventos = mysqli_query($conexao,$query);
        global $medias;
        global $evento;
        if(mysqli_num_rows($eventos)>0){
            $row = mysqli_fetch_object($eventos);	
            $evento["0"]=$row->Nome_e;
            $evento["1"]=$row->TipoEvento;
            if($row->Distrito=="Madeira"||$row->Distrito=="Açores")
                $evento["2"]=$row->Concelho;
            else
                $evento["2"]=$row->Concelho.",".$row->Distrito;
            $a_dateini=explode("-",$row->Dataini);
            $a_datefim=explode("-",$row->Datafim);
            $a_horini=explode(":",$row->Horaini);
            $a_horfim=explode(":",$row->Horafim);
            
            $dateini=$a_dateini['2']."/".$a_dateini['1']."/".$a_dateini['0'];
            $datefim=$a_datefim['2']."/".$a_datefim['1']."/".$a_datefim['0'];
            $horini=$a_horini['0'].":".$a_horini['1'];
            $horfim=$a_horfim['0'].":".$a_horfim['1'];
            if($dateini==$datefim){
        
                if($horini==$horfim){
                    $evento["4"] = $dateini.' ás '.$horini;
                }
                else{
                    $evento["4"] = $dateini . ' ás ' . $horini . ' até ' . $horfim;
                }
                
              }
              else{
                $evento["4"] = $dateini . ' ás ' . $horini . ' até ' . $datefim . ' ás ' . $horfim;
              }
            $row->Reserva;
             
            if($row->Reserva=="0")
                $evento["8"]="Não necessita de reserva";
            else
                $evento["8"]="Necessário reserva";

            if($row->Valor=="0")
                $evento["10"]="Entrada Gratuita";
            else
                $evento["10"]=$row->Valor."€";


            $evento["11"]=$row->Descricao;
            $evento["12"]=$row->Nome_u;
            $evento["13"]=$row->Email;
            
            if($row->Contacto==null)
                $evento["14"]="Tel. Indisponível";
            else
                $evento["14"]=$row->Contacto;

            
            
            $query = 'SELECT * From media Where codevento="'.$codevento.'"';
            $medias=mysqli_query($conexao,$query);
        }
        else
            header('Location:./event.php');
        
            
   }
   function vevento($conexao,$codevento){
    $query = 'SELECT evento.Nome as Nome_e, TipoEvento, Concelho, Distrito, Dataini, Datafim, Horaini, Horafim, Reserva, Valor, Descricao, utilizadores.Nome as Nome_u, Email, Contacto FROM utilizadores INNER JOIN (tipoeventos INNER JOIN ((distrito INNER JOIN concelho ON distrito.CodDistrito = concelho.CodDistrito) INNER JOIN evento ON concelho.CodConcelho = evento.CodConcelho) ON tipoeventos.CodTipo = evento.CodTipo) ON utilizadores.CodUser = evento.CodUser WHERE evento.CodEvento='.$codevento.' AND evento.CodUser='.$_SESSION['coduser'];
    $eventos = mysqli_query($conexao,$query);
    if(mysqli_num_rows($eventos)<=0)
        header('Location:./client.php');

        
    
        
}
    
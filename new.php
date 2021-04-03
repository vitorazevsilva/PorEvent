<?php 
include './config/include.php';
if(isset($_SESSION['status']))
    if($_SESSION['status']=="true")
	    header('Location:/');
if(isset($_POST['submit'])){
	$url=$_GET['url'];

	$nome=$_POST["nome"];
    $email=$_POST["email"];
	$pass=$_POST["pass"];
    $tel=$_POST["tel"];
	$data=$_POST["data"];
	

    if($_POST["sexo"]=='Masculino')
        $sexo="M";
    elseif($_POST["sexo"]=='Feminino')
        $sexo="F";
    else
        $sexo=null;


    global $erros;
    $erros = null;
	if($nome=="" && $email=="" && $pass=="" )
		$erros['tudo'] = "Nome, Email e Palavra-Passe Obrigatorios!";
	elseif($nome=="")
        $erros['nome'] = "Nome Obrigatorio!";
    elseif($email=="")
		$erros['email'] = "Email Obrigatorio!";
	elseif($pass=="")
		$erros['pass'] = "Palavra-Passe Obrigatoria!";
    elseif(strlen($pass)<8)
        $erros['pass'] = "Palavra-Passe tem de ter mais de 8 caracteres!";
	else{


        /*if(is_string($nome)) 
        $erros['nomef'] = 'O nome tem um formato invalido!';*/
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        $erros['emailf'] = 'O email tem um formato invalido!';
        
        $tel = str_replace(' ', '', $tel);
        
        if($tel!="" && (!filter_var($tel, FILTER_VALIDATE_INT)||strlen($tel)!=9))
            $erros['telf'] = 'O contacto tem um formato invalido!';
        
        

    }
	  register($conexao,$localhost,$nome,$email,$pass,$tel,$data,$sexo,$url);
}
	
	

?>
<!DOCTYPE html>
<html lang="pt" >
    <head>
        <meta charset="UTF-8">
        <title>Registo - PorEvent</title>
        <?php include './config/links.php';?><!--Links de CSS e JS-->
    </head>
<body>
    <?php include './template/header.php';?><!--NavBar-->
    <!----------------------------------------------------------------------------------------->
	<div class="container-fluid">
		<div class="main-content">
			<div class="login100-form-title p-4 border">
				Registo
			</div>
            <div class="container border">
                <form action="new.php?url=<?php if(isset($_GET['url'])) echo $_GET['url'];else echo '/';?>" method="post">
                    <input type="text" class="form-control mt-3"  id="nome" name="nome" onchange="save()" placeholder="Nome *">
                    <input type="text" class="form-control mt-3" id="email" name="email" onchange="save()" placeholder="Email *">
                    <input type="password" class="form-control mt-3"  id="pass" name="pass" onchange="save()" placeholder="Palavra-Passe *">
                    <input type="text" class="form-control mt-3" id="tel" name="tel" onchange="save()" placeholder="Contacto">
                    <input type="date" class="form-control mt-3" id="data" name="data" onchange="save()" placeholder="Data Nascimento">
                    <select class="form-control mt-3"  id="sexo" name="sexo" onchange="getComboA(this)">
                        <option>Prefiro Não Dizer</option>
                        <option>Masculino</option>
                        <option>Feminino</option>
                    </select>
                    <div class="reccont">
                        <small>*</small><small class="text-decoration-underline">Campos Obrigatorios</small>
                    </div>
                    <?php
                        
                            global $erros;
                            if($erros != null)
                            foreach($erros as $erro)
                            {
                                echo('<div class="alert-sm alert-danger rounded" role="alert">');
                                    echo($erro);
                                echo('</div>');
                            }
                        
                        ?> 
                    <button type="submit" class="btn-lg btn-secondary btn-block mt-5 mb-2 " name="submit">Registrar</button>
                </form>
                <button onclick="window.location.href='./login.php?url=<?php if(isset($_GET['url'])) echo $_GET['url'];else echo '/';?>'" class="btn-lg btn-outline-grey btn-block mt-2 mb-2 ">Entrar</button>
            </div>
		</div>
	</div>
		

	
    <!----------------------------------------------------------------------------------------->
    
</body>
</html
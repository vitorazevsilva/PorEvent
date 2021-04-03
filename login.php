<?php 
include './config/include.php';

if(isset($_SESSION['status']))
	if($_SESSION['status']=="true")
		header('Location:/');
if(isset($_POST['submit'])){
	$url=$_GET['url'];
	$username=$_POST["email"];
	$pass=$_POST["pass"];
	global $erros;
    $erros = null;
	if($username=="" && $pass=="" )
		$erros['sql'] = "Email e Palavra-Passe Obrigatorios!";
	elseif($username=="")
		$erros['sql'] = "Email Obrigatorio!";
	elseif($pass=="")
		$erros['sql'] = "Palavra-Passe Obrigatoria!";
	elseif(!filter_var($username, FILTER_VALIDATE_EMAIL)) 
			$erros['sql'] = 'O email tem um formato invalido!';
		else 
			login($conexao,$username,$pass,$url,$erros);
				
}
if(isset($_GET['email']))
	if($_GET['email']!=""){
		$url=$_GET['url'];
		$username=$_GET['email'];
		verificar($conexao,$localhost,$username,$url);
	}



?>

<!DOCTYPE html>
<html lang="pt" >
    <head>
        <meta charset="UTF-8">
        <title>Entrar - PorEvent</title>
        <?php include './config/links.php';?><!--Links de CSS e JS-->
    </head>
<body>
    <?php include './template/header.php';?><!--NavBar-->
    <!----------------------------------------------------------------------------------------->
	<div class="container-fluid">
		<div class="main-content">
			<div class="login100-form-title p-4 border">
				Entrar
			</div>
			<div class="container border">
				<form action="login.php?url=<?php if(isset($_GET['url'])) echo $_GET['url'];else echo '/';?>" method="post">	
					<input type="email" class="form-control mt-3" id="email" name="email" placeholder="Email">
					<input type="password" class="form-control mt-3 mb-1" id="password" name="pass" placeholder="Palavra-Passe">
					<?php
						try{
							global $erros;
							if($erros != null)
							foreach($erros as $erro)
							{
								echo('<div class="alert-sm mt-1 alert-danger rounded" role="alert">');
									echo($erro);
								echo('</div>');
							}
						}catch(Exception $e){$erro=1;}
					?> 
					<div id="recu" ></div>
					<div class="reccont">
						<a class="reccont" href="#" onclick="recup()">Recuperar Conta</a>
					</div>

					<script>
							function recup(){
    							var email=document.getElementById("email").value;
    							if (email != ""){
        							var request = $.ajax({
            						type: 'POST',
            						url: './request/recuperacao.php',
            						data: {'email':email},
            						cache: false,
            						dataType: 'json'
        				});
        			request.done(function(data) {
						if(data=="true")
							window.location.href='./recup.php';
						else
							$("#recu").append('<div class="alert-sm alert-danger rounded" role="alert"> '+data+' </div>');


        			})
    }
    else
    {
        $("#recu").append('<div class="alert-sm alert-danger rounded" role="alert"> Introduza um email! </div>');
    } 							
    }
					</script>

					<button type="submit" class="btn-lg btn-secondary btn-block mt-5 mb-2 " name="submit">Entrar</button>
				</form>
				<button onclick="window.location.href='./new.php?url=<?php if(isset($_GET['url'])) echo $_GET['url'];else echo '/';?>'" class="btn-lg btn-outline-grey btn-block mt-2 mb-2 ">Registrar</button>
			</div>
		</div>
	</div>
		

	
    <!----------------------------------------------------------------------------------------->
    
</body>
</html>
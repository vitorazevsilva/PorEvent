<?php
	include './config/include.php';
	if (isset($_GET["code"])){
		if ($_GET["code"]!="")
		{
			
			echo ' <script> console.log('.$_GET["code"].'); $("#uniqcode").text("'.$_GET["code"].'"); </script>';
		}
		else
			$erros['uniqcode'] = 'URL inválida, introduza o código recebido!';
	}

	if(isset($_POST['submit'])){
			if ($_POST["uniqcode"]!=""){
				$query = 'SELECT auth.CodUser,Uniqcode,Verficado FROM auth inner join utilizadores on utilizadores.CodUser=auth.CodUser WHERE Uniqcode = "'.$_POST['uniqcode']. '"';
				$result = mysqli_query($conexao,$query);
				if(mysqli_num_rows($result) > 0){
					if(strlen($_POST["pass"])<8)
        				$erros['pass'] = "Palavra-Passe tem de ter mais de 8 caracteres!";
					else{
						if($_POST["pass"]==($_POST["passe"])){
							$rows=[]; 
							while($row=$result->fetch_assoc()){
							$user=$row['CodUser'];
							$nome=$row['Uniqcode'];
							$verf=$row['Verficado'];
							}
							if($verf==1){
								$query = 'UPDATE utilizadores SET PASSWORD="'.$_POST['pass'].'" WHERE CodUser="'.$user.'"';
								$result = mysqli_query($conexao,$query);
								$query = 'DELETE FROM auth Where Uniqcode="'.$nome.'"';
								mysqli_query($conexao,$query);
								header('Location:./login.php');
							}
							else
								$erros['verfi'] = 'Conta não verificada!';
						}
						else
						$erros['password'] = 'As Palavras-Passe não são iguais!';
					}
				}
				else
					$erros['uniqcode'] = 'Código Inválido, verifique de novo!';
			}
			else
				$erros['uniqcode'] = 'Introduza o código recebido!';					
	}

	
?>

<!DOCTYPE>
<html lang="pt" >
    <head>
        <meta charset="UTF-8">
        <title>Recuperar - PorEvent</title>
        <?php include './config/links.php';?><!--Links de CSS e JS-->
    </head>
<body>
    <?php include './template/header.php';?><!--NavBar-->
    <!----------------------------------------------------------------------------------------->
	<div class="container-fluid">
		<div class="main-content">
			<div class="login100-form-title p-4 border">
				Recuperar Email
			</div>
			<div class="container border">
				<form action="recup.php" method="post">	
					<input type="text" class="form-control mt-3" id="uniqcode" name="uniqcode" placeholder="Code" value="<?php if (isset($_GET["code"]))echo $_GET["code"];?>"> 
					<input type="password" class="form-control mt-3" id="pass" name="pass" placeholder="Inserir Palavra-Passe">
                    <input type="password" class="form-control mt-3" id="passe" name="passe" placeholder="Repetir Palavra-Passe">	
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
						}catch(Exception $e){
 echo 'Caught exception: ',  $e->getMessage(), "\n";
}
					?> 
                    				
					<button type="submit" class="btn-lg btn-secondary btn-block mt-5 mb-2 " name="submit">Efetuar Recuperação</button>
				</form>
			</div>
		</div>
	</div>
		
    <!----------------------------------------------------------------------------------------->
    
</body>
</html>			
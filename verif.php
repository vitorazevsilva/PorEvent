<?php 
include './config/include.php';
	
if(isset($_POST['submit'])){
		if ($_POST["code"]!=""){
			$query = 'SELECT * FROM auth WHERE Uniqcode = "'.$_POST['code']. '"';
			$result = mysqli_query($conexao,$query);
			if(mysqli_num_rows($result) > 0){
				$rows=[]; 
                while($row=$result->fetch_assoc()){
                $user=$row['CodUser'];
                $nome=$row['Uniqcode'];
                }
				$query = 'UPDATE utilizadores SET  Verficado=1 WHERE CodUser="'.$user.'"';
				$result = mysqli_query($conexao,$query);
				$query = 'DELETE FROM auth Where Uniqcode="'.$nome.'"';
				mysqli_query($conexao,$query);
				header('Location:./login.php');
			}
			else
				$erros['uniqcode'] = 'Código Inválido, verifique de novo!';
		}
		else
			$erros['uniqcode'] = 'Introduza o código recebido!';
	}






if (isset($_GET["code"])){
		if ($_GET["code"]!="")
		{
			$query = 'SELECT * FROM auth WHERE Uniqcode = "'.$_GET['code'].'"';
			$result = mysqli_query($conexao,$query);
			if(mysqli_num_rows($result) > 0){
				while($row=$result->fetch_assoc()){
					$user=$row['CodUser'];
					$nome=$row['Uniqcode'];
					}
				$query = 'UPDATE utilizadores SET  Verficado=1 WHERE CodUser="'.$user.'"'; 
				$result = mysqli_query($conexao,$query);
				$query = 'DELETE FROM auth Where Uniqcode="'.$nome.'"';
                mysqli_query($conexao,$query);
				header('Location:./login.php');
			}
			else
				$erros['uniqcode'] = 'URL inválida, introduza o código recebido!';		
				
		}
		else
			$erros['uniqcode'] = 'URL inválida, introduza o código recebido!';
	}
	
	
	
	
	
	
?>
<!DOCTYPE html>
<html lang="pt" >
    <head>
        <meta charset="UTF-8">
        <title>Verificar - PorEvent</title>
        <?php include './config/links.php';?><!--Links de CSS e JS-->
    </head>
<body>
    <?php include './template/header.php';?><!--NavBar-->
    <!----------------------------------------------------------------------------------------->
	<div class="container-fluid">
		<div class="main-content">
			<div class="login100-form-title p-4 border">
				Verificar
			</div>
			<div class="container border">
				<form action="verif.php" method="post">	
					<input type="text" class="form-control mt-3" id="code" name="code" placeholder="Code">
					<?php
						try{
							global $erros;
							if($erros != null)
							foreach($erros as $erro)
							{
								echo('<div class="alert-sm alert-danger rounded" role="alert">');
									echo($erro);
								echo('</div>');
							}
						}catch(Exception $e){}
					?> 
					
					<button type="submit" class="btn-lg btn-secondary btn-block mt-5 mb-2 " name="submit">Verificar</button>
				</form>
			</div>
		</div>
	</div>
		
    <!----------------------------------------------------------------------------------------->
    
</body>
</html
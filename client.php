
<?php 
error_reporting(0);
include './config/include.php';
//echo '<scrip>alert("⚠️Esta página encontra-se em manutenção!⚠️")</scrip>';
if(isset($_SESSION['status'])){
  if($_SESSION['status']=="true"){

  }
  else{
    header('Location:./login.php?url=./client.php');
  }

}
else
  header('Location:./login.php?url=./client.php');


if(isset($_GET["m"]) && isset($_GET["c"]))
  if ($_GET["c"]!=""){
    $codevento=$_GET["c"];
    delevento($conexao,$codevento);
}



?>
<!DOCTYPE html>
<html lang="pt" >
<head>
  <meta charset="UTF-8">
  <title>Cliente - PorEvent </title>
  <?php include './config/links.php';?><!--Links de CSS e JS-->
  </head>
<body>
<?php include './template/header.php';?><!--NavBar-->

    <!----------------------------------------------------------------------------------------->
       
    <div class="container-fluid p-l-205  p-r-205  pt-2">
      <div class="px-lg-5">
        <div class="row pt-5 pb-3">
          <div class="col-lg-12 mx-auto border">
            <div class="text-black p-4 banner ">
              <h1 class="login100-form-title  display-4">Conta</h1>
            </div>
          </div>
        </div>
        <div class="row mt-2 mb-2">
          <div class="border col-12">
            <div class="pt-3 info"><h5 class="info">Informações da Conta </h5></div> 
              <hr>
              <div class="reccont ">
              <a id="editar" href="#" onclick="editar()" class="btn-sm btn-secondary mb-2 border text-white" > Editar</a>
              </div>
              <div class="row">

                <div class="form-group pt-3 col-5 ">
                  <div class="input-group input-group-sm">
                    <span class="input-group-text" id="inputGroup">Nome</span>
                    <input type="text" class="form-control" min="0" max="" id="nome" disabled>
                  </div>
                </div>

                <div class="form-group pt-3 col-4 ">
                  <div class="input-group input-group-sm">
                    <span class="input-group-text" id="inputGroup">Email</span>
                    <input type="text" class="form-control" max="" id="email" disabled>
                  </div>
                </div>

                <div class="form-group pt-3 col-3 ">
                  <div class="input-group input-group-sm">
                    <span class="input-group-text" id="inputGroup">Contacto</span>
                    <input type="text" class="form-control" max="" id="contacto" disabled>
                  </div>
                </div>
              
                <div class="form-group pt-3 col-4 ">
                  <div class="input-group input-group-sm">
                    <span class="input-group-text" id="inputGroup">Data Nasc.</span>
                    <input type="date" class="form-control" max="" id="datan" disabled>
                  </div>
                </div>
                
               
                <div class="form-group pt-3 col-4 ">
                  <select class="form-control form-control-sm"  id="sexo" name="sexo" disabled>
                        <option value="">Prefiro Não Dizer</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>

                <div class="form-group pt-3 col-4 ">
                  <div class="input-group input-group-sm">
                    <span class="input-group-text" id="inputGroup">Password</span>
                    <input type="password" class="form-control" max="" id="password" disabled> 
                  </div>
                </div>
                  <div id="div_error">

                  </div>
              </div>
            </div>
          </div>

          <script src="./js/client.js"></script>
          <!-------------------------------------------------------------------------------------------------------->
          
          <div class="row mt-2 mb-5">
            <div class="border col-12">
              <div class="pt-3 info"><span class="info"><h5>Meus Eventos</h5> </span></div> 
                <hr>
                <div class="reccont">
                <a id="novo" onclick="novo()" href="adicionar.php" class="btn-sm btn-secondary mb-2 border reccont text-white" ><i class="bi bi-calendar-plus"></i> Novo</a>
                </div>
                <div class="row mt-3">
                  <ul class="responsive-table">
                    <li class="table-header">
                      <div id="div_name" class="col col-3"><a href="#" id="name" name="">Nome</a></div>
                      <div id= "div_categoria" class="col col-3"><a href="#" id="categoria" name="">Categoria</a></div>
                      <div id="div_data" class="col col-2"><a href="#" id="data" name="">Datas</a></div>
                      <div id="div_localizacao"class="col col-3"><a href="#" id="localizacao" name="">Localização</a></div>
                      <div class="col col-1">Opções</div>
                    </li>
                    <div id="demo">
                      <div id="tabela">                  
                          
                          
                         
                      
                      </div>
                    </div>
                  </ul>
              </div>
            </div>
          </div>
        </div>       
      </div>
      <script src="./js/tabela.js"></script>
    <!----------------------------------------------------------------------------------------->
    <?php include './template/footer.php';?><!--NavBar--> 
    </body>
</html>
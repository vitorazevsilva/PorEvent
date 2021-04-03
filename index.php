<?php 
error_reporting(0);
include './config/include.php';
include './config/temp.php';
fill_loading($conexao);
?>
<!DOCTYPE html>
<html lang="pt" >
<head>
  <meta charset="UTF-8">
  <title>PorEvent</title>
  <?php include './config/links.php';?><!--Links de CSS e JS-->
</head>
<body class="w3-body w3-bgimg w3-font">
    <div class="reccont pr-2">
      <a class="rounded" style="background-color:#E9ECEF;" href="https://inovacaosebraeminas.com.br">&nbsp; Inovacao Sebrae &nbsp; </a>
    </div>

    <!----------------------------------------------------------------------------------------->
    <div class="w3-display-container p-t-250 w3-wide bgimg w3-grayscale-min" id="home">
      <div class="w3-display-middle p-t-250 w3-text-white w3-center">
        <h1 class="w3-jumbo">PorEvent</h1>
        <h2>Prova de Aptidão Profissional</h2>
      </div>
    </div>
    <div class="w3-bottom w3-hide-small p-5 ">
      <div class="row ">
        <div class="col-lg-12 mx-auto">
          <div class="row px-5 pb-2 pt-4">
            <div class="form-group col-3">
              <select class="form-control" id="cb_distrito"  onchange="getComboA(this)">
                <option>Todos os Distritos</option>
                <?php foreach ($distritos as $distrito):?>
                  <option value="<?php echo $distrito['Distrito']; ?>"><?php echo $distrito['Distrito']; ?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="form-group col-3">
              <select class="form-control" id="cb_concelhos"  disabled>
                <option>Todos os Concelhos</option>
                <option id="concelho"></option>
              </select>
            </div>
            <div class="form-group col-3">
              <select class="form-control" id="cb_tipoevento">
                <option>Todas as Categorias</option>
                <?php foreach ($eventos as $evento):?>
                  <option value="<?php echo $evento['TipoEvento']; ?>"><?php echo $evento['TipoEvento']; ?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="form-group col-3">
                <a id="avançar" onclick="avancar()" href="#" class="btn btn-secondary btn-block mb-2 border">Procurar</a>
            </div>
          </div>
        </div>
        <script src="./js/concelhos.js"></script>
        <script>
          function avancar() {



            sessionStorage.setItem('distrito',$('#cb_distrito').find(":selected").text());
            sessionStorage.setItem('concelho',$('#cb_concelhos').find(":selected").text());
            sessionStorage.setItem('tipoevento',$('#cb_tipoevento').find(":selected").text());
            window.location.href="./event.php";
          }
        </script>
      </div>
    </div>  
    <!----------------------------------------------------------------------------------------->
    </body>
</html
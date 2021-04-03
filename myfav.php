<?php 


include './config/include.php';
if(isset($_SESSION['status'])){
  if($_SESSION['status']=="true"){

  }
  else{
    header('Location:./login.php?url=./myfav.php');

  }

}
else
  header('Location:./login.php?url=./myfav.php');
fill_loading($conexao);
?>
<!DOCTYPE html>
<html lang="pt" >
<head>
  <meta charset="UTF-8">
  <title>Guardados - PorEvent </title>
  <?php include './config/links.php';?><!--Links de CSS e JS-->
  </head>
<body>
    
<?php include './template/header.php';?><!--NavBar-->
    <!----------------------------------------------------------------------------------------->
       
    <div class="container-fluid p-l-205  p-r-205  pt-2">
  <div class="px-lg-5">

    
    <div class="row pt-5">
      <div class="col-lg-12 mx-auto border">
        <div class="text-black p-4 banner ">
          <h1 class="login100-form-title  display-4">Guardados</h1>
        </div>
        <div class="row px-5 pb-2">
            <div class="form-group col-4">
              <select class="form-control" id="cb_distrito"  onchange="getComboA(this),query()">
              <option>Todos os Distritos</option>
                <?php foreach ($distritos as $distrito):?>
                  <option value="<?php echo $distrito['Distrito']; ?>"><?php echo $distrito['Distrito']; ?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="form-group col-4">
              <select class="form-control" id="cb_concelhos" onchange="query()" disabled>
              <option>Todos os Concelhos</option>
              <option id="concelho"></option>
              </select>
            </div>
            <div class="form-group col-4">
              <select class="form-control" id="cb_tipoevento" onchange="query()">
              <option>Todas as Categorias</option>
                <?php foreach ($eventos as $evento):?>
                  <option value="<?php echo $evento['TipoEvento']; ?>"><?php echo $evento['TipoEvento']; ?></option>
                <?php endforeach;?>
              </select>
            </div>
        </div>
      </div>
      <script src="./js/concelhos.js"></script>
    </div>
    <div class="row mt-2 mb-5">
      <div class="border col-12">
        <div class="row">
      <div class="form-group pt-3 col-4">
        <div class="input-group input-group-sm">
          <span class="input-group-text" id="inputGroup">Data</span>
          <input class="form-control" type="text" data-toggle="daterangepicker" id="filter_date" maxlength="23" name="timestamp" data-filter-type="date-range">
          <script src="./js/datepicker.js"></script>
        </div>
      </div>
        <div class="form-group pt-3 col-4 ">
        <div class="input-group input-group-sm">
          <span class="input-group-text" id="inputGroup">Preço Max</span>
          <input type="number" class="form-control" min="0" max="" id="filter_preco">
         <span class="input-group-text" id="inputGroup">€</span>
        </div>
        </div>
        <div class="form-group pt-3 col-auto ">
        <div class="input-group input-group-sm radio">
          <input type="radio" class="btn-check" name="options-outlined" value="all" id="todos-outlined" autocomplete="off" checked>
          <label class="btn-sm btn-outline-secondary border m-0" id="l_todos-outlined" for="todos-outlined">Todos</label>
          <input type="radio" class="btn-check" name="options-outlined" value="com" id="com-outlined" autocomplete="off" >
          <label class="btn-sm btn-outline-secondary border m-0"  for="com-outlined">Com Reserva</label>
          <input type="radio" class="btn-check" name="options-outlined" value="sem" id="sem-outlined" autocomplete="off">
          <label class="btn-sm btn-outline-secondary border m-0" for="sem-outlined">Sem Reserva</label>
        </div>
        </div>
        <div class="form-group pt-3 col-auto ">
          <button type="submit" class="btn-sm btn-secondary" onclick="search()">Filtrar</button> 
          <button type="submit" class="btn-sm btn-outline-grey" onclick="query()">Limpar</button> 
        </div>
    </div>
    </div>
    </div>

    <div id="demo">
    <div class="row" id="try">
      
      <!-- Card Eventos -->
    
    </div>
    </div>
  </div>
</div>
      <script src="./js/fav.js"></script>

    <!----------------------------------------------------------------------------------------->
    <?php include './template/footer.php';?><!--NavBar-->   
    </body>
</html>
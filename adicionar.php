<?php 
include './config/include.php';
if(isset($_SESSION['status'])){
  if($_SESSION['status']=="true"){

  }
  else{
    header('Location:./login.php?url=./adicionar.php');
  }

}
else
  header('Location:./login.php?url=./adicionar.php');
fill_loading($conexao);

?>
<!DOCTYPE html>
<html lang="pt" >
<head>
  <meta charset="UTF-8">
  <title>Publicar - PorEvent </title>
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
            <h1 class="login100-form-title  display-4">Publicar Evento</h1>
          </div>
        </div>
      </div>
      <div class="row mt-2 mb-2">
        <div class="border col-12">
          <div class="pt-3 info"><span class="info"><h5>Informações Gerais:</h5> </span></div> 
            <hr>
            <div id="div_info"><div id="info"></div></div>
            <div class="row">
              <div class="form-group pt-3 col-6 ">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup">Nome</span>
                  <input type="text" class="form-control" min="1" max="50" id="nomeevento">
                </div>
              </div>
              <div class="form-group pt-3 col-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text" id="inputGroup">Categoria</span>
                    <select class="form-control form-control-sm" id="cb_tipoevento">
                    <option>Todas as Categorias</option>
                      <?php foreach ($eventos as $evento):?>
                        <option value="<?php echo $evento['TipoEvento']; ?>"><?php echo $evento['TipoEvento']; ?></option>
                      <?php endforeach;?>
                    </select>
                </div>
              </div>  
              <div class="form-group col-2 ">
              <!--------------------------------->
              </div>  
              <div class="form-group col-4">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup">Datas</span>
                  <input class="form-control" type="text" data-toggle="daterangepicker" id="filter_date" maxlength="23" name="timestamp" data-filter-type="date-range">
                  <script src="./js/datepicker.js"></script>
                </div>
              </div>
              <div class="form-group  col-3 ">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup">Hora Inicio</span>
                  <input type="time" class="form-control" id="horaini" >
                </div>
              </div>
              <div class="form-group  col-3 ">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup">Hora Fim</span>
                  <input type="time" class="form-control" id="horafim" >
                </div>
              </div>  
              <div class="form-group col-2 ">
              <!--------------------------------->
              </div>    
              <div class="form-group col-4">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup">Distrito</span>
                  <select class="form-control form-control-sm" id="cb_distrito"  onchange="getComboA(this)">
                    <option>Todos os Distritos</option>
                    <?php foreach ($distritos as $distrito):?>
                      <option value="<?php echo $distrito['Distrito']; ?>"><?php echo $distrito['Distrito']; ?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>  
              <div class="form-group col-4">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup">Concelho</span>
                  <select class="form-control form-control-sm" id="cb_concelhos" disabled>
                  <option>Todos os Concelhos</option>
                  <option id="concelho"></option>
                  </select>
                </div>
              </div>
              <script src="./js/concelhos.js"></script> 
              <div class="form-group col-4 ">
              <!--------------------------------->
              </div> 
              <div class="form-group  col-3 ">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup">Preço</span>
                  <input type="number" class="form-control" step=".01" min="0" id="precoins" >
                  <span class="input-group-text" id="inputGroup">€</span>
                </div>
              </div>
              <div class="form-group col-3 ">
                <div class="mb-3 pt-1 form-check">
                  <input type="checkbox" class="form-check-input" id="reserva">
                  <label class="form-check-label" for="reserva">Necessita Reserva</label>
                </div>   
              </div> 
            </div>
          </div>
        </div>
        <!----------------------------------------------------------------------------------------------------->
        <div class="row mt-2 mb-2">
          <div class="border col-12">
            <div class="pt-3 info"><span class="info"><h5>Descrição:</h5> </span></div> 
              <hr>
              <div class="pb-3" id="div_desc"><div id="desc"></div></div>
              <textarea id="descricao"></textarea>
              <script src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5/tinymce.min.js'></script><script  src="./js/textarea.js"></script>
            <div class="pb-3"></div>
            </div>
          </div>
          <div class="row mt-2 mb-2">
          <div class="border col-12">
            <div class="pt-3 info"><span class="info"><h5>Carregar Imagens:</h5> </span></div> 
              <hr>
              <div class="pb-3"id="div_error"><div id="error"></div></div>
              <input type="file" class="form-control" name="files[]" id ="files" multiple>
              <span><small>Max. 10 Imagens</small></span>
              
              
              <script type="text/javascript">
                $(document).ready(function(){
                  $('#files').change(function(){
                    var form_data = new FormData();
                    
                    /*Lê os ficheiros carregados*/

                    var totalfiles = document.getElementById('files').files.length;
                    $("#error").remove();
                    if(totalfiles>10)
                      $("#div_error").append('<div id="error" class="alert-sm alert-danger rounded" role="alert">Você só pode fazer upload de no máximo 10 Imagens</div>');
                    else{
                      for(var index=0;index<totalfiles;index++){
                      form_data.append('files[]',document.getElementById('files').files[index]);
                      /*AJAX*/
                    $.ajax({
                      url: './request/ajaxfile.php',
                      type: 'post',
                      data: form_data,
                      dataType: 'json',
                      contentType: false,
                      processData: false,
                      success: function(response){
                      
                        if(response.length>0){
                          $('#preview').remove();
                            $('#div_preview').append('<div id="preview" class="row"></div>')
                          for(var index=0;index<response.length;index++){
                            var src = response[index];
                            
                            /* Adicionar img em <div id='preview'>'*/
                            $('#preview').append('<div class="col-auto mb-1"><div class="card" style="width: 18rem;"><a href="'+src+'" target="_black""><img src="'+src+'" class="card-img-top" alt="..."></a></div></div>');
                          }
                        }
                        else
                          $("#div_error").append('<div id="error" class="alert-sm alert-danger rounded" role="alert">Tipo de imagem incompativel! Tente .png, .jpeg ou .jpg</div>');
                      }
                    })
                    }
                    }
                  })
                })
              </script>
              <hr>
              <div id="div_preview" class="mb-3">
                <div id="preview" class="row">

                
              </div>
            </div>
          </div>
          </div>
          <div class="row mt-2 mb-2">
          <div class="reccont">
            <button type="submit" onclick="upload()" class="btn btn-secondary">Publicar</button>
          </div>
          <script src="./js/upload.js"></script>
        </div>  
      </div>
    </div>
  </div>  
      <!----------------------------------------------------------------------------------------->
<?php include './template/footer.php';?><!--NavBar--> 
</body>
</html>

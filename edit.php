<?php 
include './config/include.php';
if(isset($_SESSION['status'])){
  if($_SESSION['status']=="true"){

  }
  else{
    header('Location:./login.php?url=./client.php');
  }

}
else
  header('Location:./login.php?url=./client.php');

  if(isset($_GET["codevent"])){
    if($_GET["codevent"]!=""){
        $codevento=$_GET["codevent"];
        vevento($conexao,$codevento);
    }
    else{
      echo '<script>alert("URL Inválido!")</script>';
      header('Location: ./client.php');
    }
  }
  else{
    echo '<script>alert("URL Inválido!")</script>';
    header('Location:./client.php');
  }
fill_loading($conexao);

?>
<!DOCTYPE html>
<html lang="pt" >
<head>
  <meta charset="UTF-8">
  <title>Editar - PorEvent </title>
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
            <h1 class="login100-form-title  display-4">Editar Evento</h1>
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
                  <input type="text" class="form-control" min="1" max="50" id="nomeevento" >
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
              <div class="reccont ">
                 <a id="editar" href="#" onclick='tinymce.get("descricao").setContent(sessionStorage.getItem("descricao"))' class="btn-sm btn-secondary mb-2 border text-white" > Recarregar Descrição</a>
              </div>
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
            <button type="submit" onclick="upload()" class="btn btn-secondary">Editar</button>
          </div>
          <script>
            var codevento="<?php echo $_GET['codevent'];?>"
            var request = $.ajax({  
                url: './request/loadevent.php',
                type: 'POST',
                data: {'codevento':codevento},
                dataType: 'json',
                cache: false,
                });
                request.done(function(response){
                    $('#nomeevento').val(response['nome']);
                    $('#cb_tipoevento').val(response['tipoevento']);

                    var dataini =  new Date(response['dataini']);
                    var datafim= new Date(response['datafim']);

                    var dateini;
                    if(dataini.getDate()<10 && dataini.getMonth()<10)
                        dateini = '0'+dataini.getDate()+'/0'+(dataini.getMonth()+1)+'/'+dataini.getFullYear();
                    else if(dataini.getDate()<10)
                        dateini = '0'+dataini.getDate()+'/'+(dataini.getMonth()+1)+'/'+dataini.getFullYear();
                    else if(dataini.getMonth()<10)
                        dateini = dataini.getDate()+'/0'+(dataini.getMonth()+1)+'/'+dataini.getFullYear();
                    else
                        dateini = dataini.getDate()+'/'+(dataini.getMonth()+1)+'/'+dataini.getFullYear();
                      
                      var datefim;   
                    if(datafim.getDate()<10 && datafim.getMonth()<10)
                        datefim = '0'+datafim.getDate()+'/0'+(datafim.getMonth()+1)+'/'+datafim.getFullYear();
                    else if(datafim.getDate()<10)
                        datefim = '0'+datafim.getDate()+'/'+(datafim.getMonth()+1)+'/'+datafim.getFullYear();
                    else if(datafim.getMonth()<10)
                        datefim = datafim.getDate()+'/0'+(datafim.getMonth()+1)+'/'+datafim.getFullYear();
                    else
                        datefim = datafim.getDate()+'/'+(datafim.getMonth()+1)+'/'+datafim.getFullYear();

                    $('#filter_date').val(dateini+" - "+ datefim);//----------------------------------------
                    $('#horaini').val(response['horaini']);
                    $('#horafim').val(response['horafim']);
                    $('#cb_distrito').val(response['distrito']);
                    getconcelho(response);
                    $('#precoins').val(response['valor']);
                    tinymce.get("descricao").setContent(response['descricao']);
                    sessionStorage.setItem('descricao',response['descricao']);
                    
                    if(response['reserva']==1)
                        $('#reserva').prop("checked", true);
                    else
                        $('#reserva').prop("checked", false);
                    
                    $('#tinymce').append(response['descricao']);

                    for(var index=0;index<response['src'].length;index++){
                            var src = response['src'][index];

                            $('#preview').append('<div class="col-auto mb-1"><div class="card" style="width: 18rem;"><a href="./img/eventos/'+src['srcdir']+'" target="_black" ><img src="./img/eventos/'+src['srcdir']+'"  class="card-img-top" alt="'+src['Media']+'"></a></div></div>');
                    } 
                   

                })
                
            function getconcelho(response){

              var distrito=response['distrito'];
              var concelho=response['concelho'];
              if(distrito!="Todos os Distrito" && distrito!="Madeira" && distrito!="Açores"){
                var request = $.ajax({
                    type: 'POST',
                    url: '../request/concelhos.php',
                    data: {'distrito':distrito},
                    cache: false,
                    dataType: 'json'
                });

                request.done(function(data) {
      
          
                  if(data.length>0){
                      while(document.getElementById("cb_concelhos").length>0)
                          document.getElementById("cb_concelhos").remove(0);
                      document.getElementById("cb_concelhos").disabled = false;
                      var select = document.getElementById("cb_concelhos"); 
                      var el = document.createElement("option");
                          el.textContent = "Todos os Concelhos";
                          el.value = "Todos os Concelhos";
                          select.appendChild(el);
                      for(var i = 0; i < data.length; i++) {
                          var opt = data[i];
                          var el = document.createElement("option");
                          el.textContent = opt;
                          el.value = opt;
                          select.appendChild(el);
                      }   
                      document.getElementById("cb_concelhos").value = concelho;
                  }    
                }); 
              }
              else if(distrito=="Madeira"){
                var select = document.getElementById("cb_concelhos");
                document.getElementById("cb_concelhos").disabled = true;
                while(document.getElementById("cb_concelhos").length>0)
                    document.getElementById("cb_concelhos").remove(0);
                    var el = document.createElement("option");
                    el.textContent = "Toda a Madeira";
                            el.value = "Todo o Açores";
                            select.appendChild(el);
              }
              else if(distrito=="Açores"){
                var select = document.getElementById("cb_concelhos");
                document.getElementById("cb_concelhos").disabled = true;
                while(document.getElementById("cb_concelhos").length>0)
                    document.getElementById("cb_concelhos").remove(0);
                    var el = document.createElement("option");
                    el.textContent = "Todo o Açores";
                            el.value = "Todo o Açores";
                            select.appendChild(el);
              }
              else{
                var select = document.getElementById("cb_concelhos");
                document.getElementById("cb_concelhos").disabled = true;
                while(document.getElementById("cb_concelhos").length>0)
                    document.getElementById("cb_concelhos").remove(0);
                    var el = document.createElement("option");
                    el.textContent = "Todos os Concelhos";
                            el.value = "Todos os Concelhos";
                            select.appendChild(el);
                
                
              }
            }
            function upload() {
                var nome=$("#nomeevento").val();
                var tipoevento=$("#cb_tipoevento").val();
                var dat=$("#filter_date").val();
                var horaini=$("#horaini").val();
                var horafim=$("#horafim").val();
                var distrito=$("#cb_distrito").val();
                var concelho=$("#cb_concelhos").val();
                var preco=$("#precoins").val();
                var reserva=$("#reserva").prop('checked');
                var descricao=tinymce.get("descricao").getContent();
                
                var datas = dat.split(" - ");
                var dataini = datas[0].split("/");
                var datafim = datas[1].split("/");
                
                var dateini = dataini[2]+'-'+dataini[1]+'-'+dataini[0];
                var datefim = datafim[2]+'-'+datafim[1]+'-'+datafim[0];
                var form_data = new FormData();
                var totalfiles = document.getElementById('files').files.length;
                
                
                var erros=0;

                $('#info').remove();
                $('#desc').remove();
                $("#error").remove();
                $("#div_info").append('<div id="info"></div>');
                if(nome==""){
                    erros=1;
                    $("#info").append('<div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">O <u>Nome</u> é obrigatorio.</div>');
                }   
                if(tipoevento=="Todas as Categorias"){
                    erros=1;
                    $("#info").append('<div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">Não é possivel <u>Todas as Categorias</u>.</div>');
                }
                if(new Date()>new Date(datafim[2],datafim[1]-1,datafim[0])){
                    erros=1;
                    $("#info").append('<div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">A <u>Data</u> não pode ser igual ou inferior a Hoje.</div>');
                }  
                if(horaini=="") {
                    erros=1;
                    $("#info").append('<div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">A <u>Hora Inicio</u> é obrigatoria.</div>');
                }    
                else if(horafim=="") 
                    horafim=horaini;
                if(distrito=="Todos os Distritos"){
                    erros=1;
                    $("#info").append('<div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">Não é possivel <u>Todos os Distritos</u>.</div>');
                }  
                else if(concelho=="Todos os Concelhos"){
                    erros=1;
                    $("#info").append('<div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">Não é possivel <u>Todos os Concelhos</u>.</div>');
                }     
                if(preco=="")
                    preco=0;
                if(descricao==""){
                    erros=1;
                    $("#div_desc").append('<div id="desc"><div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">A Descrição é obrigatoria.</div></div>');
                }
                
                if(reserva==true)
                    reserva=1;
                else
                    reserva=0;

                
              if(erros==0){

                var request = $.ajax({
                    type: 'POST',
                    url: './request/editevento.php',
                    data:{'codevento':codevento,'nome':nome,'tipoevento':tipoevento,'dataini':dateini,'datafim':datefim,'horaini':horaini,'horafim':horafim,'concelho':concelho,'preco':preco,'reserva':reserva,'descricao':descricao},
                    cache: false,
                    dataType: 'json'
                })
                request.done(function(dat) {
                    var responde=false;
                    if(dat!=false)
                        for(var index=0;index<totalfiles;index++){
                            form_data.append('files[]',document.getElementById('files').files[index]);
                            form_data.append('codevento',dat);
                            /*AJAX*/
                            console.log('file: upload.js => line 92 => request.done => form_data', form_data)
                        $.ajax({
                            url: './request/editimg.php',
                            type: 'post',
                            data: form_data,
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(response){
                                responde=response;
                            }
                        })
                        
                    }
                    else{
                        $("#div_desc").append('<div id="desc"><div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">Caracteres Invalidos</div></div>');
                    }
                    var datahora;
                    if(dateini==datefim){
            
                        if(horaini==horafim){
                            datahora = dateini+' ás '+horaini;
                        }
                        else{
                            datahora = dateini + ' ás ' + horaini + ' até ' + horafim;
                        }
                        
                    }
                    else{
                        datahora = dateini + ' ás ' + horaini + ' até ' + datefim + ' ás ' + horafim;
                    }
                    
                    var local;
                    if(distrito=="Madeira"||distrito=="Açores")
                        local=concelho;
                    else
                        local=concelho+","+distrito;

                    var reser;  
                        if(reserva==1)
                            reser="Sim";
                        else
                            reser="Não";
                    
                    if(responde!=false)
                        $("#div_error").append('<div id="error" class="alert-sm alert-danger rounded" role="alert">'+response+'</div>'); 
                    else{
                        alert('Evento criado com sucesso.\n\n'+
                        'Nome: '+nome+'\n'+
                        'Categoria: '+tipoevento+'\n'+
                        'Data/Hora: '+datahora+'\n'+
                        'Local: '+local+'\n'+
                        'Preço: '+preco+'€\n'+
                        'Reserva: '+reser+'\n');
                        window.location.replace("./evento.php?codevent="+dat);
                    }
                })
              }
            }
          </script>
        </div>  
      </div>
    </div>
  </div>  
      <!----------------------------------------------------------------------------------------->
<?php include './template/footer.php';?><!--NavBar--> 
</body>
</html>

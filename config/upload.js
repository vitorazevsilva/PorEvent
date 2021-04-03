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
    if(totalfiles==0){
        erros=1;
        $("#div_error").append('<div id="error"><div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">É obrigatorio uma imagem.</div></div>');
    }
    else if(totalfiles>10){
        erros=1;
        $("#div_error").append('<div id="error" class="alert-sm alert-danger rounded" role="alert">Você só pode fazer upload de no máximo 10 Imagens</div>');
    }
    
    if(reserva==true)
        reserva=1;
    else
        reserva=0;

    
   if(erros==0){

    var request = $.ajax({
        type: 'POST',
        url: '../request/novoevento.php',
        data:{'nome':nome,'tipoevento':tipoevento,'dataini':dateini,'datafim':datefim,'horaini':horaini,'horafim':horafim,'concelho':concelho,'preco':preco,'reserva':reserva,'descricao':descricao},
        cache: false,
        dataType: 'json'
    })
    request.done(function(dat) {
        if(dat!=false)
            for(var index=0;index<totalfiles;index++){
                form_data.append('files[]',document.getElementById('files').files[index]);
                form_data.append('codevento',dat);
                /*AJAX*/
                console.log('file: upload.js => line 92 => request.done => form_data', form_data)
            $.ajax({
                url: './request/novaimg.php',
                type: 'post',
                data: form_data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response){
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

                    if(response!=false)
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
                }
            })
        }
        else{
            $("#div_desc").append('<div id="desc"><div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">Caracteres Invalidos</div></div>');
        }
    })
   }
}

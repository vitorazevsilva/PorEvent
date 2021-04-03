$( document ).ready(function() {
    console.log( "ready!" );
    $('#filter_date').val('');
      search();
    
    
    
 
  });
  var where="";
  var demovalue="all";
  function query(){
    $('#filter_date').val('');
    $('#filter_preco').val('');
    document.getElementById("todos-outlined").checked = true;
    demovalue="all";
    where="";
    search();
  }
  
    $('.radio input[type="radio"]').click(function(){
       demovalue = $(this).val();
    
    });
  
  function search(){
    
      var cb_distrito = $('#cb_distrito').find(":selected").text();
      var cb_concelho = $('#cb_concelhos').find(":selected").text();
      var cb_tipoevento = $('#cb_tipoevento').find(":selected").text();
      var tb_preco= document.getElementById("filter_preco").value;
      var data=document.getElementById("filter_date").value;
      where="";
        if(data!=""){
          var adatad = data.split(' - ');
          var adata = adatad[0].split('/');//antes
          var datad = adatad[1].split('/');//depois
          var antes = adata[2]+'-'+adata[1]+'-'+adata[0];
          var depois = datad[2]+'-'+datad[1]+'-'+datad[0];
          if(antes==depois){
            where=where+'Dataini  <="'+antes+'" AND Datafim >= "'+depois+'" And ';
           }
          else{
            where=where+'((Dataini BETWEEN "'+antes+'" AND "'+depois+'") OR (Datafim BETWEEN "'+antes+'" and "'+depois+'")) AND '    
          }
        }
        else
          where=where+'1=1 AND ' ;
      
      
      
     
      if(cb_distrito!='Todos os Distritos' && cb_distrito!='Madeira' && cb_distrito!='Açores'){
        if(cb_concelho!='Todos os Concelhos')
          where=where+'Concelho = "'+cb_concelho+'" AND ';
        else
          where=where+'Distrito = "'+cb_distrito+'" AND ';
      }
      else if(cb_distrito=='Madeira' || cb_distrito=='Açores'){
        where=where+'Distrito = "'+cb_distrito+'" AND ';
      }
  
      if(cb_tipoevento!='Todas as Categorias')
        where=where+'TipoEvento = "'+cb_tipoevento+'" AND ';
  
      if(tb_preco!='')
        where=where+'Valor <= '+tb_preco+' AND ';
        
      if(demovalue=="com")
        where=where+'Reserva = 1 AND ';
      else if(demovalue=="sem")
        where=where+'Reserva = 0 AND ';
        
      
      
  
        
      where=where.substring(0,where.length-4);
      var request = $.ajax({
        
          type: 'POST',
          url: '../request/fav.php',
          data:{'where':where},
          cache: false,
          dataType: 'json'
      });
  
      request.done(function(data) {
        console.log('Atualizado - '+ Date())
  
        
        $('#try').remove();
        $("#demo").append('<div class="row" id="try"></div>');
        
        if(data.length>0)
        for(var i=0;i<data.length;i++)
        {
          var Titulo = data[i].Nome;
          var Descricao =  data[i].Descricao;
          var dataini =  new Date(data[i].Dataini);
          var horaini= new Date('1990-01-01T'+data[i].Horaini);
          var datafim= new Date(data[i].Datafim);
          var horafim= new Date('1990-01-01T'+data[i].Horafim);
          var Tipo = data[i].TipoEvento;
          var href = data[i].CodEvento;
          var img_alt = data[i].Media;
          var src = data[i].srcdir;
          var days = data[i].Datadif;
          var Data;
  
          if(Descricao.length>250)
            Descricao=Descricao.substring(0,250)+" ...";
  
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
  
          var horini;
         if(horaini.getHours()<10 && horaini.getMinutes()<10)
            horini = '0'+horaini.getHours()+':0'+horaini.getMinutes();
         else if(horaini.getHours()<10)
            horini = '0'+horaini.getHours()+':'+horaini.getMinutes();
         else if(horaini.getMinutes()<10)
            horini = horaini.getHours()+':0'+horaini.getMinutes();
         else 
            horini = horaini.getHours()+':'+horaini.getMinutes();
  
          var horfim;
         if(horafim.getHours()<10 && horafim.getMinutes()<10)
              horfim = '0'+horafim.getHours()+':0'+horafim.getMinutes();
         else if(horafim.getHours()<10)
              horfim = '0'+horafim.getHours()+':'+horafim.getMinutes();
         else if(horafim.getMinutes()<10)
              horfim = horafim.getHours()+':0'+horafim.getMinutes();  
        else 
              horfim = horafim.getHours()+':'+horafim.getMinutes();
     
        if(dateini==datefim){
  
          if(horini==horfim){
            Data = dateini+' ás '+horini;
          }
          else{
            Data = dateini + ' ás ' + horini + ' até ' + horfim;
          }
          
        }
        else{
          Data = dateini + ' ás ' + horini + ' até ' + datefim + ' ás ' + horfim;
        }
    
          var Novo;
         
          if(days<5)
              Novo = '<div class="badge badge-danger px-3 rounded-pill font-weight-normal">Novo</div>';
          else
              Novo = '<div class="badge badge-light px-3 rounded-pill font-weight-normal"></div>';
  
  
  
  
  
              $("#try").append('<div class="col-xl-3 col-lg-4 col-md-6 mb-4" id="del"><a href="evento.php?codevent='+href+'"><div class="bg rounded shadow-sm"><img src="./img/eventos/'+src+'" alt="'+img_alt+'" class="img-fluid card-img-top"></a><div class="p-4 border "><h5> <a href="evento.php?codevent='+href+'" class="text-dark text-break">'+Titulo+'</a></h5><p id="text" class="small text-muted mb-0 text-break">'+strip_tags(Descricao, '')+'</p><p></p><p class="small mb-0">'+Data+'</p><div class="d-flex align-items-center justify-content-between rounded-pill "><p class="small mb-0"><span class="font-weight-bold">'+Tipo+'</span></p>'+Novo+'</div></div></div></div>');
       
        }
        else
          $("#try").append('<center><h2 class="form-title">Nenhum Evento Encontrado</h2></center>');
      })   
  }
  //strip_tags js and jquery
  function strip_tags (input, allowed) {

    allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); 
    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
        commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
    });
}
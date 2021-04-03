$( document ).ready(function() {
    var orderby="";
    order(orderby);
});
var ord=['nome','up'];
$('#name').click(function(){  
    
        if(ord[0]=='nome'){
            if(ord[1]=="up"){
                ord[1]="down";
                var orderby="Order BY Nome DESC";
                order(orderby);
            }
            else if(ord[1]=="down"){
                ord[1]="up";
                var orderby="Order BY Nome ASC";
                order(orderby);
            }
        }
        else{
            ord[0]="nome";
            ord[1]="up";
            var orderby="Order BY Nome ASC";
            order(orderby);
        }

    
    
})

$('#categoria').click(function(){  
    if(ord[0]=='categoria'){
        if(ord[1]=="up"){
            ord[1]="down";
            var orderby="Order BY Categoria DESC";
            order(orderby);
        }
        else if(ord[1]=="down"){
            ord[1]="up";
            var orderby="Order BY Categoria ASC";
            order(orderby);
        }
    }
    else{
        ord[0]="categoria";
        ord[1]="up";
        var orderby="Order BY Categoria ASC";
        order(orderby);
    }
})

$('#data').click(function(){  
    if(ord[0]=='data'){
        if(ord[1]=="up"){
            ord[1]="down";
            var orderby="Order BY Dataini DESC";
            order(orderby);
        }
        else if(ord[1]=="down"){
            ord[1]="up";
            var orderby="Order BY Dataini ASC";
            order(orderby);
        }
    }
    else{
        ord[0]="data"
        ord[1]="up";
        var orderby="Order BY Dataini ASC";
        order(orderby);
    }
   
})

$('#localizacao[name=""]').click(function(){  
    if(ord[0]=='localizacao'){
        if(ord[1]=="up"){
            ord[1]="down";
            var orderby="Order BY Distrito,Concelho DESC";
            order(orderby);
        }
        else if(ord[1]=="down"){
            ord[1]="up";
            var orderby="Order BY Distrito,Concelho ASC";
            order(orderby);
        }
    }
    else{
        ord[0]="localizacao"
        ord[1]="up";
        var orderby="Order BY Distrito,Concelho ASC";
        order(orderby);
    }
    
    
})

function order(orderby){
    var request = $.ajax({  
        type: 'POST',
        url: '../request/tabela.php',
        data: {'orderby':orderby},
        cache: false,
        dataType: 'json'
    });

    request.done(function(data) {
        $('#tabela').remove();
        $('#demo').append('<div id="tabela"></div>');
        if (data.length>0)
            for(var i=0;i<data.length;i++){
                var Nome = data[i].Nome;
                var dataini =  new Date(data[i].Dataini);
                var datafim= new Date(data[i].Datafim);
                var Tipo = data[i].TipoEvento;
                var Concelho = data[i].Concelho;
                var Distrito = data[i].Distrito;
                var CodEvento = data[i].CodEvento;

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
                var Localizacao;
                 if(Distrito=="Madeira"||Distrito=="Açores")
                    Localizacao= Concelho;
                 else
                    Localizacao=Concelho+","+Distrito

                var Data;
                if(dateini=datefim)
                    Data=dateini;
                else
                    Data=dateini+" - "+datefim
                    $("#tabela").append('<li class="table-row"><div class="col col-3 pt-1" data-label="Nome"><a style="text-decoration: underline;" href="evento.php?codevent='+CodEvento+'">'+Nome+'</a></div><div class="col col-3 pt-1" data-label="Categoria">'+Tipo+'</div><div class="col col-2 pt-1" data-label="Data">'+Data+'</div><div class="col col-3 pt-1" data-label="Localização">'+Localizacao+'</div> <div class="col col-1"><a style="color: #6C757D; font-size: 20px;" href="./edit.php?codevent='+CodEvento+'" class="bi bi-pen-fill" id="opc" ></a> | <a style="color: #6C757D; font-size: 20px;" href="./client.php?m&c='+CodEvento+'" class="bi bi-calendar-x-fill" onclick="return confirm(\'Tem a certeza que pretende eliminar o evento?\')"></a></div></li>');
            }
            else
                $("#tabela").append('<center><h5 class="form-title">Nenhum Evento Encontrado</h5></center>');
           
    
    
    })
}

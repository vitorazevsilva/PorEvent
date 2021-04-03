function getComboA(selectObject) {
    var distrito = selectObject.value;  
    if(distrito!="Todos os Distritos" && distrito!="Madeira" && distrito!="Açores"){
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
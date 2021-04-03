var request = $.ajax({
    type: 'POST',
    url: '../request/infoconta.php',
    cache: false,
    dataType: 'json'
});

request.done(function(data) {

    document.getElementById("nome").value = data[0].Nome;
    document.getElementById("datan").value = data[0].DataNascimento;
    document.getElementById("email").value = data[0].Email;
    document.getElementById("sexo").value = data[0].Sexo;
    document.getElementById("contacto").value = data[0].Contacto;
    document.getElementById("password").value = data[0].PASSWORD;
  
    
})

function editar(){
  
  if(document.getElementById('editar').text == " Editar")
  {
    
    $('input:disabled').prop("disabled", false);
    $('select:disabled').prop("disabled", false);
    sessionStorage.setItem('nome',document.getElementById('nome').value);
    sessionStorage.setItem('email',document.getElementById('email').value);
    sessionStorage.setItem('contacto',document.getElementById('contacto').value);
    sessionStorage.setItem('data',document.getElementById('data').value);
    sessionStorage.setItem('sexo',document.getElementById('sexo').value);
    sessionStorage.setItem('password',document.getElementById('password').value);
    document.getElementById("editar").text = " Guardar";
  }
  else{
   
    

    var nome=document.getElementById('nome').value;
    var email=document.getElementById('email').value;
    var tel=document.getElementById('contacto').value;
    var data=document.getElementById('datan').value;
    var sexo=document.getElementById('sexo').value;
    var pass=document.getElementById('password').value;      
    
  
    var erros=null;
    if(nome=="" && email=="" && pass=="" )
      erros = "Nome, Email e Palavra-Passe Obrigatorios!";
    else if(nome=="")
      erros = "Nome Obrigatorio!";
    else if(email=="")
      erros = "Email Obrigatorio!";
    else if(pass=="")
      erros = "Palavra-Passe Obrigatoria!";
    else if(pass.length<8)
      erros = "Palavra-Passe tem de ter mais de 8 caracteres!";
    else if(!validateEmail(email))
      erros ="O Email tem um formato inválido!";
    else if(tel!=""){
      tel = tel.replace(' ', '', tel);
      tel = tel.replace(' ', '', tel);
      if(!validateNumber(tel))
        erros = 'O contacto tem um formato invalido!';
      
        
    }

    if(erros==null){
      
      $('#error').remove();
      $('input').prop("disabled", true);
      $('select').prop("disabled", true);
      document.getElementById("editar").text = " Editar";

      var request = $.ajax({
        type: 'POST',
        url: '../request/upclient.php',
        data:{'nome':nome,'email':email,'contacto':tel,'sexo':sexo,'data':data,'pass':pass},
        cache: false,
        dataType: 'json'
    });
    
    request.done(function(data) {
      if(data!=null){
      $('#error').remove();
      $("#div_error").append('<div id="error" class="form-group col-12 "><div class=" input-group-sm"><div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">'+data["Developer"]+'</div></div></div>');
      document.getElementById('nome').value=sessionStorage.getItem('nome');
      document.getElementById('email').value=sessionStorage.getItem('email');
      document.getElementById('contacto').value=sessionStorage.getItem('contacto');
      document.getElementById('sexo').value=sessionStorage.getItem('sexo');
      document.getElementById('data').value=sessionStorage.getItem('data');
      document.getElementById('password').value=sessionStorage.getItem('password');
      }

    })
      
    }
    else{
      $('#error').remove();
      $("#div_error").append('<div id="error" class="form-group col-12 "><div class=" input-group-sm"><div class="alert-sm alert-danger alert-block p-1 rounded" role="alert">'+erros+'</div></div></div>');
    }
      
                    
            
    
    
  }
        


      
      
      
      
    
    
    
    


               
  
}
console.log('file: client.js => line 78 => validateNumber(tel)', validateNumber("111 111 111"))
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
    
}

function validateNumber(tel)
{
  var re = /^\d{9}$/;
  return re.test(tel);
}




function correct(){
  document.getElementById("editar").text = " Editar";
}

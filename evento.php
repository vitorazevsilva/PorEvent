<?php 
include './config/include.php';
//echo '<script>alert("⚠️Esta página encontra-se em manutenção!⚠️")</script>';
if(isset($_GET["codevent"])){
  if($_GET["codevent"]!=""){
    $codevento=$_GET["codevent"];
    evento($conexao,$codevento);
  }
  else{
    echo '<script>alert("URL Inválido!")</script>';
    header('Location: ./event.php');
  }
}
else{
  echo '<script>alert("URL Inválido!")</script>';
  header('Location:./event.php');
}
?>

<!DOCTYPE html>
<html lang="pt" >
<head>
  <meta charset="UTF-8">
  <title><?php echo ($evento["0"]); ?> - PorEvent</title>
  <?php include './config/links.php';?><!--Links de CSS e JS-->
  </head>
<body>
<?php include './template/header.php';?><!--NavBar-->

    <!----------------------------------------------------------------------------------------->
       
    <div class="container-fluid p-l-205  p-r-205  pt-2">
      <div class="px-lg-5">
        <div class="row pt-5 pb-3">
          <div class="col-lg-12 mx-auto">
            <div class="text-black p-4 banner ">
              <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <?php $abc=0?>
                  <?php foreach ($medias as $media):?> 
                  <div class="carousel-item <?php if($abc==0)echo ('active');?>">
                    <?php $abc++; ?>
                    <img src="./img/eventos/<?php echo ($media["srcdir"]);?>" class="d-block w-100" alt="<?php echo ($media["Media"]);?>" >
                  </div>
                  <?php endforeach;?>
                </div>
                <a class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Anterior</span>
                </a>
                <a class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Próximo</span>
                </a>
              </div>
              <script>
                $(document).ready(function(){
                  $('#carouselExampleIndicators').carousel({
                    pause: true,
                    interval: false
                  });
                });
              </script>
            </div>
          </div>
        </div>
      
  
        <div class="row mt-2 mb-2">
          <div class="border col-12">
            <div class="pt-3 titevent"><span class="titevent text-break"><?php echo (" " .$evento["0"]); ?></span></div> 
              <hr>
              <div class="row text-break">
                <div class="col-5">
                <i style="font-size: 20px;" class="bi bi-hash"></i><span style="font-size: 15px;"><?php echo (" " .$evento["1"]); ?></span><br>
                <i style="font-size: 20px;" class="bi bi-geo-alt"></i><span style="font-size: 15px;"><?php echo (" " .$evento["2"]); ?></span><br>
                <i style="font-size: 20px;" class="bi bi-calendar-range"></i><span style="font-size: 15px;"><?php echo (" " .$evento["4"]); //If do outro lado ?></span><br>
                <i style="font-size: 20px;" class="fa fa-ticket-alt mt-2"></i><span style="font-size: 14px;"><?php echo (" " .$evento["8"]); ?></span><br>
                <i style="font-size: 20px;" class="fa fa-euro-sign mt-2 mr-2"></i><span class="mt-2" style="font-size: 15px;"><?php echo (" " .$evento["10"]);//if do outro lado ?></span><br>
                </div>
                <div class="col-5">
                <i style="font-size: 20px;" class="bi bi-person-square"></i><span style="font-size: 15px;"><?php echo (" " .$evento["12"]); ?></span><br>
                <i style="font-size: 20px;" class="bi bi-at"></i><span style="font-size: 15px;"><?php echo (" " .$evento["13"]); ?></span><br>
                <?php echo ('<i style="font-size: 20px;" class="bi bi-telephone"></i><span style="font-size: 15px;"> ' .$evento["14"]. '</span><br>');?>
                
                </div>
                <?php
                if(isset($_SESSION['status']))
                  if($_SESSION['status']=="true"){
                    $query = 'SELECT CodFav FROM favoritos WHERE CodUser='.$_SESSION["coduser"].' AND CodEvento= '.$_GET["codevent"];
                    $result = mysqli_query($conexao,$query); 
                    if(mysqli_num_rows($result)>0){
                      echo '<div class="col-2 reccont"><input type="checkbox" class="btn-check" id="guarda" autocomplete="off" checked><label class="btn btn-outline-secondary w3-rounded" for="guarda">Guardar</label></div>';
                    } 
                    else
                    {
                      echo '<div class="col-2 reccont"><input type="checkbox" class="btn-check" id="guarda" autocomplete="off"><label class="btn btn-outline-secondary w3-rounded" for="guarda">Guardar</label></div>';
                    }
                  }
                    
                ?>
              </div>
                <script>
                  var option;
                  $('#guarda').click(function() {
                      if (!$(this).is(':checked')) {
                        return confirm("Deseja retirar dos guardados?");
                      }
                  });

                  $('#guarda').change(function() {
                      if($(this).is(':checked')){
                        option=1;
                      }
                      else{
                        option=0;
                      }
                    var request = $.ajax({
                    type: 'POST',
                    url: './request/guarda.php',
                    data:{'option':option,'codevento':<?php echo ($_GET["codevent"]); ?>},
                    cache: false,
                    dataType: 'json'
                    });

                    request.done(function(data) {
                      console.log(data);
                      
                    });
                  });
                </script>
              <div class="mx-3 mt-5 mb-3 text-break" >
                <span>
                  <?php echo nl2br($evento["11"]);?>
                </span>
              </div>
            </div>
          </div>
        </div>
    
    <!----------------------------------------------------------------------------------------->
    <?php include './template/footer.php';?><!--NavBar--> 
    </body>
</html>
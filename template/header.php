<!-- partial:index.partial.html -->
<!-- Navigation -->
<div class="b-nav">
  <li><a class="b-link" href="/">Inicio</a></li>
  <?php if(isset($_SESSION['status'])){if($_SESSION['status']=="true")echo '<li><a class="b-link" href="./adicionar.php" >Publicar</a></li>';}?>
  <?php if(isset($_SESSION['status'])){if($_SESSION['status']=="true")echo '<li><a class="b-link" href="./myfav.php" >Guardados</a></li>';}?>
  <?php if(isset($_SESSION['status'])){if($_SESSION['status']=="true")echo '<li><a class="b-link" href="./client.php" >Conta</a></li>';}else{echo '<li><a class="b-link" href="./login.php?url='.$_SERVER['PHP_SELF'].'">Entrar</a></li>';}?>
  <?php if(isset($_SESSION['status'])){if($_SESSION['status']=="true")echo '<li><a class="b-link" href="exit.php?url='.$_SERVER['PHP_SELF'].'" >Sair</a></li>';}else{echo '<li><a class="b-link" href="./new.php?url='.$_SERVER['PHP_SELF'].'">Regista-te Já</a></li>';}?> 
</div>

<!-- Burger-Icon -->
<div class="b-container">
  <div class="b-menu">
    <div class="b-bun b-bun--top"></div>
    <div class="b-bun b-bun--mid"></div>
    <div class="b-bun b-bun--bottom"></div>
  </div>

  <!-- Burger-Brand -->
  <a href="/" class="b-brand">PorEvent</a>
</div>
<!-- partial -->
  <script  src="./js/script.js"></script>

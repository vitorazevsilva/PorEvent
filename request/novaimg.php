<?php
include '../config/mysql_connect.php';
include '../config/Logic.php';
$erro=false;
$codevento=$_POST['codevento'];
// Conta todos os ficheiros
$countfiles = count($_FILES['files']['name']);

//Criar Pasta
//mkdir("../temp/".$pathcod."/", 0700);

//Pasta de Uploads
$upload_location = "../img/eventos/";

//Para armazenar o caminho dos arquivos carregados
$files_arr = array();

//Loop todos os arquivos
for($index = 0;$index < $countfiles;$index++){
    $filenamesave = $_FILES['files']['name'][$index];
    
    //Obter extensão
    $ext = pathinfo($filenamesave,PATHINFO_EXTENSION);
    $filename = MD5(uniqid()).".".$ext;
    //Extensões de imagem válidas
    $valid_ext = array("png","jpeg","jpg");

    //Verifique a extensão
    if(in_array($ext,$valid_ext)){
        // Caminho de arquivo
        $path = $upload_location.$filename;
       
        //Upload arquivo
        if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
            $query = 'INSERT INTO `media`(`CodEvento`, `Media`, `srcdir`) VALUES ('.$codevento.',"'.$filenamesave.'","'.$filename.'")';
            $result = mysqli_query($conexao,$query);
        }
    }
    else{
        $erro="Tipo de Imagem Invalido. (.png, .jpeg, .jpg)";
    }
}

echo json_encode($erro);
die;
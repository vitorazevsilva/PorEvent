<?php

// Conta todos os ficheiros
$countfiles = count($_FILES['files']['name']);

//Gera Codigo Unico 
$pathcod = date('YmdHis') . '_';

//Criar Pasta
//mkdir("../temp/".$pathcod."/", 0700);

//Pasta de Uploads
$upload_location = "../temp/";

//Para armazenar o caminho dos arquivos carregados
$files_arr = array();

//Loop todos os arquivos
for($index = 0;$index < $countfiles;$index++){
    $filename = $pathcod.$_FILES['files']['name'][$index];
    
    //Obter extensão
    $ext = pathinfo($filename,PATHINFO_EXTENSION);

    //Extensões de imagem válidas
    $valid_ext = array("png","jpeg","jpg");

    //Verifique a extensão
    if(in_array($ext,$valid_ext)){
        // Caminho de arquivo
        $path = $upload_location.$filename;

        //Upload arquivo
        if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
            $files_arr[] = $path;
        }
    }
}

echo json_encode($files_arr);
die;
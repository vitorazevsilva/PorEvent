<?php


// variaveis para acesso ao banco de dados
$DB_SERVER = '127.0.0.1';//Local onde esta instalado o mySQL
$DB_USERNAME = '';//Nome de utilizador a usar no acesso
$DB_PASSWORD = '';//Palavra-chave a usar no acesso
$DB_NAME = 'porevent';//Nome da base de dados a aceder

// validar a conexao
$conexao = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME );


if (!$conexao) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}


$localhost="http://porevent.eu5.org";



?>

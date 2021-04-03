<?php
include '../config/mysql_connect.php';
include '../config/Logic.php';
$codevento=$_POST['codevento'];
$query = 'SELECT Nome, Descricao, TipoEvento, Dataini, Datafim, Horaini, Horafim, Distrito, Concelho, Valor, Reserva FROM tipoeventos INNER JOIN ((distrito INNER JOIN concelho ON distrito.CodDistrito = concelho.CodDistrito) INNER JOIN evento ON concelho.CodConcelho = evento.CodConcelho) ON tipoeventos.CodTipo = evento.CodTipo WHERE evento.CodEvento='.$codevento;
$eventos = mysqli_query($conexao,$query);
if(mysqli_num_rows($eventos)>0){
    $evento = mysqli_fetch_object($eventos);
    $rows['nome']=$evento->Nome;
    $rows['descricao']=$evento->Descricao;
    $rows['tipoevento']=$evento->TipoEvento;
    $rows['dataini']=$evento->Dataini;
    $rows['datafim']=$evento->Datafim;
    $rows['horaini']=$evento->Horaini;
    $rows['horafim']=$evento->Horafim;
    $rows['distrito']=$evento->Distrito;
    $rows['concelho']=$evento->Concelho;
    $rows['valor']=$evento->Valor;
    $rows['reserva']=$evento->Reserva;

    $query = 'SELECT Media,srcdir From media Where codevento="'.$codevento.'"';
    $medias=mysqli_query($conexao,$query);
    $index=0;
    while($row=$medias->fetch_assoc())
        $rows['src'][$index++]=$row;
        
 
    
}
echo json_encode($rows);   
exit;
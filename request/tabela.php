<?php
            include '../config/mysql_connect.php';
            include '../config/Logic.php';
            ob_start();
            $orderby=$_POST['orderby'];
                if (session_id() =='')session_start();
                $query ='SELECT Nome, TipoEvento, Concelho, Distrito, Dataini, Datafim, CodEvento FROM tipoeventos INNER JOIN ((distrito INNER JOIN concelho on distrito.CodDistrito = concelho.CodDistrito)INNER JOIN evento on concelho.CodConcelho = evento.CodConcelho) on tipoeventos.CodTipo = evento.CodTipo WHERE CodUser='.$_SESSION['coduser'].' '.$orderby;
                $result = mysqli_query($conexao,$query);
                $rows=[];
                while ($row=$result->fetch_assoc())
                    array_push($rows,$row);
                    
                echo json_encode($rows);
                exit;
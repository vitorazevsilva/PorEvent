<?php 

            include '../config/mysql_connect.php';
            include '../config/Logic.php';
            
            ob_start();
            $codevento=$_POST['codevento'];
            $option=$_POST['option'];
            if (session_id() =='')session_start();
            if($option==1){
                $query = 'INSERT INTO favoritos(CodUser,CodEvento) VALUES ('.$_SESSION["coduser"].','.$codevento.')';
                $result=mysqli_query($conexao,$query);
            }
            elseif($option==0){
                $query = 'DELETE FROM favoritos WHERE CodUser='.$_SESSION["coduser"].' AND CodEvento='.$codevento;
                $result=mysqli_query($conexao,$query);
            }

            
            
            echo json_encode("");
            exit();
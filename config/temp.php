<?php
$path = "temp/";
$diretorio = dir($path);
while($arquivo=$diretorio -> read()){

           $di = new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS);
           $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
           
           foreach ( $ri as $file ) {
             
               $arquivos=explode('_',  $file->getFilename());
               $time = ((date('YmdHis')) - $arquivos[0]);
               if ($time>10000) 
               $file->isDir() ?  rmdir($file) : unlink($file);
           }
        }
    

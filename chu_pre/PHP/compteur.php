<?php
$f = "cpt.txt";
             if(file_exists($f)) 
             {
                 $nVisite = file_get_contents($f);
                 
                 $nVisite++; 
             }
             else 
             {
                 $nVisite = 1;
             }
             file_put_contents($f, $nVisite);
?>
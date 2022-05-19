<?php
    
    session_start();
    date_default_timezone_set("Europe/Bucharest");
    require_once("functii/schimbare-tema.php");
    
    function afisareTimp($t) {
        $r = date('h:i A - d/m/Y', $t);
        return $r;
    }

    $link = mysqli_connect('localhost', 'root', '', 'lucrare_atestat_Muresan_Mihai_XII_B');
?>

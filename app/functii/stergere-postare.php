<?php
    session_start();
    date_default_timezone_set("Europe/Bucharest");
    require_once("schimbare-tema.php");
    
    function afisareTimp($t) {
        $r = date('h:i A - d/m/Y', $t);
        return $r;
    }

    $link = mysqli_connect('localhost', 'root', '', 'lucrare_atestat_Muresan_Mihai_XII_B');
    
    if(!isset($_SESSION['user'])) {
        header('location: ./autentificare.php?operatie=login');
        die();
    }

    $qPostare = mysqli_query(
        $link,
        "SELECT id, id_user FROM postari
        WHERE id = {$_GET['postare']}"
    );
    $postare = mysqli_fetch_assoc($qPostare);

    if($postare['id_user'] != $_SESSION['user']['id']) {
        header('location: ../');
        die();
    }
    else {
        $qDelete = mysqli_query(
            $link,
            "DELETE FROM postari WHERE id = '{$_GET['postare']}';"
        );
        header('location: ../');
        die();
    }

?>
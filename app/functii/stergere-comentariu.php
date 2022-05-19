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

    $qComentariu = mysqli_query(
        $link,
        "SELECT id, id_user, id_postare FROM comentarii
        WHERE id = {$_GET['comentariu']}"
    );
    $comentariu = mysqli_fetch_assoc($qComentariu);

    if($comentariu['id_user'] != $_SESSION['user']['id']) {
        header('location: ../');
        die();
    }
    else {
        $qDelete = mysqli_query(
            $link,
            "DELETE FROM comentarii WHERE id = '{$_GET['comentariu']}';"
        );
        $id_postare = $comentariu['id_postare'];
        $qUpdate = mysqli_query(
            $link,
            "UPDATE postari SET nr_comentarii = nr_comentarii - 1, timp = timp WHERE id = {$id_postare}"
        );
        header('location: ../');
        die();
    }

?>
<?php
    session_start();
    date_default_timezone_set("Europe/Bucharest");
    
    $link = mysqli_connect('localhost', 'root', '', 'lucrare_atestat_Muresan_Mihai_XII_B');

    if(!isset($_GET['comentariu']) || !isset($_SESSION['user']['id'])) {
        header('location: ../');
        die();
    }
    else {
        $id_user = $_SESSION['user']['id'];
        $id_comentariu = $_GET['comentariu'];
        $qAprecieriC = mysqli_query(
            $link,
            "SELECT * 
                FROM aprecieriC 
                WHERE id_user = '{$id_user}' AND id_comentariu = '{$id_comentariu}';"
        );
        $qComentariu = mysqli_query(
            $link, 
            "SELECT 
                id, nr_aprecieri FROM comentarii WHERE id = '{$id_comentariu}';"
        );
        $AC = mysqli_fetch_assoc($qAprecieriC);
        $C = mysqli_fetch_assoc($qComentariu);
        if($AC != NULL) {
            mysqli_query(
                $link,
                "DELETE FROM aprecieriC WHERE id_user = '{$id_user}' AND id_comentariu = '{$id_comentariu}';"
            );
            mysqli_query(
                $link,
                "UPDATE comentarii SET timp = timp, nr_aprecieri = nr_aprecieri - 1 WHERE id = '{$id_comentariu}';"
            );
            header('location: ../');
            die();
        }
        else {
            mysqli_query(
                $link,
                "INSERT INTO aprecieriC (id_user, id_comentariu) VALUES ('{$id_user}', '{$id_comentariu}');"
            );
            mysqli_query(
                $link,
                "UPDATE comentarii SET timp = timp, nr_aprecieri = nr_aprecieri + 1 WHERE id = '{$id_comentariu}';"
            );
            header('location: ../');
            die();
        }
    }
?>
<?php
    session_start();
    date_default_timezone_set("Europe/Bucharest");
    
    $link = mysqli_connect('localhost', 'root', '', 'lucrare_atestat_Muresan_Mihai_XII_B');

    if(!isset($_GET['postare']) || !isset($_SESSION['user']['id'])) {
        header('location: ../');
        die();
    }
    else {
        $id_user = $_SESSION['user']['id'];
        $id_postare = $_GET['postare'];
        $qAprecieri = mysqli_query(
            $link,
            "SELECT * 
                FROM aprecieri 
                WHERE id_user = '{$id_user}' AND id_postare = '{$id_postare}';"
        );
        $qPostari = mysqli_query(
            $link, 
            "SELECT 
                id, nr_aprecieri FROM postari WHERE id = '{$id_postare}';"
        );
        $A = mysqli_fetch_assoc($qAprecieri);
        $P = mysqli_fetch_assoc($qPostari);
        if($A != NULL) {
            mysqli_query(
                $link,
                "DELETE FROM aprecieri WHERE id_user = '{$id_user}' AND id_postare = '{$id_postare}';"
            );
            mysqli_query(
                $link,
                "UPDATE postari SET timp = timp, nr_aprecieri = nr_aprecieri - 1 WHERE id = '{$id_postare}';"
            );
            header('location: ../');
            die();
        }
        else {
            mysqli_query(
                $link,
                "INSERT INTO aprecieri (id_user, id_postare) VALUES ('{$id_user}', '{$id_postare}');"
            );
            mysqli_query(
                $link,
                "UPDATE postari SET timp = timp, nr_aprecieri = nr_aprecieri + 1 WHERE id = '{$id_postare}';"
            );
            header('location: ../');
            die();
        }
    }
?>
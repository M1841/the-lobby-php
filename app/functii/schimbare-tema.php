<?php
    if(isset($_GET['night'])) {
        if($_GET['night'] == 'on') {
            $_SESSION['c1'] = 'dark';
            $_SESSION['c2'] = 'secondary';
        }
        if($_GET['night'] == 'off') {
            $_SESSION['c1'] = 'light';
            $_SESSION['c2'] = 'dark';
        }
        header('location: ./');
        die();
    }

    if(!isset($_SESSION['c1']) || !isset($_SESSION['c2'])) {
        $_SESSION['c1'] = 'light';
        $_SESSION['c2'] = 'dark';
    }

    $c1 = $_SESSION['c1'];
    $c2 = $_SESSION['c2'];
?>
<?php
    require_once("functii/diverse.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap">  

    <!-- CSS -->
    <link rel="stylesheet" href="externe/bootstrap.min.css">
    <link rel="stylesheet" href="externe/bootstrap-icons.css">

    <title>The Lobby</title>
</head>
<body class="px-4 py-3 mx-auto" style="background-color: #151515; font-family: 'Open Sans', sans-serif; overflow-wrap: break-word; max-width: 900px;">

    <?php
        require_once('componente/antet-complet.php');
        require_once('componente/postari.php');
        require_once('componente/subsol.php');
    ?>
    
    <!-- JS -->
    <script src="externe/bootstrap.bundle.min.js"></script>
    <script src="externe/jquery.js"></script>

</body>
</html>
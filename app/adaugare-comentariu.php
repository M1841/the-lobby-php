<?php
    require_once("functii/diverse.php");

    if(!isset($_SESSION['user'])) {
        header('location: ./autentificare.php?operatie=login');
        die();
    }

    if(isset($_POST['continut'])) {
        $id_postare = $_GET['postare'];
        $continut = htmlspecialchars($_POST['continut']);
        $id_user = $_SESSION['user']['id'];
        $qInsert = mysqli_query(
            $link,
            "INSERT INTO comentarii (id_postare, continut, id_user, timp)
            VALUES ('{$id_postare}', '{$continut}', '{$id_user}', NOW())"
        );
        $qUpdate = mysqli_query(
            $link,
            "UPDATE postari SET nr_comentarii = nr_comentarii + 1, timp = timp WHERE id = '{$id_postare}'"
        );
        header('location: ./');
        die();
    }
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
        require_once('componente/antet-simplu.php');
    ?>

    <!-- formular -->
    <div class="container-fluid bg-<?=$c1?> rounded px-3 py-3 w-100 mb-3">
        <h3 class="text-<?=$c2?> px-2">
            <i class="bi bi-plus-lg"></i>
            Add a comment
        </h3>
        <hr class="m-2 mt-3 text-<?=$c2?>">
        <form method="post" class="px-2">
            <div class="form-floating mb-2">
                <textarea name="continut" id="continut" required class="form-control border-0 me-0 text-<?=$c2?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>; min-height: 20vh;"></textarea>
                <label for="continut" class="text-<?=$c2?> pt-3">Content</label>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-<?=$c1?> border-0 py-3 text-success form-control" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                    <i class="bi bi-check2-square"></i>
                    Save
                </button>
            </div>
        </form>
    </div>

    <?php
        require_once('componente/subsol.php');
    ?>

    <!-- JS -->
    <script src="externe/bootstrap.bundle.min.js"></script>
    <script src="externe/jquery.js"></script>
</body>
</html>
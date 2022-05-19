<?php
    require_once("functii/diverse.php");
    
    if(!isset($_SESSION['user'])) {
        header('location: ./autentificare.php?operatie=login');
        die();
    }

    $qPostare = mysqli_query(
        $link,
        "SELECT titlu, continut, id_user, timp FROM postari
        WHERE id = {$_GET['postare']}"
    );
    $postare = mysqli_fetch_assoc($qPostare);

    if($postare['id_user'] != $_SESSION['user']['id']) {
        header('location: ./');
        die();
    }
    else {
        if(isset($_POST['titlu']) && isset($_POST['continut'])) {
            var_dump($_POST);
            $titlu = htmlspecialchars($_POST['titlu']);
            $continut = htmlspecialchars($_POST['continut']);
            $timp = $postare['timp'];
            $qInsert = mysqli_query(
                $link,
                "UPDATE postari SET titlu = '{$titlu}', continut = '{$continut}', editata = '1', timp = '{$timp}' WHERE id = '{$_GET['postare']}'"
            );
            header('location: ./');
            die();
        }
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

    <title>Edit a post</title>
</head>

<body class="px-4 py-3 mx-auto" style="background-color: #151515; font-family: 'Open Sans', sans-serif;  overflow-wrap: break-word; max-width: 900px;">

    <?php
        require_once('componente/antet-simplu.php');
    ?>
    <!-- modal stergere -->
    <div class="modal fade" id="modal-stergere">
        <div class="modal-dialog">    
            <div class="modal-content rounded-pill">
                <div class="container-fluid bg-<?=$c1?> rounded px-3 py-3 w-100">
                    <h3 class="text-<?=$c2?> px-2">Confirum</h3>
                    <hr class="mx-2 my-3 text-<?=$c2?>">
                    <p class="text-<?=$c2?> px-2">Are you sure you want to delete this post?</p>
                    <hr class="mx-2 my-3 text-<?=$c2?>">
                    <div class="d-flex justify-content-between mx-2">
                        <a type="button" class="btn btn-<?=$c2?> border-0 rounded-0 rounded-start w-50 py-2 me-1 text-<?=$c2?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>" href="functii/stergere-postare.php?postare=<?=$_GET['postare']?>">
                            <i class="bi bi-trash"></i>
                            Yes
                        </a>
                        <button type="button" class="btn btn-<?=$c1?> border-0 rounded-0 rounded-end w-50 py-2 text-<?=$c2?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- formular -->
    <div class="container-fluid bg-<?=$c1?> rounded px-3 py-3 w-100 mb-3">
        <h3 class="text-<?=$c2?> px-2">
            <i class="bi bi-pencil-square"></i>
            Edit a post
        </h3>
        <hr class="m-2 mt-3 text-<?=$c2?>">
        <form method="post" class="px-2">
            <div class="form-floating mb-1 pt-2">
                <input type="text" name="titlu" id="titlu" required class="form-control border-dark border-0 rounded-0 rounded-top me-0 text-<?=$c2?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>" value="<?=$postare['titlu']?>">
                <label for="username" class="text-<?=$c2?> pt-4">Title</label>
            </div>
            
            <div class="form-floating mb-2">
                <textarea name="continut" id="continut" required class="form-control border-dark border-0 rounded-0 rounded-bottom me-0 text-<?=$c2?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>; min-height: 20vh;"><?=$postare['continut']?></textarea>
                <label for="continut" class="text-<?=$c2?> pt-3">Content</label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-stergere"
                class="btn border-0 rounded-0 rounded-start py-3 text-danger form-control me-1" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                    <i class="bi bi-trash"></i>
                    Delete this post
                </button>
                <button type="submit" class="btn border-0 rounded-0 rounded-end py-3 text-success form-control" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                    <i class="bi bi-check2-square"></i>
                    Save
                </button>
            </div>
            <div class="d-flex">
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
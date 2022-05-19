<?php
    require_once("functii/diverse.php");

    $eroare = '';
    if(!isset($_GET['operatie']) || ($_GET['operatie'] != 'login' && $_GET['operatie'] != 'signup')) {
        $_GET['operatie'] = 'login';
    }
    switch($_GET['operatie']) {
        case 'login': {
            $titlu = "Sign in";
            break;
        }
        case 'signup': {
            $titlu = "Sign up";
            break;
        }
    }
    $username = '';
    $parola = '';
    if(isset($_POST['username']) && isset($_POST['parola'])) {

        $username = $_POST['username'];
        $parola = $_POST['parola'];
        $q = mysqli_query($link, "SELECT * FROM utilizatori WHERE nume = '{$username}'");
        // var_dump($username); 
        // var_dump($parola); 
        $u = mysqli_fetch_assoc($q);
        /* var_dump($u); */

        switch($_GET['operatie']) {
            case 'login': {
                $titlu = "Sign in";
                if($u == NULL) {
                    $eroare = '<div class="px-2 mt-3 text-danger text-center">User does not exist!</div>';
                } 
                else {
                    if(password_verify($parola, $u['parola'])) {
                    $_SESSION['user'] = [
                        'id' => $u['id'],
                        'nume' => $u['nume']
                    ];
                    header('location: ./');
                    die();
                    }
                    else {
                        $eroare = '<div class="px-2 mt-3 text-danger text-center">Wrong password!</div>';
                    }
                }
                break;
            }
            case 'signup': {
                $titlu = "Creare cont";
                if($u) {
                    $eroare = '<div class="px-2 mt-3 text-danger text-center">Username is taken!</div>';
                }
                else {
                    $p = password_hash($parola, PASSWORD_DEFAULT);
                    $q = mysqli_query($link, "INSERT INTO utilizatori (nume, parola) VALUES ('{$username}', '{$p}')");
                    $qId = mysqli_query($link, "SELECT id FROM utilizatori WHERE nume = '{$username}'");
                    $id = mysqli_fetch_assoc($qId)['id'];
                    $_SESSION['user'] = [
                        'id' => $id,
                        'nume' => $username
                    ];
                    header('location: ./');
                    die();
                }
                break;
            }
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

    <title>The Lobby</title>
</head>

<body class="px-4 py-3 mx-auto" style="background-color: #151515; font-family: 'Open Sans', sans-serif; overflow-wrap: break-word; max-width: 900px;">

    <?php
        require_once('componente/antet-simplu.php');
    ?>
    
    <!-- formular -->
    <div class="container-fluid bg-<?=$c1?> rounded px-3 py-3 w-100 mb-3">
        <h3 class="text-<?=$c2?> px-2"><?=$titlu?></h3>
        <hr class="m-2 mt-3 text-<?=$c2?>">
        <form method="post" class="px-2">
            <div class="form-floating mb-1">
                <input value="<?=$username?>" type="text" name="username" id="username" required class="form-control border-0 rounded-0 rounded-top me-0 text-<?=($c1 == 'dark' ? 'secondary' : 'dark')?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                <label for="username" class="text-<?=$c2?>">Username</label>
            </div>
            <div class="form-floating mb-2 d-flex">
                <input value="<?=$parola?>" type="password" name="parola" id="parola" required class="form-control border-0 rounded-0 me-0 text-<?=($c1 == 'dark' ? 'secondary' : 'dark')?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>; width: 90%">
                <label for="parola" class="text-<?=$c2?>">Password</label>
                <button type="button" onclick="afisareParola(this)" class="btn btn-<?=$c1?> text-<?=$c2?> border-0 rounded-0 d-flex" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>; width: 10%">
                    <i class="bi bi-eye-slash m-auto"></i>
                </button>
            </div>
            <div class="d-flex justify-content-center">
                <?php
                    if(isset($_GET['operatie'])) {
                        switch($_GET['operatie']) {
                            case 'login' : {
                                ?>
                                    <a href="autentificare.php?operatie=signup" class="btn btn-<?=$c1?> text-<?=$c2?> border-0 rounded-0 rounded-start d-flex me-1 w-75 py-3" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                                        <i class="bi bi-person-plus me-1"></i>
                                        Create a new account
                                    </a>
                                <?php
                                break;
                            }
                            case 'signup' : {
                                ?>
                                    <a href="autentificare.php?operatie=login" class="btn btn-<?=$c1?> text-<?=$c2?> border-0 rounded-0 rounded-start d-flex me-1 w-75 py-3" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                                        <i class="bi bi-person-lines-fill me-1"></i>
                                        Use an existing account
                                    </a>
                                <?php
                                break;
                            }
                        }
                    }
                    else {
                        ?>
                            <a href="autentificare.php?operatie=signup" class="btn btn-<?=$c1?> text-<?=$c2?> border-0 rounded-0 rounded-start d-flex me-1 w-75 py-3" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                                <i class="bi bi-person-plus me-1"></i>
                                Create a new account
                            </a>
                        <?php
                    }
                ?>
                <button type="submit" class="btn btn-<?=$c1?> border-0 text-success rounded-0 rounded-end d-flex w-25 py-3" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                    <i class="bi bi-check2-square me-1"></i>
                    <?=$titlu?>
                </button>
            </div>
        </form>
        <?=$eroare?>
    </div>

    <?php
        require_once('componente/subsol.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function afisareParola(e) {
            e.children[0].classList.toggle("bi-eye");
            e.children[0].classList.toggle("bi-eye-slash");
            let parola = document.getElementById("parola");
            switch(parola.type) {
                case "password": {
                    parola.type = "text";
                    break;
                }
                case "text": {
                    parola.type = "password";
                    break;
                }
            }
        }
    </script>
    
    <!-- JS -->
    <script src="externe/bootstrap.bundle.min.js"></script>
    <script src="externe/jquery.js"></script>
</body>
</html>
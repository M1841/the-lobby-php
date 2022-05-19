<?php
    require_once('componente/modal-deconectare.php');
?>
<div class="sticky-sm-top pb-1" style="background-color: #151515;">
    <div class="container-fluid bg-<?=$c1?> rounded px-3 py-2 w-100 mb-3">
        <nav class="navbar navbar-<?=$c1?> justify-content-evenly px-2">
            <a class="navbar-brand m-0 text-<?=$c2?>" href="./" unselectable="on" onselectstart="return false;" onmousedown="return false;">
                The Lobby
            </a>
            <form method="get" class="d-flex ms-5 me-4" style="width: 50%; min-width: 200px;">
                <input type="text" name="cautare" class="form-control border-0 rounded-0 rounded-start text-<?=$c2?>" required style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                <?php
                    if(isset($_GET['utilizator'])) {
                        ?>
                            <input type="hidden" name="utilizator" value="<?=$_GET['utilizator']?>">
                        <?php
                    }
                ?>
                <button type="submit" class="btn border-0 rounded-0 rounded-end text-<?=$c2?> d-flex" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            <div class="d-flex">
                <?php
                    if(!isset($_SESSION['user'])) {
                    ?>
                        <a class="navbar-item link-<?=$c2?> my-auto" href="autentificare.php?operatie=login" style="text-decoration: none" unselectable="on" onselectstart="return false;" onmousedown="return false;">
                            Sign in
                        </a>
                    <?php
                    }
                    else {
                        ?>
                            <div class="dropdown d-flex">
                                <a class="navbar-item link-<?=$c2?> dropdown-toggle my-auto" href="" data-bs-toggle="dropdown" style="text-decoration: none">
                                    <?=$_SESSION['user']['nume']?>
                                </a>
                                
                                <ul class="dropdown-menu <?=( $c1 == 'dark' ? 'dropdown-menu-dark' : '')?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#FAFAFA')?>">
                                    <li>
                                        <a class="dropdown-item text-<?=$c2?>" href="profil.php?utilizator=<?=$_SESSION['user']['nume']?>">
                                            <i class="bi bi-card-list me-1"></i>
                                            My posts
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-<?=$c2?>" href="adaugare-postare.php">
                                            <i class="bi bi-plus-lg me-1"></i>
                                            Add a post
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-<?=$c2?>" href="" data-bs-toggle="modal" data-bs-target="#modal-deconectare">
                                            <i class="bi bi-door-open me-1"></i>
                                            Sign out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php
                    }
                ?>

                <a 
                </
                    href="./?night=<?=($c1 == 'light'?'on':'off')?>" 
                    class="link-<?=$c2?> ms-4 fs-3">
                    <i class="bi bi-<?=($c1 == 'dark' ? 'sun' : 'moon')?>"></i>
                </a>
            </div>
        </nav>
    </div>
</div>
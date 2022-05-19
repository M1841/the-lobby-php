<?php
    require_once('componente/modal-deconectare.php');
?>
<div class="sticky-sm-top pb-1" style="background-color: #151515;">
    <div class="container-fluid bg-<?=$c1?> rounded px-3 py-2 w-100 mb-3">
        <nav class="navbar navbar-<?=$c1?> justify-content-evenly d-flex">
            <a class="navbar-brand me-5 text-<?=$c2?>" href="./" unselectable="on" onselectstart="return false;" onmousedown="return false;">
                The Lobby
            </a>
            <?php
                    if(!isset($_SESSION['user'])) {
                    ?>
                        <a class="navbar-item link-<?=$c2?>" href="autentificare.php?operatie=login" style="text-decoration: none" unselectable="on" onselectstart="return false;" onmousedown="return false;">
                            Sign in
                        </a>
                    <?php
                    }
                    else {
                        ?>
                            <div class="dropdown">
                                <a class="navbar-item link-<?=$c2?> dropdown-toggle" href="" data-bs-toggle="dropdown" style="text-decoration: none">
                                    <?=$_SESSION['user']['nume']?>
                                </a>
                                
                                <ul class="dropdown-menu <?=( $c1 == 'dark' ? 'dropdown-menu-dark' : '')?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#FAFAFA')?>">
                                    <li>
                                        <a class="dropdown-item text-<?=$c2?>" href="profil.php?utilizator=<?=$_SESSION['user']['nume']?>">
                                            <i class="bi bi-card-list"></i>
                                            My posts
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-<?=$c2?>" href="adaugare-postare.php">
                                            <i class="bi bi-plus-lg"></i>
                                            Add a post
                                        </a>
                                    </li>
                                    <!--
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-<?=$c2?>" href="setari.php">
                                            <i class="bi bi-gear"></i>
                                            Settings
                                        </a>
                                    </li>
                                    -->
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-<?=$c2?>" href="" data-bs-toggle="modal" data-bs-target="#modal-deconectare">
                                            <i class="bi bi-door-open"></i>
                                            Sign out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php
                    }
                ?>
        </nav>
    </div>
</div>
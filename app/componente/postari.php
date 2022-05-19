<?php
    require_once("functii/diverse.php");

    // extragerea tuturor utilizatorilor in baza de date
    $qUtilizatori = mysqli_query(
        $link,
        "SELECT id, nume FROM utilizatori ORDER BY id"
    );
    $utilizatori = [];
    while($aux = mysqli_fetch_assoc($qUtilizatori)) {
        $utilizatori[$aux['id']] = $aux;
    }

    // extragerea postarilor din baza de date in functie de cautare
    if(!isset($_GET['cautare'])) {
        $qPostari = mysqli_query(
            $link, 
            "SELECT 
                id, titlu, continut, id_user, editata, UNIX_TIMESTAMP(timp) as timpUnix, nr_aprecieri, nr_comentarii
            FROM postari ORDER BY timpUnix DESC"
        );
    }
    else {
        $cautare = trim($_GET['cautare']);
        $qPostari = mysqli_query(
            $link, 
            "SELECT 
                id, titlu, continut, id_user, editata, UNIX_TIMESTAMP(timp) as timpUnix, nr_aprecieri, nr_comentarii
            FROM postari  WHERE 
                titlu LIKE '%{$cautare}%' OR
                continut LIKE '%{$cautare}%'
            ORDER BY timpUnix DESC"
        );
    }
    $postari = [];
    while($aux = mysqli_fetch_assoc($qPostari)) {
        $postari[] = $aux;
    }

    // extragerea comentariilor
    $qComentarii = mysqli_query(
        $link,
        "SELECT
            id, id_postare, id_user, continut, editat, nr_aprecieri, UNIX_TIMESTAMP(timp) as timpUnix
            FROM comentarii
            ORDER BY timpUnix"
    );
    $comentarii = [];
    while($aux = mysqli_fetch_assoc($qComentarii)) {
        $comentarii[] = $aux;
    }

    // extragerea aprecierilor
    if(isset($_SESSION['user']['id'])) {
        $qAprecieri = mysqli_query(
            $link,
            "SELECT * 
                FROM aprecieri 
                WHERE id_user = {$_SESSION['user']['id']}
                ORDER BY id_postare"
        );
        $aprecieri = [];
        // daca utilizatorul a apreciat o postare, campul cu indicele egal cu id-ul ei va avea valoarea 1
        while($aux = mysqli_fetch_assoc($qAprecieri)) {
            $aprecieri[$aux['id_postare']] = 1;
        }

        $qAprecieriC = mysqli_query(
            $link,
            "SELECT * 
                FROM aprecieriC 
                WHERE id_user = {$_SESSION['user']['id']}
                ORDER BY id_comentariu"
        );
        $aprecieriC = [];
        // daca utilizatorul a apreciat un comentariu, campul cu indicele egal cu id-ul lui va avea valoarea 1
        while($aux = mysqli_fetch_assoc($qAprecieriC)) {
            $aprecieriC[$aux['id_comentariu']] = 1;
        }
    }
 
    // cautare
    if(isset($_GET['cautare'])) {
        $cautare = trim($_GET['cautare']);
        ?>
            <div class="container-fluid bg-<?=$c1?> text-<?=$c2?> rounded px-3 py-3 w-100 mb-3" style="cursor: default;">
                <div class="px-2 d-flex justify-content-between">
                    <p class="m-0 my-auto">
                        Showing search results for <strong><?=$cautare?></strong>
                    </p>
                    <a href="./" class="btn btn-outline text-<?=$c2?> p-0 my-auto" style="text-decoration: none;" title="Cancel search">
                        <i class="bi bi-backspace fs-4"></i>
                    </a>
                </div>
            </div>
        <?php
    }

    // afisarea postarilor
    foreach($postari as $P) {
        ?>
            <!-- postare -->
            <div class="container-fluid bg-<?=$c1?> rounded px-3 py-3 w-100 mb-3">
                <div>
                    <!-- header postare -->
                    <div class="px-2">
                        <small class="text-muted fs-7" unselectable="on" onselectstart="return false;" onmousedown="return false;" style="cursor: default;">
                            <?php
                                if(!isset($utilizatori[$P['id_user']]['nume']))
                                {
                                    ?>
                                        <span class="text-secondary">
                                            [deleted user]
                                        </span>
                                    <?php
                                }
                                else {
                                    ?>
                                        <a href="profil.php?utilizator=<?=$utilizatori[$P['id_user']]['nume']?>" class="link-secondary" style="text-decoration: none;">
                                            <?=$utilizatori[$P['id_user']]['nume']?>
                                        </a>
                                    <?php
                                }
                                ?>
                            -
                            <?=afisareTimp($P['timpUnix'])?>
                            <?=
                            ($P['editata'] == 1 ?
                                '<em>- edited</em>' :
                                ''
                            )
                            ?>
                        </small>
                        <h3>
                            <span class="text-<?=$c2?>" style="cursor: default;">
                                <?=$P['titlu']?>
                            </span>
                        </h3>
                    </div>
                    <hr class="m-2 text-<?=$c2?>">
                    <!-- continut postare -->
                    <div class="px-2 text-<?=$c2?>" style="cursor: default;">
                        <?=$P['continut']?>
                    </div>
                    <hr class="m-2 text-<?=$c2?>">
                    <!-- operatii postare -->
                    <div class="px-2" unselectable="on" onselectstart="return false;" onmousedown="return false;" style="cursor: default;">
                        <a class="link-<?=$c2?> me-2 bi bi-heart<?=(isset($aprecieri[$P['id']]) ? '-fill text-danger' : '')?>" style="text-decoration: none; cursor: pointer;" 
                                <?php
                                    if(isset($_SESSION['user'])) {
                                        ?>
                                        onclick="apreciere(this, <?=$P['id']?>)"
                                        <?php
                                        /*
                                        ?>href="functii/apreciere.php?postare=<?=$P['id']?>"<?php
                                        */
                                    }
                                    else {
                                        ?>href="autentificare.php?operatie=login"<?php
                                    }
                                ?>>
                            <input type="hidden" value="<?=(isset($aprecieri[$P['id']]) ? 'on' : 'off')?>">
                            <span class="text-muted me-1">
                                <?=$P['nr_aprecieri']?>
                            </span>
                        </a>
                        <div class="vr text-<?=$c2?>"></div>
                        <a class="link-<?=$c2?> mx-2" data-bs-toggle="collapse" href="#comentarii-<?=$P['id']?>" role="button" style="text-decoration: none" 
                                <?php
                                    if(isset($_SESSION['user'])) {
                                        ?><?php
                                    }
                                    else {
                                        ?>href="autentificare.php?operatie=login"<?php
                                    }
                                ?>>
                            <i class="bi bi-chat me-1"></i>
                            <span class="text-muted me-1">
                                <?=$P['nr_comentarii']?>
                            </span>
                        </a>
                        
                        <?php
                                if(isset($utilizatori[$P['id_user']]) && (isset($_SESSION['user']['nume']) && $_SESSION['user']['nume'] == $utilizatori[$P['id_user']]['nume'])) {
                                    ?>
                                    <div class="vr text-<?=$c2?>"></div>
                                    <a href="editare-postare.php?postare=<?=$P['id']?>" class="link-<?=$c2?> mx-2 bi bi-pencil-square" style="text-decoration: none">
                                    </a>
                                    
                                    <?php
                                }
                            ?>
                    </div>
                    <!-- comentarii postare -->
                    <div class="collapse" id="comentarii-<?=$P['id']?>">
                        <hr class="m-2 text-<?=$c2?>">
                        <div class="px-2 text-<?=$c2?>">
                            <h5>
                            <i class="bi bi-chat me-2"></i>Comments:</h5>
                            <a href="adaugare-comentariu.php?postare=<?=$P['id']?>" class="btn border-0 text-<?=$c2?> form-control py-3 mt-2" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                                <i class="bi bi-plus-lg"></i>
                                Add a comment
                            </a>
                            <?php
                                foreach($comentarii as $C) {
                                    if($C['id_postare'] == $P['id']) {
                                    ?>
                                        <div class="rounded px-3 py-3 w-100 mt-3 d-flex" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>">
                                            <!-- header comentariu -->
                                            <div class="d-block" style="width: 90%;">
                                                <div class="px-2">
                                                    <small class="text-muted fs-7" unselectable="on" onselectstart="return false;" onmousedown="return false;" style="cursor: default;">
                                                        <?php
                                                            if(!isset($utilizatori[$C['id_user']]['nume']))
                                                            {
                                                                ?>
                                                                    <span class="text-secondary">
                                                                        [deleted user]
                                                                    </span>
                                                                <?php
                                                            }
                                                            else {
                                                                ?>
                                                                    <a href="profil.php?utilizator=<?=$utilizatori[$C['id_user']]['nume']?>" class="link-secondary" style="text-decoration: none;">
                                                                        <?=$utilizatori[$C['id_user']]['nume']?>
                                                                    </a>
                                                                <?php
                                                            }
                                                            ?>
                                                        -
                                                        <?=afisareTimp($C['timpUnix'])?>
                                                        <?=
                                                        ($C['editat'] == 1 ?
                                                            '<em>- edited</em>' :
                                                            ''
                                                        )
                                                        ?>
                                                    </small>
                                                </div>
                                                <hr class="m-2 text-<?=$c2?>">
                                                <div class="px-2"><?=$C['continut']?></div>
                                            </div>
                                            <div class="m-auto ps-3 d-block" unselectable="on" onselectstart="return false;" onmousedown="return false;" style="cursor: default;">
                                                <a class="link-<?=$c2?> bi bi-heart<?=(isset($aprecieriC[$C['id']]) ? '-fill text-danger' : '')?>" style="text-decoration: none; cursor: pointer;" 
                                                    <?php
                                                        if(isset($_SESSION['user'])) {
                                                            ?>
                                                            onclick="apreciereC(this, <?=$C['id']?>)"
                                                            <?php
                                                            /*
                                                            ?>href="functii/apreciereC.php?comentariu=<?=$C['id']?>"<?php
                                                            */
                                                        }
                                                        else {
                                                            ?>href="autentificare.php?operatie=login"<?php
                                                        }
                                                    ?>>
                                                    <input type="hidden" value="<?=(isset($aprecieriC[$C['id']]) ? 'on' : 'off')?>">
                                                    <span class="text-muted me-1">
                                                        <?=$C['nr_aprecieri']?>
                                                    </span>
                                                </a>
                                                <?php
                                                    if(isset($utilizatori[$C['id_user']]) && (isset($_SESSION['user']['nume']) && $_SESSION['user']['nume'] == $utilizatori[$C['id_user']]['nume'])) {
                                                        ?>
                                                        <a href="editare-comentariu.php?comentariu=<?=$C['id']?>" class="link-<?=$c2?> mx-2 bi bi-pencil-square" style="text-decoration: none">
                                                        </a>
                                                        
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
?>
<script>
    function apreciere(e, id) {
        switch(e.children[0].value) {
            case 'off': {
                e.children[1].innerText = parseInt(e.children[1].innerText) + 1;
                e.children[0].value = 'on';
                break;
            }
            case 'on': {
                e.children[1].innerText = parseInt(e.children[1].innerText) - 1;
                e.children[0].value = 'off';
                break;
            }
        }
        e.classList.toggle("text-danger");
        e.classList.toggle("bi-heart");
        e.classList.toggle("bi-heart-fill");
        $.ajax({url: "functii/apreciere.php?postare=" + id});
    }
    function apreciereC(e, id) {
        switch(e.children[0].value) {
            case 'off': {
                e.children[1].innerText = parseInt(e.children[1].innerText) + 1;
                e.children[0].value = 'on';
                break;
            }
            case 'on': {
                e.children[1].innerText = parseInt(e.children[1].innerText) - 1;
                e.children[0].value = 'off';
                break;
            }
        }
        e.classList.toggle("text-danger");
        e.classList.toggle("bi-heart");
        e.classList.toggle("bi-heart-fill");
        $.ajax({url: "functii/apreciereC.php?comentariu=" + id});
    }
</script>
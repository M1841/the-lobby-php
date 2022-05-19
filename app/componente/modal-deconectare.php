<?php

    if(isset($_GET['operatie']) && $_GET['operatie'] === 'deconectare') {
        unset($_SESSION['user']);
        header('location: ./');
        die();
    }
    
?>

<div class="modal fade" id="modal-deconectare">
    <div class="modal-dialog">    
        <div class="modal-content rounded-pill">
            <div class="container-fluid bg-<?=$c1?> rounded px-3 py-3 w-100">
                <h3 class="text-<?=$c2?> px-2">Confirm</h3>
                <hr class="mx-2 my-3 text-<?=$c2?>">
                <p class="text-<?=$c2?> px-2">Are you sure you want to sign out?</p>
                <hr class="mx-2 my-3 text-<?=$c2?>">
                <div class="d-flex justify-content-between mx-2">
                    <a type="button" class="btn btn-<?=$c2?> border-0 rounded-0 rounded-start w-50 py-2 me-1 text-<?=$c2?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>" href="./?operatie=deconectare">
                        <i class="bi bi-door-open"></i>
                        Yes
                    </a>
                    <button type="button" class="btn btn-<?=$c1?> border-0 rounded-0 rounded-end w-50 py-2 text-<?=$c2?>" style="background-color: <?=($c1 == 'dark' ? '#151515' : '#E9E9E9')?>" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
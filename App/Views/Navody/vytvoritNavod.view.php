<?php
$navodid = $data["navodid"];
$nazovnavodu = $data['nazovnavodu'];
$navodulozeny = $data['navodulozeny'];

$krokynavodu = $data['krokynavodu'];
$chybaNeprialSa = $data['chybaNeprialSa'];
?>


<form class="mt-5 mb-3" method="post" action="?c=navody&a=upravNavod&navodid=<?=$navodid?>">

    <h4 class="mb-3 mt-3">Nadpis návodu:</h4>
    <div class="form-group">

        <input class="form-control" name="nazov" id="nazovnavodu" value="<?= $nazovnavodu ?>" required>

    </div>

    <?php if($navodulozeny != "") { ?>
            <div id="navodulozeny">
    <div class="alert alert-success mt-2 mb-2" role="alert">
        Nadpis návodu je uložený
    </div>
            </div>
    <?php } ?>


    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-3 text-center btn-lg" >Uložiť</button>
    </div>
</form>



<?php if($navodid != "") { ?>

<div id="krokyNavodu">

    <?php foreach($krokynavodu as $krok) {?>
        <div class="container mb-3">
            <div id="normal,<?=$krok->getId()?>" >
            <div class="row">
                    <div class="card col-sm-8" >
                        <img class="card-img-top mt-2 kroknavoduimg" src="public/obrazky/navody/<?= $krok->getObrazok()?>" alt="obrazok kroku">
                        <div class="card-body ">

                        </div>
                    </div>
                    <div class="card col-sm-4" >

                        <div class="card-body">

                            <h3 class="card-title"><?= $krok->getNazov()?></h3>
                            <p class="obsahotazky">
                                <?= nl2br($krok->getObsah())?>
                            </p>
                            <button onclick="upravKrok(<?=$krok->getId()?>)" class="mt-2 btn btn-secondary">Upraviť</button>

                            <form class="zmazKrok mt-2" method="post" action="?c=navody&a=vymazKrok"  >
                                <input type="hidden" name="idZmaz" value="<?=$krok->getId()?>">
                                <button type="submit" class="btn btn-danger">Vymazať</button>
                            </form>


                        </div>
                    </div>

            </div>
            </div>
            <div id="uprava,<?=$krok->getId()?>" style="display: none">
                <!--Uprava -->
                <form class="" method="post" enctype="multipart/form-data" action="?c=navody&a=upravKrok&krokid=<?=$krok->getId()?>">
                    <div class="row">

                        <div class="card col-sm-8" >
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Fotka ku kroku návodu</label>
                                    <input type="file" name="fotka" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card col-sm-4" >
                            <div class="card-body">
                                <div class="form-group">
                                    <label><h3>Nadpis kroku:</h3></label>
                                    <input class="form-control form-control-lg" name="nazov" value="<?= $krok->getNazov() ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Obsah: </label>
                                    <textarea class="form-control" rows="5" name="obsah"><?= $krok->getObsah() ?></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row card">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3 mb-3 text-center" >Upraviť krok</button>

                        </div>
                    </div>
                </form>
                <button onclick="zrusUpravovanieKroku(<?=$krok->getId()?>)" class="mt-3 btn btn-secondary">Zrušiť úpravu</button>





            </div>
        </div>
    <?php } ?>
</div>

<!--Vytvorenie noveho -->
<div>
    <div class="container mt-4 mb-4">

        <form class="" method="post" enctype="multipart/form-data" action="?c=navody&a=pridajkrok&navodid=<?=$navodid?>">
            <div class="row">

                    <div class="card col-sm-8" >
                        <div class="card-body">
                            <div class="form-group">
                                <label>Fotka ku kroku návodu</label>
                                <input type="file" name="fotka" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="card col-sm-4" >
                        <div class="card-body">
                            <div class="form-group">
                                <label><h3>Nadpis kroku:</h3></label>
                                <input class="form-control form-control-lg" name="nazov" required>
                            </div>
                            <div class="form-group">
                                <label>Obsah: </label>
                                <textarea class="form-control" rows="5" name="obsah"></textarea>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="row card">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3 mb-3 text-center" >Pridať krok</button>
                </div>
            </div>
        </form>


    </div>
    <?php if($chybaNeprialSa != "") { ?>
        <div class="alert alert-danger pb-2" role="alert">
            Krok sa nepridal! <br>
            <?=$chybaNeprialSa ?>
        </div>
    <?php } ?>

</div>

<?php } ?>

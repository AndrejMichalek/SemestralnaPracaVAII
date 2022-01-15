<?php
$navod = $data["navod"];
$krokyNavodu = $data["krokyNavodu"];

?>

<div class="container my-4 pb-2 ">

    <div class="card" >
        <div class="card-body nadpisNavod">
            <h2 class="card-title nadpisNavodText"><?= $navod->getNazov()?></h2>
            <p class="nadpisNavodText">Aktualizované: <?= $navod->getDatumUpravy()?></p>


        </div>
    </div>
</div>


<?php foreach($krokyNavodu as $krok) {?>
<div class="container mb-3">

    <div class="row">
        <div class="card col-sm-8" >
            <img class="card-img-top mt-2" src="public/obrazky/navody/<?= $krok->getObrazok()?>" alt="obrazok kroku">
            <div class="card-body ">

            </div>
        </div>
        <div class="card col-sm-4" >

            <div class="card-body">
                <h3 class="card-title"><?= $krok->getNazov()?></h3>

                <p class="obsahotazky">
                    <?= $krok->getObsah()?>
                </p>


            </div>
        </div>
    </div>
</div>
<?php } ?>




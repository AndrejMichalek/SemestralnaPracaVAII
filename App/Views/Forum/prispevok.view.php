<div class="mt-3 pt-3">

</div>
<?php
$prispevok = $data["prispevok"][0];
$komentare = $data["komentare"];
$pouzivatelia = $data['pouzivatelia'];

$komentarUpravID = $data["komentarUpravID"];
$problemZmenaKomentara = $data["problemZmenaKomentara"];


?>



<?php
if($problemZmenaKomentara != "") {
    ?>
    <div class="alert alert-warning">
        <strong>Pozor!</strong> <?=$problemZmenaKomentara ?>
    </div>
    <?php
}
?>


<div class="container mb-3">
    <div class="row">
        <div class="card col-sm-3" >
            <img class="card-img-top profilovka mt-2 " src="public/obrazky/profilovka.jpg" alt="Card image">
            <div class="card-body ">
                <h4 class="card-title">Jožko Mrkvička</h4>
                <p>Príspevkov: 4</p>


            </div>
        </div>
        <div class="card col-sm-9" >

            <div class="card-body">
                <h2 class="card-title"><?= $prispevok->getNazov();?></h2>
                <p><?= $prispevok->getDatum() ?><p>
                <p class="obsahotazky">
                    <?= $prispevok->getObsah();?>
                </p>


            </div>
        </div>
    </div>
</div>


<?php if(sizeof($komentare) > 0) {
for($i= 0; $i < sizeof($komentare); $i++) {
?>

    <div class="container mb-3">
        <div class="row">
            <div class="card col-sm-3" >
                <img class="card-img-top profilovka mt-2" src="public/obrazky/profilovka.jpg" alt="Card image">
                <div class="card-body ">
                    <h4 class="card-title"><?=$pouzivatelia[$i]->getMeno()." ".$pouzivatelia[$i]->getPriezvisko()?></h4>
                    <p>Príspevkov: 10</p>


                </div>
            </div>
            <div class="card col-sm-9" >

                <div class="card-body">

                    <h4 class="card-title">Re: <?=$prispevok->getNazov()?></h4>
                    <p><?= $prispevok->getDatum() ?><p>

                    <?php if($komentarUpravID == $komentare[$i]->getId()) { ?>

                    <form class="mt-5 mb-5" method="post" action="?c=forum&a=ulozZmenyVTomtoKomente">
                        <h4 class="mb-3 mt-3">Úprava:</h4>
                        <textarea class="form-control" rows="5" name="novyObsah"><?= $komentare[$i]->getObsah()?></textarea>

                        <input type="hidden" name="komentarID" value="<?=$komentare[$i]->getId()?>">
                        <input type="hidden" name="prispevokID" value="<?=$prispevok->getId()?>">

                        <button type="submit" class="btn btn-primary mt-3 text-center" >Uložiť</button>


                    </form>




                    <?php } else { ?>
                    <p class="obsahotazky">
                        <?=
                        $komentare[$i]->getObsah();
                        ?>
                    </p>
                    <?php if(\App\Prihlasenie::dajUsername() == $pouzivatelia[$i]->getUsername()) { ?>
                        <form method="post" action="?c=forum&a=zmazKomentar">
                        <input type="hidden" name="idZmaz" value="<?=$komentare[$i]->getId()?>">
                        <button type="submit" class="btn btn-danger">Vymazať</button></h4>
                        </form>

                        <form method="post" action="?c=forum&a=upravKomentar">
                            <input type="hidden" name="komentarUpravID" value="<?=$komentare[$i]->getId()?>">
                            <input type="hidden" name="komentarObsah" value="<?=$komentare[$i]->getObsah()?>">


                            <input type="hidden" name="idPrispevok" value="<?=$prispevok->getId()?>">
                            <button type="submit" class="mt-2 btn btn-secondary">Upraviť </button></h4>
                        </form>
                    <?php } } ?>

                </div>
            </div>
        </div>
    </div>

<?php
}
} ?>




<?php
if(\App\Prihlasenie::jePrihlaseny()) {
    ?>
    <div class="container mb-3">
        <div class="row">
            <div class="card" >


                <form class="mt-5 mb-5" method="post" action="?c=forum&a=pridajKomentar">
                    <h4 class="mb-3 mt-3">Nový komentár:</h4>
                    <textarea class="form-control" rows="5" name="obsah"></textarea>
                    <input type="hidden" name="idPrispevku" value="<?=$prispevok->getId()?>">

                    <button type="submit" class="btn btn-primary mt-3 text-center" >Pridať komentár</button>


                </form>


            </div>
        </div>
    </div>




<?php
} else { ?>
    <div class="alert alert-info">
        <strong>Pre pridanie komentára sa musíte prihlásiť</strong>
    </div>
<?php
}
?>






<!--
<?php/**

<div class="container mb-3">
    <div class="row">
        <div class="card col-sm-3" >
            <img class="card-img-top profilovka mt-2" src="public/obrazky/profilovka.jpg" alt="Card image">
            <div class="card-body ">
                <h4 class="card-title">Dano Mrkvička</h4>
                <p>Príspevkov: 10</p>


            </div>
        </div>
        <div class="card col-sm-9" >

            <div class="card-body">
                <h4 class="card-title">Re: Lenovo Yoga 2 13 - hlučný ventilátor</h4>
                <p>28.6.2021 12:46<p>
                <p class="obsahotazky">
                    Ahoj, <br>
                    Možno bude treba len prečistiť chladič a prepastovať CPU.
                </p>


            </div>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="row">
        <div class="card col-sm-3" >
            <img class="card-img-top profilovka mt-2" src="public/obrazky/profilovka.jpg" alt="Card image">
            <div class="card-body ">
                <h4 class="card-title">Jožko Mrkvička</h4>
                <p>Príspevkov: 4</p>


            </div>
        </div>
        <div class="card col-sm-9" >

            <div class="card-body">
                <h4 class="card-title">Re: Lenovo Yoga 2 13 - hlučný ventilátor</h4>
                <p>26.6.2021 15:46<p>
                <p class="obsahotazky">
                    Pomohlo, ďakujem!
                </p>


            </div>
        </div>
    </div>
</div>
 *
 */ ?>-->
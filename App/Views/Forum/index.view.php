<div class="pt-2 mt-4">

</div>
<?php if(\App\Prihlasenie::jePrihlaseny()) { ?>
<div class="container ">
    <a class="btn btn-lg btn-info" href="?c=forum&a=pridatPrispevok" role="button">Pridať nový príspevok</a>
</div>
<?php } else { ?>

    <div class="alert alert-info">
        <strong>Pre pridanie nového príspevku sa musíte prihlásiť</strong>
    </div>

<?php } ?>

<div class="container  mt-2">
    <div class="btn-group">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                Kategória
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item active" href="#">Všetko</a></li>
                <li><a class="dropdown-item" href="#">Smartphony</a></li>
                <li><a class="dropdown-item" href="#">Počítače</a></li>
                <li><a class="dropdown-item" href="#">Ostatné</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                Zoradiť podľa
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item active" href="#">Od najnovšieho príspevku</a></li>
                <li><a class="dropdown-item" href="#">Od najstaršieho príspevku</a></li>
            </ul>
        </div>
    </div>
</div>



<div class="container  my-4 my-4 list-group">


    <?php foreach ($data["prispevky"] as $prispevok) { ?>
        <a href="?c=forum&a=prispevok&prispevokid=<?=$prispevok->getId()?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <?php echo $prispevok->getNazov() ?>
            <span class="badge bg-primary rounded-pill"><?php echo $prispevok->getPocetKomentarov() ?></span></a>

    <?php } ?>





</div>


<div class="container">
    <ul class="pagination justify-content-end">
        <li class="page-item disabled"><a class="page-link" href="#">Predchádzajúca</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Ďalšia</a></li>
    </ul>
</div>
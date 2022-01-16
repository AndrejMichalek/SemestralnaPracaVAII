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
                <li><a class="dropdown-item <?php if($data["kategoria"]=="") { ?>active<?php }?>" href="?c=forum&strana=1&zostupne=<?=$data['zostupne']?>">Všetko</a></li>
                <li><a class="dropdown-item <?php if($data["kategoria"]=="S") { ?>active<?php }?>" href="?c=forum&strana=1&kategoria=S&zostupne=<?=$data['zostupne']?>">Smartphony</a></li>
                <li><a class="dropdown-item <?php if($data["kategoria"]=="P") { ?>active<?php }?>" href="?c=forum&strana=1&kategoria=P&zostupne=<?=$data['zostupne']?>">Počítače</a></li>
                <li><a class="dropdown-item <?php if($data["kategoria"]=="O") { ?>active<?php }?>" href="?c=forum&strana=1&kategoria=O&zostupne=<?=$data['zostupne']?>">Ostatné</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                Zoradiť podľa
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item <?php if($data["zostupne"]=="") { ?>active<?php }?>" href="?c=forum&strana=1&kategoria=<?=$data["kategoria"]."&zostupne="?>">Od najnovšieho príspevku</a></li>
                <li><a class="dropdown-item <?php if($data["zostupne"]!="") { ?>active<?php }?>" href="?c=forum&strana=1&kategoria=<?=$data["kategoria"]."&zostupne=1"?>">Od najstaršieho príspevku</a></li>
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
        <li class="page-item
        <?php if($data["strana"]==1) {?>
        disabled
        <?php } ?>
        "><a class="page-link" href="?c=forum&strana=<?=($data["strana"]-1)."&kategoria=".$data["kategoria"]?>">Predchádzajúca</a></li>

        <li class="page-item active"><a class="page-link" href="#"><?=$data["strana"]?></a></li>

        <li class="page-item
        <?php if($data["strana"] == $data["maxStran"]) { ?>
        disabled
        <?php } ?>
        "><a class="page-link" href="?c=forum&strana=<?=($data["strana"]+1)."&kategoria=".$data["kategoria"]?>">Ďalšia</a></li>
    </ul>
</div>

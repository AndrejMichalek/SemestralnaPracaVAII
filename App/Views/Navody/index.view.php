<div class="container my-4 pb-2 modry">
    <h2 class="display-2">Návody</h2>
</div>

<?php if(\App\Prihlasenie::jePrihlaseny()) { ?>
    <div class="container mt-2 mb-2 ">
        <a class="btn btn-lg btn-info" href="?c=navody&a=vytvoritNavod" role="button">Vytvoriť návod</a>
    </div>
<?php } else { ?>

    <div class="alert alert-info">
        <strong>Pre pridanie nového príspevku sa musíte prihlásiť</strong>
    </div>

<?php } ?>

<div class="container">
    <div class="btn-group">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                Kategória
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item <?php if($data["kategoria"]=="") { ?>active<?php }?>" href="?c=navody&strana=1&zostupne=<?=$data['zostupne']?>">Všetko</a></li>
                <li><a class="dropdown-item <?php if($data["kategoria"]=="S") { ?>active<?php }?>" href="?c=navody&strana=1&kategoria=S&zostupne=<?=$data['zostupne']?>">Smartphony</a></li>
                <li><a class="dropdown-item <?php if($data["kategoria"]=="P") { ?>active<?php }?>" href="?c=navody&strana=1&kategoria=P&zostupne=<?=$data['zostupne']?>">Počítače</a></li>
                <li><a class="dropdown-item <?php if($data["kategoria"]=="O") { ?>active<?php }?>" href="?c=navody&strana=1&kategoria=O&zostupne=<?=$data['zostupne']?>">Ostatné</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                Zoradiť podľa
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item <?php if($data["zostupne"]=="") { ?>active<?php }?>" href="?c=navody&strana=1&kategoria=<?=$data["kategoria"]."&zostupne="?>">Od najnovšieho príspevku</a></li>
                <li><a class="dropdown-item <?php if($data["zostupne"]!="") { ?>active<?php }?>" href="?c=navody&strana=1&kategoria=<?=$data["kategoria"]."&zostupne=1"?>">Od najstaršieho príspevku</a></li>
            </ul>
        </div>
    </div>
</div>



<div class="container  my-4 my-4 list-group">
    <?php foreach ($data["navody"] as $navod) { ?>


    <a href="?c=navody&a=navod&navodid=<?=$navod->getId()?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <?= $navod->getNazov()?>
    </a>
    <?php }?>




</div>


<div class="container">
    <ul class="pagination justify-content-end">
        <li class="page-item
        <?php if($data["strana"]==1) {?>
        disabled
        <?php } ?>
        "><a class="page-link" href="?c=navody&strana=<?=($data["strana"]-1)."&kategoria=".$data["kategoria"]?>">Predchádzajúca</a></li>

        <li class="page-item active"><a class="page-link" href="#"><?=$data["strana"]?></a></li>

        <li class="page-item
        <?php if($data["strana"] == $data["maxStran"]) { ?>
        disabled
        <?php } ?>
        "><a class="page-link" href="?c=navody&strana=<?=($data["strana"]+1)."&kategoria=".$data["kategoria"]?>">Ďalšia</a></li>
    </ul>
</div>
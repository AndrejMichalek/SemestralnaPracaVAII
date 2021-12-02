
<?php if($data["chyba"] != "") { ?>
    <div class="alert alert-danger mt-5 mb-5">
        <strong><?=$data["chyba"] ?></strong>
    </div>
<?php } ?>

<form class="mt-5 mb-5" method="post" action="?c=forum&a=pridajPrispevok">

    <h4 class="mb-3 mt-3">Čoho sa týka Váš problém?</h4>
    <div class="form-group">
        <input class="form-control" name="nazov" required>
    </div>

    <h4 class="mb-3 mt-3">Obsah otázky:</h4>
    <textarea class="form-control" rows="5" name="obsah" required></textarea>

    <h4 class="mb-3 mt-3">Vyberte kategóriu, do ktorej spadá Vaša otázka</h4>
    <div class="form-check">
        <input type="radio" class="form-check-input" name="kategoria" value="S">Smartphony
        <label class="form-check-label" for="radio1"></label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" name="kategoria" value="P">Počítače
        <label class="form-check-label" for="radio1"></label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" name="kategoria" value="O">Ostatné
        <label class="form-check-label" for="radio1"></label>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-3 text-center btn-lg" >Pridať</button>
    </div>
</form>

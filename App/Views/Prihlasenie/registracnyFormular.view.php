


<?php if($data["chyba"] != "") { ?>
    <div class="alert alert-danger mt-5 mb-5">
        <strong><?=$data["chyba"] ?></strong>
    </div>
<?php } ?>


<form class="mt-4 mb-5" method="post" action="?c=prihlasenie&a=registrujMa">

    <div class="form-group">
        <label>Používateľské meno:</label>
        <input class="form-control" name="username">
    </div>

    <div class="form-group">
        <label>Meno:</label>
        <input class="form-control" name="meno">
    </div>

    <div class="form-group">
        <label>Priezvisko:</label>
        <input class="form-control" name="priezvisko">
    </div>

    <div class="form-group">
        <label>email:</label>
        <input type="email" class="form-control" name="email">
    </div>

    <div class="form-group">
        <label>Heslo</label>
        <input type="password" name="heslo" class="form-control">
    </div>

    <div class="form-group">
        <label>Kontrola hesla</label>
        <input type="password" name="hesloKontrola" class="form-control">
    </div>



    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-3 text-center" >Zaregistrovať</button>
    </div>
</form>
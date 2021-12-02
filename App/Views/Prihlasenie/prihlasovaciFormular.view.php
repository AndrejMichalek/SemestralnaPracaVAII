<?php if($data["chyba"] != "") { ?>
<div class="alert alert-danger mt-5 mb-5">
    <strong><?=$data["chyba"] ?></strong> Skúste to znovu.
</div>
<?php } ?>

<?php if($data["uspesnePrihlasenie"] != "") { ?>
    <div class="alert alert-success mt-5 mb-5">
        <strong><?=$data["uspesnePrihlasenie"] ?></strong>
    </div>
<?php } ?>


<form class="mt-4 mb-5" method="post" action="?c=prihlasenie&a=prihlasMa">
    <div class="form-group">
        <label for="exampleInputEmail1">Používateľské meno:</label>
        <input class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        <small id="emailHelp"  class="form-text text-muted">Užívateľské meno, ktoré ste použili pri registrácii.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Heslo</label>
        <input type="password" name="heslo" class="form-control" id="exampleInputPassword1" required>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-3 text-center" >Prihlásiť sa</button>
    </div>



</form>

<div class="alert alert-info">
    <div class="text-center">
        <strong>Nemáte ešte účet?</strong>, nevadí - <a href="?c=prihlasenie&a=registracnyFormular" class="alert-link">Zaregistrujte sa</a>
    </div>
</div>
<?php
$meno = $data["meno"];
$priezvisko = $data["priezvisko"];
$email = $data["email"];



?>
<div class="mt-4">

    <div class="form-group">
        <label>Meno:</label>
        <input class="form-control editprofil" id="menoedit" name="meno" value="<?=$meno?>" required>
    </div>

    <div class="form-group">
        <label>Priezvisko:</label>
        <input class="form-control editprofil" id="priezviskoedit" name="priezvisko" value="<?=$priezvisko?>" required>
    </div>

    <div class="form-group">
        <label>email:</label>
        <input type="email" class="form-control editprofil" id="emailedit" name="email" value="<?=$email?>" required>
    </div>

    <div class="form-group">
        <label>Pôvodné heslo: </label>
        <input type="password" id="povodnehesloedit" name="heslo" class="form-control editprofil" required>
    </div>

    <div class="form-group">
        <label>Nové heslo (zadávajte, len ak chcete zmeniť heslo)</label>
        <input type="password" id="hesloedit" name="heslo" class="form-control editprofil" required>
    </div>

    <div class="form-group">
        <label>Kontrola hesla (zadávajte, len ak chcete zmeniť heslo) </label>
        <input type="password" id="kontrolaheslaedit" name="hesloKontrola" class="form-control editprofil" required>
    </div>




    <div class="text-center">
        <button onclick="editujProfil()" class="btn btn-primary mt-3 text-center" >Zmeniť</button>
    </div>

</div>
<div class="mt-2"  id="hlaskaeditaciaprofilu">


</div>


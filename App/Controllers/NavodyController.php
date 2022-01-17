<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\KrokNavodu;
use App\Models\Navod;
use App\Models\Pouzivatel;
use App\NavbarPrvky;
use App\Prihlasenie;

class NavodyController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        NavbarPrvky::setNavody();
        $navody = Navod::getAll();



        return $this->html(
            [
                "navody" => $navody
            ]
        );
    }

    public function navod() {
        NavbarPrvky::setNavody();

        $navodID = $this->request()->getValue("navodid");
        $navody = Navod::getAll("id = ?", [$navodID]);
        if(sizeof($navody) == 1) {
            $navod = $navody[0];
            $krokyNavodu = KrokNavodu::getAll("navodID = ? order by poradoveCislo asc", [$navodID]);

            return $this->html(
                [
                "navod" => $navod,
                "krokyNavodu" => $krokyNavodu
            ]
            );
        }
        $this->redirect("navody");

    }

    public function vytvoritNavod() {
        NavbarPrvky::setNavody();


        $navodid = $this->request()->getValue("navodid");
        $nazovNavodu = $this->request()->getValue("nadpisnavodu");
        if($navodid != "") {
            $navod = Navod::getAll("id = ?", [$navodid]);
            $nazovNavodu = $navod[0]->getNazov();
        }

        $chyba = $this->request()->getValue("chyba");

        $navodulozeny = "";
        if($navodid != $navodulozeny && $chyba == "") {
            $navodulozeny = "ano";
        }


        if($navodid != "") {
            $krokynavodu = KrokNavodu::getAll("navodID = ? order by poradoveCislo asc", [$navodid]);
        }
        else {
            $krokynavodu = "";
        }
        $chybaNeprialSa = $this->request()->getValue("chybanepridalsa");
        $chybaNepupraviSa = $this->request()->getValue("chybaneupravilsa");


        return $this->html(
            [
                "navodid" => $navodid,
                "nazovnavodu" => $nazovNavodu,
                "chyba" => $chyba,
                "navodulozeny" => $navodulozeny,

                "krokynavodu" => $krokynavodu,
                "chybaNeprialSa" => $chybaNeprialSa,

                "chybaneupravilsa" => $chybaNepupraviSa
            ]
        );
    }

    public function upravNavod() {
        if(Prihlasenie::jePrihlaseny() == false) {
            $this->redirect("navody");
        }

        $navodid = $this->request()->getValue("navodid");
        $nazov = $this->request()->getValue("nazov");

        if($nazov == "") {
            $this->redirect("navody", "vytvoritNavod", ["navodid"=>$navodid, "chyba" => "Názov nemôže byť prázdny"]);
        }
        $navody = Navod::getAll("id = ?", [$navodid]);
        if(count($navody) == 1) {
            if($navody[0]->getUsername() != Prihlasenie::dajUsername()) {
                $this->redirect("navody");
            } else {
                $navody[0]->setNazov($nazov);
                $datum = date('Y-m-d H:i:s');
                $navody[0]->setDatumUpravy($datum);
                $navody[0]->save();
                $this->redirect("navody", "vytvoritNavod", ["navodid"=>$navodid, "nadpisnavodu" => $nazov]);
            }
        } else {
            $navod = new Navod();
            $navod->setUsername(Prihlasenie::dajUsername());

            $datum = date('Y-m-d H:i:s');

            $navod->setDatumUpravy($datum);
            $navod->setNazov($nazov);
            $navod->save();

            $navody = Navod::getAll("nazov = ? AND username = ?", [$nazov, Prihlasenie::dajUsername()]);
            $navodid = $navody[0]->getId();
            $this->redirect("navody", "vytvoritNavod", ["navodid"=>$navodid, "nadpisnavodu" => $nazov]);
        }


    }

    public function pridajkrok() {
        $navodid = $this->request()->getValue("navodid");

        $obsah = $this->request()->getValue("obsah");
        $nazov = $this->request()->getValue("nazov");
        $fotka = "fotka";

        $navod = Navod::getAll("id = ?", [$navodid]);
        if(count($navod) == 1) {
            if($navod[0]->getUsername() == Prihlasenie::dajUsername()) {
                if($obsah != "" && strlen($obsah) > 3 && strlen($nazov) >3
                && isset($_FILES[$fotka]) &&
                    $_FILES[$fotka]['error'] == UPLOAD_ERR_OK ) {

                    $krokNavodu = new KrokNavodu();
                    $krokNavodu->setNazov($nazov);
                    $krokNavodu->setObsah($obsah);
                    $krokNavodu->setNavodID($navodid);


                    $ostatneKroky = KrokNavodu::getAll("navodID = ? ORDER BY poradoveCislo ASC", [$navodid]);
                    if(count($ostatneKroky) == 0) {
                        $krokNavodu->setPoradoveCislo(0);
                    } else {
                        $maxCislo = $ostatneKroky[count($ostatneKroky)-1]->getPoradoveCislo();
                        $krokNavodu->setPoradoveCislo($maxCislo+1);
                    }


                    $nazovObrazka = $navod[0]->getId().date('Y-m-d-H-i-s').$_FILES[$fotka]['name'];
                    if(strlen($nazovObrazka) > 255) {
                        $nazovObrazka = substr($nazovObrazka, 0, 255);
                    }
                    $ulozSemCesta = "public/obrazky/navody/".$nazovObrazka;

                    move_uploaded_file($_FILES[$fotka]['tmp_name'], $ulozSemCesta);
                    $krokNavodu->setObrazok($nazovObrazka);
                    $krokNavodu->save();
                    $this->redirect("navody", "vytvoritNavod", ["navodid" => $navodid]);

                } else {
                    $this->redirect("navody", "vytvoritNavod", ["navodid" => $navodid,
                        "chybanepridalsa" => "Všetky polia musia byť vyplnené"]);
                }

            }
        } else {
            $this->redirect("navody");
        }

    }

    public function vymazKrok() {
        $idZmaz = $this->request()->getValue("idZmaz");

        $krokNavodu = KrokNavodu::getAll("id = ?", [$idZmaz]);
        if(count($krokNavodu) != 1) {
            $this->redirect("navody");
            return;
        }
        $idNavod = $krokNavodu[0]->getNavodID();
        $navod = Navod::getAll("id = ?", [$idNavod]);
        if($navod[0]->getUsername() != Prihlasenie::dajUsername()) {
            $this->redirect("navody");
            return;
        }
        $ostatneKroky = KrokNavodu::getAll("navodID = ? order by poradoveCislo asc", [$idNavod]);
        for($i = $krokNavodu[0]->getPoradoveCislo() + 1; $i < count($ostatneKroky); $i++) {
            $ostatneKroky[$i]->setPoradoveCislo($i-1);
            $ostatneKroky[$i]->save();
        }


        unlink("public/obrazky/navody/".$krokNavodu[0]->getObrazok());
        $krokNavodu[0]->delete();
        $this->redirect("navody", "vytvoritNavod", ["navodid" => $idNavod]);

    }

    public function upravKrok() {
        $krokID = $this->request()->getValue("krokid");

        $fotka = "fotka";
        $nazov = $this->request()->getValue("nazov");
        $obsah = $this->request()->getValue("obsah");



        $krokNavodu = KrokNavodu::getAll("id = ?", [$krokID]);
        if(count($krokNavodu) != 1) {
            $this->redirect("navody");
            return;
        }
        $navodid = $krokNavodu[0]->getNavodID();
        $navod = Navod::getAll("id = ?", [$navodid]);
        if($navod[0]->getUsername() != Prihlasenie::dajUsername()) {
            $this->redirect("navody");
            return;
        }
        if(strlen($obsah) < 3 || strlen($nazov) < 3) {
            $this->redirect("navody", "vytvoritNavod", ["navodid" => $navod[0]->getId(),"chybaneupravilsa" => "Krok návodu musí obsahovať zmysluplný názov aj obsah"]);
            return;
        }


        $krokNavodu[0]->setObsah($obsah);
        $krokNavodu[0]->setNazov($nazov);
        if(isset($_FILES[$fotka]) &&
            $_FILES[$fotka]['error'] == UPLOAD_ERR_OK ) {

            $nazovObrazka = $navod[0]->getId().date('Y-m-d-H-i-s').$_FILES[$fotka]['name'];
            if(strlen($nazovObrazka) > 255) {
                $nazovObrazka = substr($nazovObrazka, 0, 255);
            }
            $ulozSemCesta = "public/obrazky/navody/".$nazovObrazka;

            move_uploaded_file($_FILES[$fotka]['tmp_name'], $ulozSemCesta);
            unlink("public/obrazky/navody/".$krokNavodu[0]->getObrazok());
            $krokNavodu[0]->setObrazok($nazovObrazka);

        }
        $krokNavodu[0]->save();
        $this->redirect("navody", "vytvoritNavod", ["navodid" => $navodid]);

    }


    public function posunKrok() {
        $krokID = $this->request()->getValue("krokid");
        $vyssie = $this->request()->getValue("vyssie");

        $krok = KrokNavodu::getAll("id = ?", [$krokID]);
        if(count($krok) != 1) {
            $this->redirect("navody");
            return;
        }
        $navod = Navod::getAll("id = ?", [$krok[0]->getNavodID()]);
        if($navod[0]->getUsername() != Prihlasenie::dajUsername()) {
            $this->redirect("navody");
            return;
        }

        $ostatneKroky = KrokNavodu::getAll("navodID = ? order by poradoveCislo asc", [$navod[0]->getId()]);
        if(count($ostatneKroky) == 1) {
            $this->redirect("navody", "vytvoritNavod", ["navodid" => $navod[0]->getId()]);
            return;
        }
        if($krok[0]->getPoradoveCislo() == $ostatneKroky[count($ostatneKroky)-1]->getPoradoveCislo()
        && $vyssie!="") {
            $this->redirect("navody", "vytvoritNavod", ["navodid" => $navod[0]->getId()]);
            return;
        }
        if($krok[0]->getPoradoveCislo() == $ostatneKroky[0]->getPoradoveCislo()
        && $vyssie=="") {
            $this->redirect("navody", "vytvoritNavod", ["navodid" => $navod[0]->getId()]);
            return;
        }
        if($vyssie!="") {
            $aktualneCislo = $krok[0]->getPoradoveCislo();
            $ostatneKroky[$aktualneCislo+1]->setPoradoveCislo($aktualneCislo);
            $ostatneKroky[$aktualneCislo+1]->save();
            $krok[0]->setPoradoveCislo($aktualneCislo+1);
            $krok[0]->save();
            $this->redirect("navody", "vytvoritNavod", ["navodid" => $navod[0]->getId()]);
            return;
        } else {
            $aktualneCislo = $krok[0]->getPoradoveCislo();
            $ostatneKroky[$aktualneCislo-1]->setPoradoveCislo($aktualneCislo+1);
            $ostatneKroky[$aktualneCislo-1]->save();
            $krok[0]->setPoradoveCislo($aktualneCislo-1);
            $krok[0]->save();
            $this->redirect("navody", "vytvoritNavod", ["navodid" => $navod[0]->getId()]);
            return;
        }
    }


}
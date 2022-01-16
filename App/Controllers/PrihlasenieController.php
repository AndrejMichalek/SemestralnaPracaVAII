<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\Pouzivatel;
use App\NavbarPrvky;
use App\Prihlasenie;

class PrihlasenieController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        // : Implement index() method.
    }

    public function prihlasovaciFormular() {
        NavbarPrvky::setPrihlasenie();

        return $this->html(
            [
                "chyba" => $this->request()->getValue("chyba"),
                "uspesnePrihlasenie" => $this->request()->getValue("uspesnePrihlasenie")
            ]
        );
    }

    public function prihlasMa() {
        $username = $this->request()->getValue("username");
        $heslo = $this->request()->getValue("heslo");

        $prihlaseny = Prihlasenie::prihlas($username, $heslo);

        if($prihlaseny) {
            $this->redirect("home");
        } else {
            $this->redirect("prihlasenie", "prihlasovaciFormular", ["chyba" => "Zadali ste zlé meno alebo heslo"]);
        }
    }

    public function odhlasMa() {
        Prihlasenie::odhlas();
        $this->redirect("home");
    }

    public function registracnyFormular() {
        NavbarPrvky::setRegistracia();

        return $this->html(
            [
                "chyba" => $this->request()->getValue("chyba")
            ]
        );
    }

    public function registrujMa() {

        $username = $this->request()->getValue("username");
        $email = $this->request()->getValue("email");
        $meno = $this->request()->getValue("meno");
        $priezvisko = $this->request()->getValue("priezvisko");
        $heslo = $this->request()->getValue("heslo");
        $hesloKontrola = $this->request()->getValue("hesloKontrola");




        $problem = Prihlasenie::zaregistrujMa($username, $email, $meno, $priezvisko, $heslo, $hesloKontrola, "profilovka");





        if($problem == "") {
            $this->redirect("prihlasenie", "prihlasovaciFormular", ["uspesnePrihlasenie" => "Registrácia prebehla úspešne, teraz sa môžete prihlásiť."]);
        } else {
            $this->redirect("prihlasenie", "registracnyFormular", ["chyba" => $problem]);
        }

    }

    public function existujeUsername() {
        $username = $this->request()->getValue("username");

        $pouzivatelia  = Pouzivatel::getAll("username = ?", [$username]);
        if(count($pouzivatelia) != 0) {
            return $this->json("ano");
        } else {
            return $this->json("nie");
        }

    }
}
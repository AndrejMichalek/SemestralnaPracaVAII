<?php

namespace App\Controllers;

use App\Core\DB\Connection;
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

    public function editujProfil() {
        if(Prihlasenie::jePrihlaseny()) {
            NavbarPrvky::setEditaciaProfilu();

            $pouzivatel = Pouzivatel::getAll("username = ?", [Prihlasenie::dajUsername()])[0];
            $meno = $pouzivatel->getMeno();
            $priezvisko = $pouzivatel->getPriezvisko();
            $email = $pouzivatel->getMail();

            return $this->html( [
                "meno" => $meno,
                "priezvisko" => $priezvisko,
                "email" => $email
            ]);
        } else {
            $this->redirect("home");
        }




    }

    public function zmenUdaje()
    {
        if (Prihlasenie::jePrihlaseny()) {
            $meno = $this->request()->getValue("meno");
            $priezvisko = $this->request()->getValue("priezvisko");
            $email = $this->request()->getValue("email");
            $povodneheslo = $this->request()->getValue("povodneheslo");
            $heslo = $this->request()->getValue("heslo");
            $kontrolaHesla = $this->request()->getValue("kontrolaHeslaBox");

            if(strlen($meno) < 3 || strlen($priezvisko) < 2 || strlen($email) < 3) {
                return $this->json("Vyplňte všetky údaje!");
            }

            if ($heslo == "") {
                $pouzivatel = Pouzivatel::getAll("username = ?", [Prihlasenie::dajUsername()]);

                if (Prihlasenie::overHeslo($povodneheslo, $pouzivatel[0]->getHeslo())) {
                    $pouzivatel[0]->setMeno($meno);
                    $pouzivatel[0]->setPriezvisko($priezvisko);
                    $pouzivatel[0]->setMail($email);

                    $pr = Connection::connect()->prepare("UPDATE pouzivatel SET meno = ?, priezvisko = ? , mail = ? 
                                where username = ?");
                    $pr->execute([$meno, $priezvisko, $email, $pouzivatel[0]->getUsername()]);

                    return $this->json("Zmeny boli vykonané");

                } else {
                    return $this->json("Zadali ste zlé heslo!");
                }
            } else {
                $pouzivatel = Pouzivatel::getAll("username = ?", [Prihlasenie::dajUsername()]);

                if (Prihlasenie::overHeslo($povodneheslo, $pouzivatel[0]->getHeslo())) {
                    if($heslo != $kontrolaHesla) {
                        return $this->json("Heslo nebolo zmenené, lebo heslá sa nerovnajú!");
                    }
                    $pouzivatel[0]->setHeslo($heslo);

                    $pr = Connection::connect()->prepare("UPDATE pouzivatel SET meno = ?, priezvisko = ? , mail = ?, heslo = ? 
                                where username = ?");
                    $pr->execute([$meno, $priezvisko, $email, $pouzivatel[0]->getHeslo(), $pouzivatel[0]->getUsername()]);

                    return $this->json("Zmeny boli vykonané");


                } else {
                    return $this->json("Zadali ste zlé heslo!");
                }
            }
        }
        else {
            return $this->json("Chyba");
        }

        return $this->json("Funguje to celkom");

        /*
        "meno="+menoBox.value + "&priezvisko=" + priezviskoBox.value + "&email=" + emailBox.value +
        "&povodneheslo=" + povodneHesloBox.value + "&heslo=" + hesloBox.value +
        "&kontrolaHeslaBox=" + kontrolaHeslaBox.value
        }

*/



    }
}
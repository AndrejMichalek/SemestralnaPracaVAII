<?php

namespace App\Controllers;

use App\Core\DB\Connection;
use App\Core\Responses\Response;
use App\Forum;
use App\Models\Komentar;
use App\NavbarPrvky;
use App\Models\Prispevok;
use App\Prihlasenie;

class ForumController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        NavbarPrvky::setForum();

        $prispevkovNaStranu = 15;


        $strana = $this->request()->getValue("strana");
        $kategoria = $this->request()->getValue("kategoria");
        $zostupne = $this->request()->getValue("zostupne");

        if($strana == "") {
            $strana = 1;
        }
        if($kategoria == "P" || $kategoria == "S" || $kategoria == "O") {
            $prispevky = Prispevok::getAll("kategoria = ?", [$kategoria]);
        } else {
            $prispevky = Prispevok::getAll();
        }


        if($zostupne == "") {
            $prispevky = array_reverse($prispevky);
        }

        $maxStran = count($prispevky) / $prispevkovNaStranu;
        $maxStran = ceil($maxStran);

        $prispevky = array_slice($prispevky, ($strana-1)*$prispevkovNaStranu, $prispevkovNaStranu);

        return $this->html(
            [
            "prispevky" => $prispevky,
            "strana" => $strana,
            "maxStran" => $maxStran,
                "kategoria" => $kategoria,
                "zostupne" => $zostupne
            ]
        );
    }



    public function pridatPrispevok() {
        return $this->html(
            [
                "chyba" => $this->request()->getValue("chyba")
            ]
        );
    }



    public function pridajPrispevok() {


        $nazov = $this->request()->getValue("nazov");
        $obsah = $this->request()->getValue("obsah");
        $kategoria = $this->request()->getValue("kategoria");



        $problem = "";
        if(Prihlasenie::jePrihlaseny()) {
            $problem = Forum::pridajPrispevok($nazov, $obsah, $kategoria);
        } else {
            $this->redirect("home");
        }


        if($problem == "") {
            $this->redirect("forum", "index");
        } else {
            $this->redirect("forum", "pridatPrispevok", ["chyba" => $problem]);
        }


    }

    public function prispevok() {
        $prispevokID = $this->request()->getValue("prispevokid");

        $prispevok = Forum::dajPrispevok($prispevokID);
        $autorPrispevku = Forum::dajAutoraPrispevku($prispevok[0]->getUsername());


        $komentare = Forum::dajKomentareKPrispevku($prispevokID);
        $pouzivatelia = Forum::dajUzivatelovKuKomentarom($komentare);

        $komentarUpravID = $this->request()->getValue("komentarUpravID");
        $problemZmenaKomentara = $this->request()->getValue("problemZmenaKomentara");

        if($prispevok == "") {
            $this->redirect("forum");
        } else {
            return $this->html(
                [
                    "prispevok" => $prispevok,
                    "autorPrispevku" => $autorPrispevku,
                    "komentare" => $komentare,
                    "pouzivatelia" => $pouzivatelia,


                    "komentarUpravID" => $komentarUpravID,
                    "problemZmenaKomentara" => $problemZmenaKomentara
                ]
            );
        }
    }



    public function  pridajKomentar() {

        $obsah =  $this->request()->getValue("obsah");
        $prispevokID = $this->request()->getValue("idPrispevku");

        $problem = Forum::pridajKomentar($obsah, $prispevokID);

        $this->redirect("forum", "prispevok", ["prispevokid" => $prispevokID,
            "chyba" => $problem]);

    }

    public function zmazKomentar() {


        if(Prihlasenie::jePrihlaseny()) {
            $zmazTentoID = $this->request()->getValue("idZmaz");

            $prispevokid = Forum::zmazKomentar($zmazTentoID);
            if($prispevokid != "") {
                $this->redirect("forum", "prispevok", ["prispevokid" => $prispevokid]);
            } else {
                $this->redirect("home");
            }

        } else {
            $this->redirect("home");
        }
    }

    public function upravKomentar() {
        $komentarUpravID = $this->request()->getValue("komentarUpravID");

        $prispevokID = $this->request()->getValue("idPrispevok");




        $this->redirect("forum", "prispevok", [
            "prispevokid" => $prispevokID,
            "komentarUpravID" => $komentarUpravID
        ]);
    }

    public function ulozZmenyVTomtoKomente() {

        $novyObsah = $this->request()->getValue("novyObsah");
        $komentarID = $this->request()->getValue("komentarID");
        $prispevokID = $this->request()->getValue("prispevokID");

        $problemZmenaKomentara = Forum::zmenKomentar($novyObsah, $komentarID);



        $this->redirect("forum", "prispevok", [
            "prispevokid" => $prispevokID,
            "problemZmenaKomentara" => $problemZmenaKomentara
        ]);
    }


}
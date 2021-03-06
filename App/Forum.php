<?php

namespace App;

use App\Core\DB\Connection;
use App\Models\Komentar;
use App\Models\Pouzivatel;
use App\Models\Prispevok;

class Forum
{
    public static function dajAutoraPrispevku($username) {
        $pouzivatel = Pouzivatel::getAll("username = ?", [$username]);
        return $pouzivatel[0];
    }

    public static function dajPocetPrispevkov($username) {
        $prispevky = Prispevok::getAll("username = ?", [$username]);
        return sizeof($prispevky);
    }

    public static function pridajPrispevok(
        $nazov,
        $obsah,
        $kategoria
    ) :string {
        if($nazov == "" || $obsah == "" || $kategoria == "") {
            return "Všetky polia musia byť vyplnené";
        } else if($kategoria != "S" && $kategoria != "P" && $kategoria!="O") {
            return "Pri zadávaní kategórie došlo k chybe";
        } else if(strlen($nazov) > 255) {
            return "Názov môže mať maximálne 255 znakov";
        }
        $username = Prihlasenie::dajUsername();

        /*$prispevok = new Prispevok();
        $prispevok->setUsername($username);
        $prispevok->setNazov($nazov);
        $prispevok->setObsah($obsah);


        $prispevok->setPocetKomentarov(0);
        $prispevok->save();

        */
        $datum = date('Y-m-d H:i:s');
        $data = Connection::connect()->prepare("INSERT INTO prispevok (username, nazov, obsah, kategoria, pocetKomentarov, datum) VALUES(?,?,?,?,?, ?)");
        $data->execute([$username, $nazov, $obsah, $kategoria, 0, $datum]);


        return "";
    }



    public static function dajPrispevok($id) {
        $prispevok = Prispevok::getAll("id = ?", [$id]);

        if(sizeof($prispevok) > 0) {
            return $prispevok;
        } else {
            return "";
        }
    }


    public static function dajKomentareKPrispevku($prispevokID) {
        $komentare = Komentar::getAll("prispevokID = ?", [$prispevokID]);
        return $komentare;
    }

    public static function dajUzivatelovKuKomentarom($komentare) {
        if(sizeof($komentare) > 0) {
            $pouzivatelia = array();
            for($i=0; $i < sizeof($komentare); $i++) {
                $pouzivatel = Pouzivatel::getAll("username = ?", [$komentare[$i]->getUsername()]);
                array_push($pouzivatelia, $pouzivatel[0]);

            }
            return $pouzivatelia;
        } else {
            return "";
        }
    }

    public static function pridajKomentar($obsah, $prispevokID) {
        if(Prihlasenie::jePrihlaseny()) {
            if(strlen($obsah) == 0) {
                return "Komentár musí obsahovať text";
            }

            $data = Connection::connect()->prepare("INSERT INTO komentar (prispevokID, username, obsah, datum) VALUES(?,?,?,?)");
            $data->execute([$prispevokID, Prihlasenie::dajUsername(), $obsah, date('Y-m-d H:i:s')]);

            $prispevok = Prispevok::getOne($prispevokID);
            $prispevok->zvysPocetKomentarov();
            $prispevok->save();

            return "";
        } else {
            return "Musíte byť prihlásený.";
        }
    }

    public static function zmenKomentar($obsah, $komentarID) {
        if(strlen($obsah) == 0) {
            return "Komentár nemôže byť prázdny";
        } else {
            $koment = Komentar::getOne($komentarID);
            if($koment->getUsername() != Prihlasenie::dajUsername()) {
                return "Nemôžete meniť komentáre, ktoré ste nenapísali!";
            }
            $uvodneSlovo = "[Upravený] ";
            if(substr($obsah, 0,strlen($uvodneSlovo)) != $uvodneSlovo) {
                $obsah=$uvodneSlovo.$obsah;
            }
            $koment->setObsah($obsah);
            $koment->save();
            return "";
        }
    }

    public static function zmazKomentar($komentarId) {


        $komentar = Komentar::getAll("id = ?", [$komentarId]);
        if(sizeof($komentar) == 1) {
            $prispevokid = $komentar[0]->getPrispevokID();
            $komentar[0]->delete();

            $prispevok = Prispevok::getOne($prispevokid);
            $prispevok->znizPocetKomentarov();
            $prispevok->save();

            return $prispevokid;
        }
        return "";
    }


}
<?php

namespace App;

use App\Models\Pouzivatel;

class Prihlasenie
{


    public static function prihlas($username, $heslo) : bool {
        $pouzivatel = Pouzivatel::getAll("username=?", [$username]);


        if(sizeof($pouzivatel) == 0) {
            return false;
        } else {


            $hesloDatabaza = $pouzivatel[0]->getHeslo();

            if(password_verify($heslo, $hesloDatabaza)) {
                $_SESSION["username"] = $username;

                return true;
            } else {
                return false;
            }
        }

    }

    public static function jePrihlaseny() {

        return isset($_SESSION["username"]);
    }

    public static function odhlas() {
        unset($_SESSION["username"]);
        session_destroy();
    }

    public static function dajUsername() {
        if(self::jePrihlaseny()) {
            return $_SESSION["username"];
        } else {
            return "";
        }
    }


    public static function zaregistrujMa(
        $username,
        $email,
        $meno,
        $priezvisko,
        $heslo,
        $hesloKontrola,
        $profilovkaSubor
    ) : string {
        if($heslo == "" || $email == "" || $username == "" || $meno == "" || $priezvisko == "") {
            $problem = "Vyplnte prosím všetky polia";
            return $problem;
        }

        if($heslo != $hesloKontrola) {
            return "Heslá, ktoré ste zadali, sa nerovnajú";
        }
        if(strlen($heslo) < 8) {
            return "Heslo je príliš krátke, heslo by malo mať aspoň 8 znakov.";
        }

        $pouzivatel = Pouzivatel::getAll("username=?", [$username]);
        if(sizeof($pouzivatel) > 0) {
            return "Daný username už sa používa, prosím zadajte iný.";
        }




        $pridajTohto = new Pouzivatel();
        $pridajTohto->setUsername($username);
        $pridajTohto->setMeno($meno);
        $pridajTohto->setPriezvisko($priezvisko);
        $pridajTohto->setMail($email);
        $pridajTohto->setHeslo($heslo);

        if($_FILES[$profilovkaSubor]['error'] == UPLOAD_ERR_OK) {
            if($_FILES[$profilovkaSubor]['name'] != "") {
                $nazovObrazka = $meno.$_FILES[$profilovkaSubor]['name'];
                if(strlen($nazovObrazka) > 255) {
                    $nazovObrazka = substr($nazovObrazka, 0, 255);
                }
                $ulozSemCesta = "public/obrazky/profilovky/$nazovObrazka";
                move_uploaded_file($_FILES[$profilovkaSubor]['tmp_name'], $ulozSemCesta);
                $pridajTohto->setProfilovyObrazok($nazovObrazka);
            }
        }

        $pridajTohto->save();

        return "";
    }

    public static function overHeslo($heslo, $hesloDatabaza) {
        return password_verify($heslo, $hesloDatabaza);
    }


}
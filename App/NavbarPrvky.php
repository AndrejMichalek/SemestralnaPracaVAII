<?php

namespace App;

class NavbarPrvky
{
    static $navDomov = "active";
    static $navForum = "";
    static $navNavody = "";
    static $navPrihlasenie = "";
    static $navRegistracia = "";

    static function setDomov() {
        self::vynuluj();
        self::$navDomov="active";
    }

    static function setForum() {
        self::vynuluj();
        self::$navForum = "active";
    }

    static function setNavody() {
        self::vynuluj();
        self::$navNavody= "active";
    }
    static function setPrihlasenie() {
        self::vynuluj();
        self::$navPrihlasenie = "active";
    }

    static function setRegistracia() {
        self::vynuluj();
        self::$navRegistracia= "active";
    }


    static function vynuluj() {
        self::$navDomov = "";
        self::$navForum = "";
        self::$navNavody = "";
        self::$navPrihlasenie = "";
        self::$navRegistracia = "";
    }


}
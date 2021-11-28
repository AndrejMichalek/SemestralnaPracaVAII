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
        self::$navDomov= "active";
        self::$navForum = "";
        self::$navNavody = "";
        self::$navPrihlasenie = "";
        self::$navRegistracia= "";
    }

    static function setForum() {
        self::$navDomov= "";
        self::$navForum = "active";
        self::$navNavody = "";
        self::$navPrihlasenie = "";
        self::$navRegistracia= "";
    }

    static function setNavody() {
        self::$navDomov= "";
        self::$navForum = "";
        self::$navNavody = "active";
        self::$navPrihlasenie = "";
        self::$navRegistracia= "";
    }
    static function setPrihlasenie() {
        self::$navDomov= "";
        self::$navForum = "";
        self::$navNavody = "";
        self::$navPrihlasenie = "active";
        self::$navRegistracia= "";
    }

    static function setRegistracia() {
        self::$navDomov= "";
        self::$navForum = "";
        self::$navNavody = "";
        self::$navPrihlasenie = "";
        self::$navRegistracia= "active";
    }

}
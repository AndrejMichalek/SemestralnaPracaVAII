<?php

namespace App\Models;

class Pouzivatel extends \App\Core\Model
{

    public $profilovyObrazok;

    public function __construct(
        public string $username ="",
        public string $mail = "",
        public string $heslo = "",
        public string $meno = "",
        public string $priezvisko = "",

    )
    {
    }

    /**
     * @return string
     */
    public function getPriezvisko(): string
    {
        return $this->priezvisko;
    }

    /**
     * @param string $priezvisko
     */
    public function setPriezvisko(string $priezvisko): void
    {
        $this->priezvisko = $priezvisko;
    }

    /**
     * @return string
     */
    public function getMeno(): string
    {
        return $this->meno;
    }

    /**
     * @param string $meno
     */
    public function setMeno(string $meno): void
    {
        $this->meno = $meno;
    }

    /**
     * @return string
     */
    public function getHeslo(): string
    {
        return $this->heslo;
    }

    /**
     * @param string $heslo
     */
    public function setHeslo(string $heslo): void
    {
        $this->heslo = password_hash($heslo, PASSWORD_DEFAULT);
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    static public function setDbColumns()
    {
        return ['username', 'mail', 'heslo', 'meno', 'priezvisko', 'profilovyObrazok'];
    }

    static public function setTableName()
    {
        return "pouzivatel";
    }

    /**
     * @return string
     */
    public function getProfilovyObrazok(): string
    {
        if($this->profilovyObrazok == "") {
            return "public/obrazky/profilovka.jpg";
        } else {
            return "public/obrazky/profilovky/".$this->profilovyObrazok;
        }

    }

    /**
     * @param string $profilovyObrazok
     */
    public function setProfilovyObrazok(string $profilovyObrazok): void
    {
        $this->profilovyObrazok = $profilovyObrazok;
    }


}
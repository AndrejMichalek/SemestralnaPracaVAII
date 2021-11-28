<?php

namespace App\Models;

class Prispevok extends \App\Core\Model
{

    public int $id;
        public string $username;
        public string $nazov;
        public string $obsah;
        public string $kategoria;
        public string $datum;
        public int $pocetKomentarov;


    public function __construct(

    )
    {


    }

    /**
     * @return int
     */
    public function getPocetKomentarov(): int
    {
        return $this->pocetKomentarov;
    }

    /**
     * @param int $pocetKomentarov
     */
    public function setPocetKomentarov(int $pocetKomentarov): void
    {
        $this->pocetKomentarov = $pocetKomentarov;
    }

    /**
     * @return string
     */
    public function getDatum(): string
    {
        return $this->datum;
    }

    /**
     * @param string $datum
     */
    public function setDatum(string $datum): void
    {
        $this->datum = $datum;
    }

    /**
     * @return string
     */
    public function getKategoria(): string
    {
        return $this->kategoria;
    }

    /**
     * @param string $kategoria
     */
    public function setKategoria(string $kategoria): void
    {
        $this->kategoria = $kategoria;
    }

    /**
     * @return string
     */
    public function getObsah(): string
    {
        return $this->obsah;
    }

    /**
     * @param string $obsah
     */
    public function setObsah(string $obsah): void
    {
        $this->obsah = $obsah;
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

    /**
     * @return string
     */
    public function getNazov(): string
    {
        return $this->nazov;
    }

    /**
     * @param string $nazov
     */
    public function setNazov(string $nazov): void
    {
        $this->nazov = $nazov;
    }


    static public function setDbColumns()
    {
        return ['id', 'username', 'nazov', 'obsah', 'kategoria', 'datum', 'pocetKomentarov'];
    }

    static public function setTableName()
    {
        return "prispevok";
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
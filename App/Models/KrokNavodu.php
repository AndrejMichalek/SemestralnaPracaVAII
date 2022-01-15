<?php

namespace App\Models;

class KrokNavodu extends \App\Core\Model
{
    public $id;
    public $obrazok;
    public $nazov;
    public $obsah;
    public $navodID;
    public $poradoveCislo;


    static public function setDbColumns()
    {
        return ["id", "obrazok", "nazov", "obsah", "navodID", "poradoveCislo"];
    }

    static public function setTableName()
    {
        return "kroknavodu";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getObrazok()
    {
        return $this->obrazok;
    }

    /**
     * @param mixed $obrazok
     */
    public function setObrazok($obrazok): void
    {
        $this->obrazok = $obrazok;
    }

    /**
     * @return mixed
     */
    public function getNazov()
    {
        return $this->nazov;
    }

    /**
     * @param mixed $nazov
     */
    public function setNazov($nazov): void
    {
        $this->nazov = $nazov;
    }

    /**
     * @return mixed
     */
    public function getObsah()
    {
        return $this->obsah;
    }

    /**
     * @param mixed $obsah
     */
    public function setObsah($obsah): void
    {
        $this->obsah = $obsah;
    }

    /**
     * @return mixed
     */
    public function getNavodID()
    {
        return $this->navodID;
    }

    /**
     * @param mixed $navodID
     */
    public function setNavodID($navodID): void
    {
        $this->navodID = $navodID;
    }

    /**
     * @return mixed
     */
    public function getPoradoveCislo()
    {
        return $this->poradoveCislo;
    }

    /**
     * @param mixed $poradoveCislo
     */
    public function setPoradoveCislo($poradoveCislo): void
    {
        $this->poradoveCislo = $poradoveCislo;
    }
}
<?php

namespace App\Models;

class Komentar extends \App\Core\Model
{

    public $id;
    public $prispevokID;
    public $username;
    public $obsah;
    public $datum;


    public function __construct(
    )
    {
    }


    static public function setDbColumns()
    {
        return ["id", "prispevokID", "username", "obsah", "datum"];
    }

    static public function setTableName()
    {
        return "komentar";
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
    public function getPrispevokID()
    {
        return $this->prispevokID;
    }

    /**
     * @param mixed $prispevokID
     */
    public function setPrispevokID($prispevokID): void
    {
        $this->prispevokID = $prispevokID;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
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
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     */
    public function setDatum($datum): void
    {
        $this->datum = $datum;
    }


}
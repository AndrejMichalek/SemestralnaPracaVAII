<?php

namespace App\Models;

class Navod extends \App\Core\Model
{


    public $id;
    public $username;
    public $datumUpravy;
    public $nazov;
    public $kategoria;




    public function __construct(
    )
    {
    }


    static public function setDbColumns()
    {
        return ["id", "username", "datumUpravy", "nazov", "kategoria"];
    }

    static public function setTableName()
    {
        return "navod";
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
    public function getDatumUpravy()
    {
        return $this->datumUpravy;
    }

    /**
     * @param mixed $datumUpravy
     */
    public function setDatumUpravy($datumUpravy): void
    {
        $this->datumUpravy = $datumUpravy;
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
    public function getKategoria()
    {
        return $this->kategoria;
    }

    /**
     * @param mixed $kategoria
     */
    public function setKategoria($kategoria): void
    {
        $this->kategoria = $kategoria;
    }
}
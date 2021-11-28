<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\NavbarPrvky;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{

    public function index()
    {
        NavbarPrvky::setDomov();

        return $this->html(
            [
                'meno' => 'študent'
            ]);
    }

    public function kontakty()
    {
        return $this->html(
            []
        );
    }
}
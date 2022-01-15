<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\KrokNavodu;
use App\Models\Navod;
use App\NavbarPrvky;

class NavodyController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        NavbarPrvky::setNavody();
        $navody = Navod::getAll();



        return $this->html(
            [
                "navody" => $navody
            ]
        );
    }

    public function navod() {
        $navodID = $this->request()->getValue("navodid");
        $navody = Navod::getAll("id = ?", [$navodID]);
        if(sizeof($navody) == 1) {
            $navod = $navody[0];
            $krokyNavodu = KrokNavodu::getAll("navodID = ?", [$navodID]);

            return $this->html(
                [
                "navod" => $navod,
                "krokyNavodu" => $krokyNavodu
            ]
            );
        }
        $this->redirect("navody");

    }
}
<?php

namespace App\Controllers;

use App\Models\Film;

class Home extends BaseController

{
    public function index() {

        $films = new Film();
        $data['films'] = $films->findAll();

        // var_dump($data);
        
        return view("Home", $data);
    }
}

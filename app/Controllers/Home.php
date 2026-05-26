<?php

namespace App\Controllers;

use App\Models\Film;
use App\Models\Person;

class Home extends BaseController

{
    public function index() {

        $films = new Film();
        $data['films'] = $films->findAll();

        // var_dump($data);
        
        return view("Home", $data);
    }

    public function showFilm($id) {

        $films = new Film();
        $persons = new Person();
        $data['film'] = $films->where("id", $id)->first();
        $data['person'] = $persons->findAll();

        // var_dump($data);
        
        return view("Film", $data);
    }
}

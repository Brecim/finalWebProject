<?php

namespace App\Controllers;

use App\Models\Film;
use App\Libraries\FilmTools;

class Home extends BaseController

{
    public function index() {

        $films = new Film();
        $perPage = config('Pager')->perPage;

        $data['films'] = $films->orderBy('id', 'ASC')->paginate($perPage);
        $data['pager'] = $films->pager;

        // var_dump($data);
        
        return view("home", $data);
    }

    public function showFilm($id) {

        $films = new Film();
        $data['film'] = $films->where("id", $id)->first();

        $filmTools = new FilmTools();
        $data['filmCastCount'] = $filmTools->getFilmCastCount((int) $id);
        $data['filmPeople'] = $filmTools->getFilmPeopleWithRoles((int) $id);

        // var_dump($data);
        
        return view("film", $data);
    }
}

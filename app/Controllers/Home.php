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
        
        return view("home", $data);
    }

    public function showFilm($id) {

        $films = new Film();
        $persons = new Person();
        $data['film'] = $films->where("id", $id)->first();
        $data['person'] = $persons->findAll();

        // Get people and roles for this film
        $db = \Config\Database::connect();
        $builder = $db->table('persons_has_films');
        $builder->select('persons.id, persons.first_name, persons.last_name, roles.id as role_id, roles.name as role_name')
                ->join('persons', 'persons.id = persons_has_films.persons_id')
                ->join('roles', 'roles.id = persons_has_films.roles_id')
                ->where('persons_has_films.films_id', $id);
        
        $data['filmPeople'] = $builder->get()->getResultObject();

        // var_dump($data);
        
        return view("film", $data);
    }
}

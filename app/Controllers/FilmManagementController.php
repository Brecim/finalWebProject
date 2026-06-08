<?php

namespace App\Controllers;

use App\Models\Film;
use App\Models\Person;
use App\Models\Role;
use App\Libraries\FilmTools;

class FilmManagementController extends BaseController
{
    public function index()
    {
        $filmModel = new Film();

        $data = [
            'films' => $filmModel->orderBy('id', 'ASC')->findAll(),
        ];

        return view('admin/films/list', $data);
    }

    public function createForm()
    {
        return view('admin/films/create', [
            'film' => null,
        ]);
    }

    public function create()
    {
        $rules = [
            'title' => 'required|min_length[2]|max_length[255]',
            'year' => 'required|integer|exact_length[4]',
            'length' => 'required|integer',
            'description' => 'required|min_length[10]',
            'poster_image' => 'uploaded[poster_image]|max_size[poster_image,4096]|is_image[poster_image]|mime_in[poster_image,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (! $this->validate($rules)) {
            return view('admin/films/create', [
                'film' => null,
                'validation' => $this->validator,
            ]);
        }

        $posterImage = $this->request->getFile('poster_image');
        $filmTools = new FilmTools();
        $posterName = $filmTools->storePosterImage($posterImage);

        $filmModel = new Film();
        $filmModel->insert([
            'title' => $this->request->getPost('title'),
            'year' => $this->request->getPost('year'),
            'length' => $this->request->getPost('length'),
            'description' => $this->request->getPost('description'),
            'poster_image' => $posterName,
        ]);

        return redirect()->to(site_url('admin/films'))->with('success', 'Film has been created successfully.');
    }

    public function edit($id)
    {
        $filmModel = new Film();
        $film = $filmModel->find($id);

        if (! $film) {
            return redirect()->to(site_url('admin/films'))->with('error', 'The film could not be found.');
        }

        $personModel = new Person();
        $roleModel = new Role();
        $filmTools = new FilmTools();

        return view('admin/films/edit', [
            'film' => $film,
            'people' => $filmTools->getFilmPeopleWithRoles((int) $id),
            'availablePeople' => $personModel->findAll(),
            'availableRoles' => $roleModel->findAll(),
        ]);
    }

    public function update($id)
    {
        $filmModel = new Film();
        $film = $filmModel->find($id);

        if (! $film) {
            return redirect()->to(site_url('admin/films'))->with('error', 'The film could not be found.');
        }

        $rules = [
            'title' => 'required|min_length[2]|max_length[255]',
            'year' => 'required|integer|exact_length[4]',
            'length' => 'required|integer',
            'description' => 'required|min_length[10]',
        ];

        if ($this->request->getFile('poster_image')->isValid()) {
            $rules['poster_image'] = 'max_size[poster_image,4096]|is_image[poster_image]|mime_in[poster_image,image/jpg,image/jpeg,image/png,image/webp]';
        }

        if (! $this->validate($rules)) {
            $filmTools = new FilmTools();

            return view('admin/films/edit', [
                'film' => $film,
                'validation' => $this->validator,
                'people' => $filmTools->getFilmPeopleWithRoles((int) $id),
                'availablePeople' => (new Person())->findAll(),
                'availableRoles' => (new Role())->findAll(),
            ]);
        }

        $posterImage = $this->request->getFile('poster_image');
        $posterName = $film->poster_image;
        $filmTools = new FilmTools();

        if ($posterImage && $posterImage->isValid() && ! $posterImage->hasMoved()) {
            $posterName = $filmTools->storePosterImage($posterImage, $film->poster_image);
        }

        $filmModel->update($id, [
            'title' => $this->request->getPost('title'),
            'year' => $this->request->getPost('year'),
            'length' => $this->request->getPost('length'),
            'description' => $this->request->getPost('description'),
            'poster_image' => $posterName,
        ]);

        return redirect()->to(site_url('admin/films'))->with('success', 'Film has been updated successfully.');
    }

    public function delete($id)
    {
        $filmModel = new Film();
        $film = $filmModel->find($id);

        if (! $film) {
            return redirect()->to(site_url('admin/films'))->with('error', 'The film could not be found.');
        }

        if (! empty($film->poster_image)) {
            $filmTools = new FilmTools();
            $filmTools->deletePosterImage($film->poster_image);
        }

        $filmModel->delete($id);

        return redirect()->to(site_url('admin/films'))->with('success', 'Film has been deleted successfully.');
    }

    public function addPerson($filmId)
    {
        $personId = $this->request->getPost('person_id');
        $roleId = $this->request->getPost('role_id');

        if (empty($personId) || empty($roleId)) {
            return redirect()->back()->with('error', 'Please select both person and role.');
        }

        $db = \Config\Database::connect();

        $existing = $db->table('persons_has_films')
            ->where('persons_id', $personId)
            ->where('films_id', $filmId)
            ->get()
            ->getRow();

        if ($existing) {
            return redirect()->back()->with('error', 'This person is already assigned to this film.');
        }

        $db->table('persons_has_films')->insert([
            'persons_id' => $personId,
            'films_id' => $filmId,
            'roles_id' => $roleId,
        ]);

        return redirect()->back()->with('success', 'Person added to film successfully.');
    }

    public function removePerson($filmId, $personId)
    {
        $db = \Config\Database::connect();
        $db->table('persons_has_films')
            ->where('persons_id', $personId)
            ->where('films_id', $filmId)
            ->delete();

        return redirect()->back()->with('success', 'Person removed from film successfully.');
    }
}
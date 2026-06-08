<?php

namespace App\Controllers;

use App\Models\Film;
use App\Models\Person;
use App\Models\Role;
use App\Models\PersonRole;

class FilmManagementController extends BaseController
{
    private function storePosterImage($posterImage, ?string $oldPosterImage = null): string
    {
        if ($oldPosterImage && is_file(ROOTPATH . 'csfd_pictures/' . $oldPosterImage)) {
            @unlink(ROOTPATH . 'csfd_pictures/' . $oldPosterImage);
        }

        $posterName = $posterImage->getClientName();
        $posterImage->move(ROOTPATH . 'csfd_pictures', $posterName, true);

        return $posterName;
    }

    private function getFilmPeopleWithRoles($filmId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('persons_has_films');
        $builder->select('persons.id, persons.first_name, persons.last_name, roles.id as role_id, roles.name as role_name')
                ->join('persons', 'persons.id = persons_has_films.persons_id')
                ->join('roles', 'roles.id = persons_has_films.roles_id')
                ->where('persons_has_films.films_id', $filmId);
        
        return $builder->get()->getResultObject();
    }

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
        $posterName = $this->storePosterImage($posterImage);

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

        return view('admin/films/edit', [
            'film' => $film,
            'people' => $this->getFilmPeopleWithRoles($id),
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
            return view('admin/films/edit', [
                'film' => $film,
                'validation' => $this->validator,
            ]);
        }

        $posterImage = $this->request->getFile('poster_image');
        $posterName = $film->poster_image;

        if ($posterImage && $posterImage->isValid() && ! $posterImage->hasMoved()) {
            $posterName = $this->storePosterImage($posterImage, $film->poster_image);
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
            $posterPath = ROOTPATH . 'csfd_pictures/' . $film->poster_image;
            if (is_file($posterPath)) {
                @unlink($posterPath);
            }
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

        $personRoleModel = new PersonRole();
        
        // Check if this person is already in this film with a different role
        $existing = $personRoleModel->where('persons_id', $personId)
                                     ->where('films_id', $filmId)
                                     ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'This person is already assigned to this film.');
        }

        $personRoleModel->insert([
            'persons_id' => $personId,
            'films_id' => $filmId,
            'roles_id' => $roleId,
        ]);

        return redirect()->back()->with('success', 'Person added to film successfully.');
    }

    public function removePerson($filmId, $personId)
    {
        $personRoleModel = new PersonRole();
        $personRoleModel->where('persons_id', $personId)
                        ->where('films_id', $filmId)
                        ->delete();

        return redirect()->back()->with('success', 'Person removed from film successfully.');
    }
}
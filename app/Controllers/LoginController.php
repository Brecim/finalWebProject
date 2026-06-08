<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class LoginController extends BaseController

{
    public $ionAuth;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->ionAuth = new \IonAuth\Libraries\IonAuth();
        return parent::initController($request, $response, $logger);
    }

    public function login()
    {
        if ($this->ionAuth->loggedIn()) {
        return redirect()->to('/admin/films');
    }

        return view ("login");
    }

    public function auth()
    {
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $logged = $this->ionAuth->login($username, $password);

        if ($logged) {
            return redirect()->to("admin/films");
        }
        else {
            return redirect()->to("/login");
        }
    }

    public function logout()
    {
        $this->ionAuth->logout();
        return redirect()->to('')->with('success', 'You have been logged out successfully.');
    }

    public function profile()
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = $this->ionAuth->user()->row();
        
        // Get user groups
        $db = \Config\Database::connect();
        $builder = $db->table('users_groups');
        $builder->select('groups.id, groups.name, groups.description')
                ->join('groups', 'groups.id = users_groups.group_id')
                ->where('users_groups.user_id', $user->id);
        
        $userGroups = $builder->get()->getResultObject();

        return view('user/profile', [
            'user' => $user,
            'groups' => $userGroups,
        ]);
    }
}
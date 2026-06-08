<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class LoginController extends BaseController

{
    public $ionAuth;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->ionAuth = new \IonAuth\Libraries\IonAuth();
        helper(['form', 'bootstrap_form']);
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
        $identity = trim((string) $this->request->getPost('identity'));
        $password = $this->request->getPost("password");
        $remember = (bool) $this->request->getPost('remember');

        if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
            $user = (new User())->select('username')->where('email', $identity)->first();
            $identity = $user->username ?? $identity;
        }

        $logged = $this->ionAuth->login($identity, $password, $remember);

        if ($logged) {
            return redirect()->to("admin/films");
        }
        else {
            return redirect()->to('/login')->with('message', $this->ionAuth->errors())->withInput();
        }
    }

    public function register()
    {
        if ($this->ionAuth->loggedIn()) {
            return redirect()->to('/');
        }

        $rules = [
            'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'email' => 'required|valid_email|max_length[254]|is_unique[users.email]',
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'password' => 'required|min_length[8]|matches[password_confirm]',
            'password_confirm' => 'required',
        ];

        if (! $this->validate($rules)) {
            return view('register', [
                'message' => $this->validator->listErrors(),
            ]);
        }

        $register = $this->ionAuth->register(
            $this->request->getPost('username'),
            $this->request->getPost('password'),
            $this->request->getPost('email'),
            [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'company' => $this->request->getPost('company'),
                'phone' => $this->request->getPost('phone'),
            ]
        );

        if ($register) {
            return redirect()->to('/login')->with('success', 'Account created successfully. You can now log in.');
        }

        return view('register', [
            'message' => $this->ionAuth->errors(),
        ]);
    }

    public function registerForm()
    {
        if ($this->ionAuth->loggedIn()) {
            return redirect()->to('/');
        }

        return view('register');
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
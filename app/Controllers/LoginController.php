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
}

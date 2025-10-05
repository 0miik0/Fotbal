<?php

namespace App\Controllers;

use IonAuth\Libraries\IonAuth;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class AuthController extends Administration
{
    protected $ionAuth;
    protected $session;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->ionAuth = new IonAuth();
        $this->session = session();
    }

    public function login()
    {
        if ($this->ionAuth->loggedIn()) {
            return redirect()->to('/');
        }

        echo view('login');
    }

    public function loginPost()
    {
        $identity = $this->request->getPost('identity');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        if ($this->ionAuth->login($identity, $password, $remember)) {
            return redirect()->to('/');
        } else {
            $this->session->setFlashdata('error', $this->ionAuth->errors());
            return redirect()->back()->withInput();
        }
    }

    public function register()
    {
        if ($this->ionAuth->loggedIn()) {
            return redirect()->to('/');
        }

        echo view('register');
    }

    public function registerPost()
    {
        $identity = $this->request->getPost('identity');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $additionalData = ['email' => $email];

        $db = \Config\Database::connect();
        $builder = $db->table('groups');
        $group = $builder->where('name', 'members')->get()->getRowArray();

        if (!$group) {
            $this->session->setFlashdata('error', 'Skupina "members" neexistuje. Kontaktujte admina.');
            return redirect()->back()->withInput();
        }

        $groupIds = [$group['id']];

        $register = $this->ionAuth->register($identity, $password, $email, $additionalData, $groupIds);

        if ($register) {
            $this->session->setFlashdata('message', 'Registrace proběhla úspěšně, můžete se přihlásit.');
            return redirect()->to('login');
        } else {
            $this->session->setFlashdata('error', $this->ionAuth->errors());
            return redirect()->back()->withInput();
        }
    }




    public function logout()
    {
        $this->ionAuth->logout();
        return redirect()->to('login');
    }
}
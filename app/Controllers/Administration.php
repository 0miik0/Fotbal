<?php

namespace App\Controllers;

class Administration extends BaseController
{
    protected $data = [];

    public function index()
    {
        if ($this->ionAuth->loggedIn()) {
            echo 'Logged in as user ID: ' . $this->ionAuth->user()->row()->id . '<br>';
            echo 'Is Admin? ' . ($this->ionAuth->isAdmin() ? 'YES' : 'NO') . '<br>';
        } else {
            echo 'Not logged in';
        }

        return view('homepage', $this->data);
    }

    public function loadAdministration()
    {
        return view('administration', $this->data);
    }
}
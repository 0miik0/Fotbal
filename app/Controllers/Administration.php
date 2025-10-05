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

    // --- Article administration CRUD ---
    public function articles()
    {
        $this->articleModel = new \App\Models\Article();
        $data['articles'] = $this->articleModel->orderBy('date', 'DESC')->findAll();
        return view('admin/articles/list', $data);
    }

    public function articleForm($id = null)
    {
        $this->articleModel = new \App\Models\Article();
        $data = [];
        if ($id) {
            $data['article'] = $this->articleModel->find($id);
        }
        return view('admin/articles/form', $data);
    }

    public function saveArticle()
    {
        $this->articleModel = new \App\Models\Article();
        $post = $this->request->getPost();

        $data = [
            'title' => $post['title'] ?? '',
            'text' => $post['text'] ?? '',
            'published' => isset($post['published']) ? 1 : 0,
            'top' => isset($post['top']) ? 1 : 0,
            'date' => $post['date'] ?? date('Y-m-d H:i:s'),
        ];

        // Normalize datetime-local input (which looks like "YYYY-MM-DDTHH:MM") to unix timestamp
        if (!empty($post['date'])) {
            $d = $post['date'];
            // If form submitted a datetime-local, convert to timestamp
            if (preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/', $d)) {
                $data['date'] = strtotime($d);
            } else if (is_numeric($d)) {
                $data['date'] = (int)$d;
            } else {
                $data['date'] = date('Y-m-d H:i:s', strtotime($d));
            }
        }

        if (!empty($post['id'])) {
            $this->articleModel->update($post['id'], $data);
        } else {
            $this->articleModel->insert($data);
        }

        return redirect()->to('/admin/articles');
    }

    public function deleteArticle($id)
    {
        $this->articleModel = new \App\Models\Article();
        $this->articleModel->delete($id);
        return redirect()->to('/admin/articles');
    }
}
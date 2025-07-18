<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }

    public function dashboard()
    {
        return view('admin_dashboard');
    }

    public function list()
    {
        $model = new AdminModel();
        $admins = $model->findAll();
        return view('admin_list', ['admins' => $admins]);
    }

    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $model = new AdminModel();
            $data = [
                'nama'     => $this->request->getPost('nama'),
                'email'    => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $model->insert($data);
            return redirect()->to('/admin/list');
        }
        return view('admin_add');
    }
}
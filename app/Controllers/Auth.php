<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function doLogin()
    {
        $session = session();
        $model = new \App\Models\AdminModel();

        $email = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));

        $admin = $model->where('email', $email)->first();



        // kode setelahnya gak jalan karena dd() break
        if ($admin && password_verify($password, $admin['password'])) {
            $session->set('isLoggedIn', true);
            $session->set('adminName', $admin['nama']);
            return redirect()->to('/admin/kelola');
        }

        return redirect()->back()->with('error', 'Login gagal');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}

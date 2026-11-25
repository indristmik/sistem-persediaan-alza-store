<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class LoginController extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
    }

    public function index()
    {
        if (session()->get('logged_in')) {
            return $this->redirectDashboard(
                session()->get('peran')
            );
        }

        return view('Login');
    }

    public function login()
    {
        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        if ($username === '' || $password === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username dan password wajib diisi.');
        }

        $pengguna = $this->penggunaModel
            ->where('username', $username)
            ->first();

        if (
            !$pengguna ||
            !password_verify($password, $pengguna['password'])
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah.');
        }

        if (!in_array($pengguna['peran'], ['owner', 'admin'], true)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Role pengguna tidak valid.');
        }

        session()->regenerate();

        session()->set([
            'id_pengguna' => $pengguna['id_pengguna'],
            'username'    => $pengguna['username'],
            'nama_lengkap' => $pengguna['nama_lengkap'],
            'peran'       => $pengguna['peran'],
            'logged_in'   => true
        ]);

        return $this->redirectDashboard($pengguna['peran']);
    }

    private function redirectDashboard($peran)
    {
        if ($peran === 'owner') {
            return redirect()->to('Owner/Dashboard');
        }

        if ($peran === 'admin') {
            return redirect()->to('Admin/Dashboard');
        }

        return redirect()->to('/')->with('error', 'Role tidak valid.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/')
            ->with('success', 'Berhasil logout.');
    }
}

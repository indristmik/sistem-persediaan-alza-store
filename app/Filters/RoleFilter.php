<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        $role = session()->get('peran');

        // Role yang diizinkan
        $allowedRoles = $arguments ?? [];

        if (!in_array($role, $allowedRoles, true)) {

            if ($role === 'owner') {
                return redirect()->to('/Owner/Dashboard');
            }

            if ($role === 'admin') {
                return redirect()->to('/Admin/Dashboard');
            }

            session()->destroy();

            return redirect()->to('/');
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // 
    }
}

<?php

namespace App\Filters; // <--- Importante: Debe coincidir con la carpeta

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
{
    if (!session()->get('logged_in')) { // <--- CAMBIAR AQUÍ
        return redirect()->to('/sign-in');
    }
}

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se requiere lógica aquí
    }
}
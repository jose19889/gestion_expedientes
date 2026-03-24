<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ApiAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $apiKey = $request->getHeaderLine('X-API-KEY'); // cabecera donde se envía la clave
        $validKey = getenv('API_KEY'); // tu clave segura en .env

        if (!$apiKey || $apiKey !== $validKey) {
            $response = service('response');
            $response->setStatusCode(401);
            $response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized: API key inválida o inexistente.'
            ]);
            return $response->send();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No hacemos nada después
    }
}

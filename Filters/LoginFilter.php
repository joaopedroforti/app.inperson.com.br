<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Pegue a URI atual
        $currentURI = $request->getUri()->getPath();


        // Verifique se a URI é 'check-slug' e o método é POST, e ignore a verificação de autenticação
        if ($currentURI === '/check-slug' && $request->getMethod() === 'post') {
            return;
        } else {
            if ($currentURI === '/person/toggleFavorite' && $request->getMethod() === 'post') {
                return;
            } else {
                // Verifique se o usuário está autenticado
                if (empty(session()->get('user'))) {
                    return redirect()->to('/login');
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

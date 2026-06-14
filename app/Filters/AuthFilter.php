<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {   
        //kontroluje prihlaseni pokud neni prihlaseny redirect na login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login')->with('error', 'Nejdříve se musíš přihlásit.');
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}

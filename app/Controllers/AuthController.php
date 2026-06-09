<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Services\AuthService;


class AuthController extends BaseController
{
    protected $userModel;
    protected $authService;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->authService = new AuthService();
    }

    public function login()
    {
        return view('auth/login_view');
    }
    public function loginProcess()
    {   
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $this->authService->attemptLogin($username, $password);

        

    }

    public function register()
    {
        return view('auth/register_view');
    }
    public function registerProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $this->authService->register($username, $password);

    }

    public function logout()
    {

    }
}

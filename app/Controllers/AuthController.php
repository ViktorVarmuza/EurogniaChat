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
        return view('pages/auth/login_view');
    }


    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (! $this->validate('login')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        if ($this->authService->attemptLogin($username, $password)) {
            return redirect()->to('/chat')->with('success', 'Přihlášení bylo úspěšné');
        } else {
            // Login failed
            return redirect()->back()->withInput()->with('errors', ['login' => 'Neplatné uživatelské jméno nebo heslo']);
        }
    }


    public function register()
    {
        return view('auth/register_view');
    }


    public function registerProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');


        if (! $this->validate('registration')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->authService->register($username, $password);

        return redirect()->to('/login')->with('success', 'Registrace byla úspěšná, prosím přihlašte se.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Byl jste odhlášen.');
    }
}

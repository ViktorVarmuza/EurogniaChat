<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Services\AuthService; //service provadi hlavni funkce pro login a register

//login controller
class AuthController extends BaseController
{
    protected $userModel;
    protected $authService;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->authService = new AuthService();
    }

    public function login() // vraci authview
    {
        return view('pages/auth_view');
    }

    
    public function loginProcess() // prihlaseni
    {


        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        //validace dat

        if (! $this->validate('login')) { 
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors(), 'login');
        }

        //loginProcess se deje v authService
        if ($this->authService->attemptLogin($username, $password)) {
            return redirect()->to('/chat')->with('success', 'Přihlášení bylo úspěšné');
        } else {
            // Login failed
            return redirect()->back()->withInput()->with('errors', ['login' => 'Neplatné uživatelské jméno nebo heslo']);
        }
    }




    public function registerProcess() // register
    {
        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        //validace dat
        if (! $this->validate('registration')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors(), 'register');
        }

        //register se deje v authService
        $this->authService->register($username, $password);

        return redirect()->to('/login')->with('success', 'Registrace byla úspěšná, prosím přihlašte se.');
    }

    public function logout()// odhlaseni a zruseni session
    {      
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Byl jste odhlášen.');
    }
}

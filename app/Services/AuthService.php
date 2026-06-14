<?php

namespace App\Services;

use App\Models\UserModel;

class AuthService
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }


    public function register($username, $password) //funkce na registraci
    {   //zahoshovani hesla
        $passwordHash = password_hash($password, PASSWORD_DEFAULT); 
        //vytvoreni uzivatele
        return $this->userModel->save([
            'username'      => $username,
            'password_hash' => $passwordHash,
        ]);
    }

    public function attemptLogin($username, $password) //prihlaseni
    {

        $user = $this->userModel->where('username', $username)->first();


        if (! $user) {
            return false;
        }

        if (! isset($user->password_hash)) {
            return false;
        }

        //pokud je heslo stejne jako v databazi tak je prihlaseni uspesne a ulozi se do sessionu
        if (password_verify($password, $user->password_hash)) {

            session()->set([
                'userId'     => $user->id,
                'username'   => $user->username,
                'isLoggedIn' => true,
            ]);

            return true;
        }
        return false;
    }
}

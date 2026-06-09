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


    public function register($username, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        return $this->userModel->save([
            'username'      => $username,
            'password_hash' => $passwordHash,
        ]);
    }

    public function attemptLogin($username, $password)
    {
       
        $user = $this->userModel->where('username', $username)->first();

        
        if ($user && password_verify($password, $user['password_hash'])) {
            
            session()->set([
                'userId'     => $user['id'],
                'username'   => $user['username'],
                'isLoggedIn' => true,
            ]);

            return true; 
        }

       
        return false;
    }
}

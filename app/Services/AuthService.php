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


    public function register($username, $password){


    }

    public function attemptLogin($username, $password){


    }
   
}
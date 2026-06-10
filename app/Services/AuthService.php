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
        // 1. Najdeme uživatele v databázi
        $user = $this->userModel->where('username', $username)->first();

        // Ochrana: Pokud uživatel v databázi vůbec NEEXISTUJE (je null), okamžitě končíme
        if (! $user) {
            return false;
        }

        // Ochrana 2: Pro jistotu ověříme, že objekt má vůbec vlastnost password_hash
        if (! isset($user->password_hash)) {
            return false;
        }

        // 2. Teprve když víme, že uživatel existuje, ověříme jeho heslo
        if (password_verify($password, $user->password_hash)) {

            // Přihlášení je úspěšné, uložíme do session
            session()->set([
                'userId'     => $user->id,
                'username'   => $user->username,
                'isLoggedIn' => true,
            ]);

            return true;
        }

        // Heslo nesouhlasí
        return false;
    }
}

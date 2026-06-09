<?php

namespace Config;

class AuthValidation
{
    public array $registration = [
        'username' => [
            'rules'  => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
            'errors' => [
                'required'   => 'Uživatelské jméno je povinné.',
                'min_length' => 'Jméno musí mít aspoň 3 znaky.',
                'is_unique'  => 'Tohle uživatelské jméno už je obsazené.'
            ]
        ],
        'password' => [
            'rules'  => 'required|min_length[6]',
            'errors' => [
                'required'   => 'Heslo je povinné.',
                'min_length' => 'Heslo musí mít aspoň 6 znaků.'
            ]
        ],
        'password_confirm' => [
            'rules'  => 'required|matches[password]',
            'errors' => [
                'required' => 'Potvrzení hesla je povinné.',
                'matches'  => 'Hesla se neshodují.'
            ]
        ]
    ];

    public array $login = [
        'username' =>[
            'rules'  => 'required',
            'errors' => [
                'required' => 'Uživatelské jméno je povinné.'
            ]
        ],
        'password' =>[
            'rules'  => 'required',
            'errors' => [
                'required' => 'Heslo je povinné.'
            ]
        ]

    ];
}
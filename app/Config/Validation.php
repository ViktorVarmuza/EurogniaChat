<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];


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
        'username' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Uživatelské jméno je povinné.'
            ]
        ],
        'password' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Heslo je povinné.'
            ]
        ]

    ];
    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}

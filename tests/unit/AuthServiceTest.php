<?php

namespace Tests\App\Services;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Services\AuthService;

final class AuthServiceTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate   = true;
    protected $namespace = 'App';
    protected $seed      = \Tests\Support\Database\Seeds\TestChatSeeder::class;

    public function testRegisterCreatesUser()
    {
        $service = new AuthService();

        $username = 'newuser';
        $password = 'pass1234';

        $result = $service->register($username, $password);

        $this->assertTrue($result);

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('username', $username)->first();

        $this->assertNotNull($user);

        // OPRAVENO: Nyní správně kontrolujeme sloupec password_hash v objektu
        $this->assertTrue(password_verify($password, $user->password_hash));
    }

    public function testAttemptLoginWithSeededUser()
    {
        $session = service('session');
        $service = new AuthService();

        
        $db = \Config\Database::connect();
        $db->table('users')->insert([
            'username'      => 'testuser_auth',
            'password_hash' => password_hash('heslo123', PASSWORD_DEFAULT), 
        ]);


       
        $ok = $service->attemptLogin('testuser_auth', 'heslo123');

        $this->assertTrue($ok, 'AuthService::attemptLogin vrátil false místo true.');
        $this->assertTrue(session()->get('isLoggedIn') === true);
        $this->assertEquals('testuser_auth', session()->get('username'));
    }
}

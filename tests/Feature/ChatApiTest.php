<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

final class ChatApiTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use DatabaseTestTrait;


    protected $migrate = true;
    protected $namespace = 'App';
    protected $seed = \Tests\Support\Database\Seeds\TestChatSeeder::class;

    public function testGetMessagesEndpointReturnsJson()
    {
        $result = $this->get('api/messages');

        $result->assertStatus(200);

        $result->assertHeaderPresent('Content-Type');

        $data = json_decode($result->getBody(), true);

        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('username', $data[0]);
    }

    public function testPostMessageCreatesMessage()
    {
       
        $this->withSession([
            'isLoggedIn' => true,
            'userId'     => 1
        ]);

        $post = ['content' => 'Integration test message'];

        
        $result = $this->post('api/send', $post);

        
        $result->assertStatus(201);

        $data = json_decode($result->getBody(), true);

        $this->assertArrayHasKey('id', $data);
        $this->assertEquals($post['content'], $data['content']);
    }
}

<?php

namespace Tests\App\Models; // Nezapomeň na správný namespace, pokud ho nemáš

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\MessageModel;

final class MessageModelTest extends CIUnitTestCase // kontrola pro zpravy
{
    use DatabaseTestTrait;

    
    protected $migrate = true;
    protected $namespace = 'App';
    protected $seed = \Tests\Support\Database\Seeds\TestChatSeeder::class;

    public function testGetMessagesWithUserReturnsMessages() // kontrola ziskavani zprav z modelu
    {
        $model = new MessageModel();
        $messages = $model->getMessagesWithUser();

        $this->assertIsArray($messages);
        $this->assertNotEmpty($messages);
        $this->assertObjectHasProperty('username', $messages[0]);
        $this->assertObjectHasProperty('content', $messages[0]);
    }

    public function testGetMessagesWithLastIdFilters() //kontrola ziskavni zprav od urciteho id 
    {
        $model = new MessageModel();

        $all = $model->getMessagesWithUser();
        $this->assertCount(2, $all);

        $lastId = $all[0]->id;
        $filtered = $model->getMessagesWithUser($lastId);

        foreach ($filtered as $msg) {
            $this->assertGreaterThan($lastId, $msg->id);
        }
    }
}

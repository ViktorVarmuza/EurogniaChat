<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

use App\Services\MessageService;

class ApiController extends ResourceController
{
    protected $messageService;

    public function __construct()
    {
        $this->messageService = new MessageService();
    }

    public function index()
    {

        $lastId = $this->request->getGet('lastId');
        $lastId = $lastId !== null ? (int) $lastId : null;

        $userId = session()->get('userId');

        $messages = $this->messageService->getChatMessages($userId, $lastId);

        return $this->respond($messages);
    }


    public function create()
    {
        if (!$this->validate('message')) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $content = esc($this->request->getPost('content'));
        $userId =  session()->get('userId');

        $newMessage = $this->messageService->createMessage($userId, $content);


        if ($newMessage) {
            return $this->respondCreated($newMessage);
        }

        return $this->fail('Zprávu se nepodařilo uložit.', 500);
    }
}

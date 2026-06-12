<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Services\MessageService;


class ChatController extends BaseController
{

    protected $messageService;

    public function __construct()
    {
        $this->messageService = new MessageService();
    }


    public function show()
    {
        $messages = $this->messageService->getChatMessages(session()->get('userId'));

        return view('pages/room', [
            'messages' => $messages
        ]);
    }
}

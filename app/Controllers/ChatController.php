<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MessageModel;

class ChatController extends BaseController
{

    protected $messageModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
    }


    public function show(){

    
    }

    public function sendMessage(){

    }

    
}

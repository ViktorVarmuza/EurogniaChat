<?php

namespace App\Services;

use App\Models\MessageModel;

class MessageService
{
    protected $messageModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
    }



    public function getChatMessages($currentUserId, ?int $lastId = null) // ziskani zprav
    {

        $messages = $this->messageModel->getMessagesWithUser($lastId);

        //prevedeni dat z databaze i urceni jestli ji posílal prihlaseny uzivatel
        foreach ($messages as &$msg) {

            $msg->content = esc($msg->content);
            $msg->username = esc($msg->username);


            $msg->time = date('H:i', strtotime($msg->created_at));

            $msg->is_mine = ($msg->user_id == $currentUserId);
        }

        return $messages;
    }

    public function createMessage($userId,  $content) // vytvoreni zpravy
    {   
        
        $data = [
            'user_id' => $userId,
            'content' => $content
        ];
        // ulozeni zpravy a response
        if ($this->messageModel->insert($data)) {

            $insertId = $this->messageModel->getInsertID();

            return [
                'id'         => $insertId,
                'user_id'    => $userId,
                'content'    => $content,
                'created_at' => date('Y-m-d H:i:s'),
                'csrf_token' => csrf_hash()
            ];
        }
        return false;
    }
}

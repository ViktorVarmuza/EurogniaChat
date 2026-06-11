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

    public function getChatMessages(int $currentUserId)
    {
        $messages = $this->messageModel->getMessagesWithUser();

        foreach ($messages as $msg) {
            $msg->is_mine = ((int)$msg->user_id === $currentUserId);
        }

        return $messages;
    }
}

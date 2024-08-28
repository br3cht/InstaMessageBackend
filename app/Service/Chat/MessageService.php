<?php

namespace App\Service\Chat;

use App\DTO\Chat\ChatConversationInput;
use App\DTO\Chat\GetChatMessageInput;
use App\Models\Conversation;
use App\Models\Message;

class MessageService
{
    public function getMessage(GetChatMessageInput $getChatMessageInput)
    {
        return Message::whereHas('conversation', function ($q) use ($getChatMessageInput) {
            $q->where('sender_id', $getChatMessageInput->senderId)
                ->where('receiver_id', $getChatMessageInput->recieveId);
        })->orderBy('created_at', 'desc')->paginate(15,['*'],'page',$getChatMessageInput->page);
    }

    public function sendMessage(ChatConversationInput $chatConversationInput, Conversation $conversation)
    {
        Message::create([
            'conversation_id' => $conversation->id,
            'sended_by_id' => $chatConversationInput->senderId,
            'content' => $chatConversationInput->content,
        ]);
    }
}

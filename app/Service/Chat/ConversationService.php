<?php

namespace App\Service\Chat;

use App\DTO\Chat\ChatConversationInput;
use App\DTO\Chat\GetChatMessageInput;
use App\Models\Conversation;

class ConversationService
{
    public function getConversation(GetChatMessageInput $getChatMessageInput): Conversation
    {
        return Conversation::where('sender_id', $getChatMessageInput->senderId)
            ->where('receiver_id', $getChatMessageInput->recieveId)
            ->first();
    }

    public function start(ChatConversationInput $chatConversationInput): Conversation
    {
        $conversation = Conversation::create([
            'receiver_id' => $chatConversationInput->recieveId,
            'sender_id' => $chatConversationInput->senderId,
        ]);

        return $conversation;
    }

    public function conversationStarted(ChatConversationInput $chatConversationInput): bool
    {
        return Conversation::where('sender_id', $chatConversationInput->senderId)
            ->where('receiver_id', $chatConversationInput->recieveId)
            ->exists();
    }
}

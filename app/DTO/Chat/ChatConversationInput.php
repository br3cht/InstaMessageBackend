<?php

namespace App\DTO\Chat;

class ChatConversationInput
{
    public function __construct(
        public readonly int $senderId,
        public readonly int $recieveId,
        public readonly string $content,
    )
    { }
}

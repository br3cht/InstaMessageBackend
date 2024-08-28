<?php

namespace App\DTO\Chat;

class GetChatMessageInput
{
    public function __construct(
        public readonly int $senderId,
        public readonly int $recieveId,
        public readonly int $page
    )
    { }
}

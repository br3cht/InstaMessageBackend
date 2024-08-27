<?php

namespace App\DTO\User;

class GetUserInput
{
    public function __construct(
        public readonly int $page,
        public readonly string|null $name,
    ) { }
}

<?php

namespace App\DTO\User;

class StoreUserInput
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) { }
}

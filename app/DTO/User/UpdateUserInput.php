<?php

namespace App\DTO\User;

class UpdateUserInput
{
    public function __construct(
        public readonly string|null $name,
        public readonly string|null $email,
    )
    { }
}

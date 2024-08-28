<?php

namespace App\Service\User;

use App\DTO\User\GetUserInput;
use App\DTO\User\StoreUserInput;
use App\DTO\User\UpdateUserInput;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct()
    { }

    public function getUser(GetUserInput $getUserInput)
    {
        $query = User::query();

        if(!empty($getUserInput->name)){
            $query->where('name', 'like', '%'.$getUserInput->name.'%');
        }

        return $query->paginate(15, ['*'],'page', $getUserInput->page);
    }

    public function storeUser(StoreUserInput $storeUserInput)
    {
        User::create([
            'name' => $storeUserInput->name,
            'email' => $storeUserInput->email,
            'password' => Hash::make($storeUserInput->password)
        ]);
    }

    public function updateUser(UpdateUserInput $updateUserInput, User $user)
    {
        $user->update([
            'name' => $updateUserInput->name,
            'email' => $updateUserInput->email
        ]);
    }
}

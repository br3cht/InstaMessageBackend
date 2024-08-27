<?php

namespace App\Http\Controllers;

use App\DTO\User\GetUserInput;
use App\DTO\User\StoreUserInput;
use App\DTO\User\UpdateUserInput;
use App\Http\Requests\User\GetUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Service\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) { }

    public function index(GetUserRequest $request)
    {
        $dataRequest = $request->validated();
        $input = new GetUserInput(
            $dataRequest['page'],
            optional($dataRequest)['name']
        );

        $user = $this->userService->getUser($input);

        return UserResource::collection($user);
    }

    public function store(StoreUserRequest $request)
    {
        $dataRequest = $request->validated();
        $input = new StoreUserInput(
            $dataRequest['name'],
            $dataRequest['email'],
            $dataRequest['password'],
        );

        $this->userService->storeUser($input);

        return response()->json(['message' => 'Cadastrado com Sucesso']);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $dataRequest = $request->validated();
        $input = new UpdateUserInput(
            $dataRequest['name'],
            $dataRequest['email'],
        );

        $this->userService->updateUser($input, $user);

        return response()->json(['message' => 'Atualizado com Sucesso']);
    }
}

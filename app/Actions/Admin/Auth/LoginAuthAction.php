<?php

namespace App\Actions\Admin\Auth;

use App\Http\Requests\LoginRequest;
use App\Repository\AuthRepository;

class LoginAuthAction
{
    public function __construct(protected AuthRepository $authRepository) {}

    public function __invoke(LoginRequest $request)
    {
        return $this->authRepository->login($request->validated());
    }
}

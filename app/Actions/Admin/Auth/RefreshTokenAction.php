<?php

namespace App\Actions\Admin\Auth;

use App\Repository\AuthRepository;

class RefreshTokenAction
{
    public function __construct(protected AuthRepository $authRepository) {}

    public function __invoke()
    {
        return $this->authRepository->refreshToken();
    }
}

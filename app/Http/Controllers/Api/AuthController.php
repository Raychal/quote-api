<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthInterface;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RefreshRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authInterface;

    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    public function login(AuthRequest $request)
    {
        return $this->authInterface->login($request);
    }

    public function refresh(RefreshRequest $request)
    {
        return $this->authInterface->refresh($request);
    }

    public function logout()
    {
        return $this->authInterface->logout();
    }
}

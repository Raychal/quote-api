<?php

namespace App\Interfaces;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RefreshRequest;
use Illuminate\Http\Request;

interface AuthInterface
{
    public function register(AuthRequest $request);
    public function login(AuthRequest $request);
    public function logout();
    public function test();
    public function verify($id);
    public function refresh(RefreshRequest $request);
    // public function forgotApi(Request $request);
    // public function resetApi(Request $request);
}

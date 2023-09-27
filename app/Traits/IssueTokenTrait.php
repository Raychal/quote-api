<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

trait IssueTokenTrait
{
    public function issueToken(Request $request, $grantType, $scope = "*")
    {
        request()->request->add([
            'grant_type' => $grantType,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => $scope
            ]);

        $request = Request::create(config('app.url') . '/oauth/token', 'POST');

        $response = Route::dispatch($request);
        return json_decode($response->getContent(), true);
    }
}

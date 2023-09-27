<?php

namespace App\Repositories;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RefreshRequest;
use App\Interfaces\AuthInterface;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseAPI;
use App\Traits\IssueTokenTrait;
use Laravel\Passport\Client;
use App\Models\User;
use App\Mail\EmailVerification;
use App\Traits\ResponseMessage;
use stdClass;

class AuthRepository implements AuthInterface
{
    use ResponseAPI;
    use IssueTokenTrait;
    use ResponseMessage;
    use ValidatesRequests;

    private $client;

    public function __construct()
    {
        $this->client = Client::find(config('custom.client_id'));
    }

    public function login(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->error("invalid User login", 401);
        }

        if (!$user->email_verified_at) {
            return $this->error("Verify your email", 401);
        }

        $role = $user->getRoleNames();

        $objUser = new stdClass();
        $objUser->id = $user->id;
        $objUser->email = $user->email;
        $objUser->role = $role[0];

        $resp = $this->issueToken($request, 'password');

        $objUser->access_token = $resp['access_token'];
        $objUser->refresh_token = $resp['refresh_token'];

        return $this->success('Login berhasil', $objUser);
    }

    public function refresh(RefreshRequest $request)
    {
        $refresh = $this->issueToken($request, 'refresh_token');
        if (array_key_exists('error', $refresh)) {
            return $this->errorMessage($refresh['message']);
        }
        return $this->successMessage('Proses refresh token berhasil', $refresh);
    }

    public function test()
    {
        try {
            $data = User::all();
            return $this->success('Ok', $data);
        } catch (\Exception $e) {
            return $this->errorMessage($e->getMessage());
        }
    }

    public function logout()
    {
        try {
            // $token = Auth::user()->token();

            // if (!$token) {
            //     return $this->errorMessage('Token tidak ditemukan', 404);
            // }

            // $token->revoke();
            return $this->successMessage('Logout berhasil', null);
        } catch (\Exception $e) {
            return $this->errorMessage($e->getMessage());
        }
    }

    public function register(AuthRequest $request)
    {
        try {
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $user->assignRole('user');
            Mail::to($user->email)->send(new EmailVerification($user));
            return $this->success('Please, check email', null);
        } catch(\Illuminate\Database\QueryException $e) {
            return $this->error($e->getMessage(), 500);
        } catch(\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function verify($id)
    {
        $getId = Crypt::decrypt($id);
        $user = User::where('id', $getId)->first();

        if (!$user) {
            $message = 'Email verification fails!!!';
            $status = 0;
        } else {
            if ($user->email_verified_at) {
                $message = 'Email already verified!!!';
                $status = 0;
            }
            $message = 'Email has been successfully verified!!!';
            $status = 1;
            $user->markEmailAsVerified();
            $url = config('custom.site_url');
            $path = "/login";
            $param = "?message={$message}";
            $paramStatus = "&status={$status}";
            return redirect($url . $path . $param . $paramStatus);
        }
    }
}

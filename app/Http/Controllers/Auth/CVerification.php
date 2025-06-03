<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Traits\RedirectUsers;
use App\Traits\ResponseOutput;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Auth\Access\AuthorizationException;


class CVerification extends Controller
{

    protected $authRepository;
    protected $redirectTo = '/dashboard ';
    use RedirectUsers, ResponseOutput;


    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('signed', only: ['verify']),
            new Middleware('throttle:6,1', only: ['verify', 'resend']),
        ];
    }

    public function show(Request $request)
    {
        $title = __("Verify Account");
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('auth.verify', compact('title'));
    }

    public function verify(Request $request)
    {
        try {
            $result =  $this->authRepository->verifyEmail($request);
            if ($result) {
                if (!Auth::check()) {
                    Auth::loginUsingId($result['userId']);
                }
                return redirect($this->redirectPath());
            }
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'Unauthorized'], 403);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }


    public function resend(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $result = $this->authRepository->resendVerificationLink($request);
            if ($result) {
                return $result;
            }

            return $this->responseSuccess(['message' => $result['message']]);
        });
    }
}

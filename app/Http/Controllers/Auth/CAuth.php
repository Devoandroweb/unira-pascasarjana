<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Traits\RedirectUsers;
use App\Traits\ResponseOutput;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class CAuth extends Controller
{
    use ResponseOutput, RedirectUsers;
    protected $authRepository;
    protected $redirectTo = '/dashboard';
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function index()
    {
        $title = __("Login");
        return view("auth.login", compact("title"));
    }
    public function auth(AuthRequest $request)
    {
        try {
            $auth = $this->authRepository->auth($request);
            if ($auth) {
                return $request->wantsJson()
                    ? $this->responseSuccess(["message" => __('Log In Success, Wait a Moment'), "redirect" => $this->redirectPath()], 200)
                    : redirect()->intended($this->redirectPath());
            }

            throw ValidationException::withMessages([
                'username' => [__('auth.failed')],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed !!',
                'data' => [
                    'error' => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

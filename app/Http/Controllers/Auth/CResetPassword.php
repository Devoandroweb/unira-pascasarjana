<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Traits\ResponseOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Repositories\Auth\AuthRepository;
use App\Traits\RedirectUsers;
use Illuminate\Validation\ValidationException;

class CResetPassword extends Controller
{
    protected $authRepository;
    protected $redirectTo = '/dashboard';
    use ResponseOutput, RedirectUsers;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function index()
    {
        $title = __("Reset Password");
        return view('auth.passwords.email', compact('title'));
    }

    public function sendResetLink(Request $request)
    {

        $request->validate(['email' => 'required|email']);
        try {
            $result = $this->authRepository->sendResetLink($request->input('email'));

            if ($result['status']) {
                return $this->responseSuccess(['message' => $result['message']]);
            }

            throw new \Exception($result['message']);
        } catch (ValidationException $e) {
            return response()->json(['data' => $e->errors()], 422);
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }

    public function showResetForm(Request $request)
    {
        $title = __("Reset Password");
        $token = $request->route()->parameter('token');
        return view('auth.passwords.reset', compact('title', 'token'));
    }

    public function update(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        try {
            $result = $this->authRepository->changePassword($data);

            if ($result['status']) {
                return $this->responseSuccess(['message' => $result['message'], 'redirect' => $this->redirectPath()]);
            }

            throw new \Exception($result['message']);
        } catch (ValidationException $e) {
            return response()->json(['data' => $e->errors()], 422);
        } catch (\Exception $e) {
            return $this->responseFailed($e->getMessage());
        }
    }
}

<?php

namespace App\Repositories\Auth;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\RedirectUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Notifications\RegisterUserNotification;
use Illuminate\Auth\Access\AuthorizationException;
use LaravelEasyRepository\Implementations\Eloquent;

class AuthRepositoryImplement extends Eloquent implements AuthRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    use RedirectUsers;
    protected $model;



    public function auth($request)
    {
        try {
            $credentials = $request->validated();
            $fieldType = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            if (Auth::attempt([$fieldType => $credentials['username'], 'password' => $credentials['password']], $request->filled('remember'))) {
                $request->session()->regenerate();
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function sendResetLink($email)
    {
        try {
            $status = Password::sendResetLink(['email' => $email]);

            if ($status === Password::RESET_LINK_SENT) {
                return ['status' => true, 'message' => __($status)];
            }

            return ['status' => false, 'message' => __($status)];
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function changePassword($data)
    {
        try {
            $status = Password::reset(
                $data,
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    $user->save();
                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return ['status' => true, 'message' => __($status)];
            }

            return ['status' => false, 'message' => __($status)];
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function verifyEmail($request)
    {
        $user = User::find($request->route('id'));
        if (!hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            throw new AuthorizationException;
        }

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return ['status' => true, 'json_response' => new JsonResponse([], 204)];
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return ['status' => true, 'userId' => $user->id,  'json_response' => new JsonResponse([], 204)];
    }
    public function resendVerificationLink($request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return ['status' => true, 'json_response' => new JsonResponse([], 204)];
        }

        $request->user()->sendEmailVerificationNotification();

        return ['status' => true, 'message' => __('A fresh verification link has been sent to your email address.')];
    }

    public function register($data)
    {
        $password = Str::random(10);
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'role' => $data['role'],
            'password' =>    $password,
        ];
        $existingUser = User::where('email', $data['email'])->first();
        if (request()->hasFile('photo')) {
            if ($existingUser && $existingUser->photo) {
                Storage::disk('public')->delete($existingUser->photo);
            }
            $filePath = request()->file('photo')->store('images/users', 'public');
            $userData['photo'] = $filePath;
        }
        $user = User::updateOrCreate(
            ['email' => $data['email']],
            $userData
        );
        if (!$existingUser) {
            $user->notify(new RegisterUserNotification($user, $password));
        }

        return $user;
    }
}

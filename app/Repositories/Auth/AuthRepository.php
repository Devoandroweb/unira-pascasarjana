<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface AuthRepository extends Repository{

   public function auth($request);
   public function sendResetLink($email);
   public function changePassword($data);
   public function verifyEmail($request);
   public function resendVerificationLink($request);
   public function register($data);
}

<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
  
    /**
     * Create a new policy instance.
     */
   

    public function admin(User $user)
    {
        return $user->role == 'admin';
    }
    public function author(User $user)
    {
        return $user->role == 'author';
    }
}

<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CinemaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function isAdmin(User $user)
    {
      if($user->roles == 'admin') {
        return true;
      }
      else {
        return false;
      }
    }
}

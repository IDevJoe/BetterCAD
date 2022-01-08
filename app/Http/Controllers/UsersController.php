<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function get()
    {
        return User::get();
    }

    public function getUser(User $user)
    {
        return $user;
    }
}

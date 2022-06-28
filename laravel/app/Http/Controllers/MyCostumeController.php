<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Costume;
class MyCostumeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return $user->costumes()->get();
    }

    public function attachAllCostumesIntoAllUsers()
    {
        $users = User::with("costumes")->get();
        $costumes = Costume::get();
        foreach ($costumes as $costume) {
            foreach ($users as $user) {
                if (!$user->costumes || !$user->costumes->count()) {
                    $user->costumes()->attach($costume->id);
                }
            }
        }

        return [
            "users" => User::with("costumes")->get(),
            "costumes" => $costumes,
        ];
    }
}

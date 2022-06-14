<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DustBox;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;

class SessionController extends Controller
{
    /**
     * セッション開始
     */
    public function store($dustBoxId)
    {
        $dustBox = DustBox::findOrFail($dustBoxId);
        return $this->createSessionWhenAuth(Auth::user(), $dustBox);
    }

    private function createSessionWhenAuth(User $user, DustBox $box)
    {
        $session = new Session();
        $session->user_id = $user->id;

        return $box->sessions()->create([
            "user_id" => $user->id,
            "completed_at" => new Carbon(config('app.completed_at', '+3 minutes')),
        ]);
    }
}

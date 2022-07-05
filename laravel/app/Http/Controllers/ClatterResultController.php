<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DustBox;
use App\Models\Session;
use App\Models\User;

class ClatterResultController extends Controller
{
    public function index($dustBoxId, $sessionId, Request $request)
    {
        $user = Auth::user();
        $session = Session::where('dust_box_id', $dustBoxId)
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->firstOrFail();
        return $session->clatterResults()->get();
    }
}

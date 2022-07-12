<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DustBox;
use App\Models\Session;
use App\Models\User;
use App\Models\Costume;
use App\Models\ClatterResult;
use App\Events\ThrowEvent;

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
            "completed_at" => new Carbon(config("app.completed_at", "+3 minutes")),
        ]);
    }

    // ゴミを入れた時の処理
    public function pushes(Request $request)
    {
        // トークン取得
        $token = $request->input("token");
        $dust_box = DustBox::where("token", $token)->firstOrFail();

        $session = $dust_box
            ->sessions()
            ->latest()
            ->firstOrFail();
        $completed_at = new Carbon($session->completed_at);

        // ガチャを引く
        $clatter = Costume::clatter();
        // ガチャ結果がハズレなら
        if (!$clatter) {
            $result = ClatterResult::create([
                "session_id" => $session->id,
                "earn_exp" => config("app.clatter_earn_exp", 10),
            ]);
            // Userのexpに追加
            $user = $session->user;
            $user->exp += $result->earn_exp;
            $user->save();
        } else {
            $result = ClatterResult::create([
                "session_id" => $session->id,
                "costume_id" => $clatter->id,
            ]);
            // Mycostumeに追加
            $user = $session->user;
            $user->costumes()->create([
                "user_id" => $user->id,
                "costume_id" => $clatter->id,
            ]);
        }

        // イベントを発火する
        event(new ThrowEvent($dust_box, $session));
        return [$session, $result];
    }

    // セッション終了させる
    public function complete($dustBoxId, $sessionId)
    {
        $dustBox = DustBox::findOrFail($dustBoxId);
        $session = $dustBox->sessions()->findOrFail($sessionId);
        $session->completed_at = Carbon::now();
        $session->save();

        $result = ClatterResult::where("session_id", $session->id)->get();
        return $result;
    }
}

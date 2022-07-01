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

        $session = $dust_box->sessions()->first();
        $completed_at = new Carbon($session->completed_at);
        $user_id = Auth::user()->id;

        // ガチャを引く
        $clatter = Costume::clatter();
        // ガチャ結果がハズレなら
        if (!$clatter) {
            $result = ["earn_exp" => config("app.clatter_earn_exp", 10)];
        // デバックしにくいのでコメントアウト
        // 時間以内でかつuser_idが一致しているか
        // }elseif($completed_at->gte(new Carbon('now')) && $session->user_id == $user_id){
        } elseif ($session->user_id == $user_id) {
            $result = ClatterResult::create([
                "session_id" => $session->id,
                "user_id" => $user_id,
                "costume_id" => $clatter->id,
            ]);
        }

        // イベントを発火する
        event(
            new ThrowEvent($dust_box,$session)
        );
        return [$session, $result];
    }

    // セッション終了させる
    public function complete($dustBoxId, $sessionId)
    {
        $dustBox = DustBox::findOrFail($dustBoxId);
        $session = $dustBox->sessions()->findOrFail($sessionId);
        $session->completed_at = new Carbon("0000-00-00 00:00:00");
        $session->save();

        $result = ClatterResult::where("session_id", $session->id)->get();
        return response($result, 204);
    }
}

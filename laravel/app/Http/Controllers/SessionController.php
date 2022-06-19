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
    
    // public function pushes(Request $request)
    public function pushes()
    {
        // $token = $request->input("token");
        $token = 'hoge';
        $dust_box = DustBox::where('token', $token)->firstOrFail();

        $session = $dust_box->sessions()->first();
        $completed_at = new Carbon($session->completed_at);
        $user_id = Auth::user()->id;
        $clatter = Costume::clatter();

        // ガチャ結果が経験値なら やべーじっそーだな（小並感）
        if(isset($clatter['earn_exp'])){
            $result = $clatter;
        // 時間以内でかつuser_idが一致しているか
        // }elseif($completed_at->gte(new Carbon('now')) && $session->user_id == $user_id){
        }elseif($session->user_id == $user_id){
            $result = ClatterResult::create(['user_id' => $user_id, 'costume_id' => $clatter->id]);
        }

        return [$session, $result];
    }
}

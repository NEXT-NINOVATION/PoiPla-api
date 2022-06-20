<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Costume;
use App\Models\Rarity;

class CostumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function clatter()
    {
        $rarities = Rarity::orderBy('rate', 'asc')->get();
        $random = random_int(1, 100);
        // $random = random_int(1, ($rarities->sum("rate") * 100));

        $sum = 0;
        foreach ($rarities as $key => $rarity) {
            $per = ($rarity->rate * 100);
            $sum = $sum + $per;
            if ($random < $sum) {
                return [$rarity, $random];
                break;
            }
        }

        return ['earn_exp' => config("app.clatter_earn_exp", 10)];
    }
}

<?php

namespace App\Http\Controllers;

use App\GameList;
use App\Mail\OrderCard;
use App\Models\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class GameController extends Controller
{
    public function about()
    {
        $categories = \App\CategoryList::all();
        $game_lists = GameList::all();
        return view('game-shop/about',['categories'=>$categories]);
    }


    public function news()
    {
        $categories = \App\CategoryList::all();
        $game_lists = GameList::all();
        return view('game-shop/news',['categories'=>$categories]);
    }

    public function categoryList()
    {
        $categories = \App\CategoryList::all();
        $game_lists = GameList::all();
        return view('game-shop/index',['categories'=>$categories, 'game_lists'=>$game_lists]);
    }

    public function categoryAction()
    {
        $url = basename($_SERVER['REQUEST_URI']);
        $categories = \App\CategoryList::all();
        $game_lists  = GameList::all()->where('category','==', $url);
        return view('game-shop/categoryAction', ['game_lists'=>$game_lists, 'categoryNow'=>$url,  'categories'=>$categories]);
    }

    public static function getUrlCategory()
    {
        $result = last(request()->segments());
        return $result;
    }

    public function cart(Request $request)
    {
        $categories = \App\CategoryList::all();
        $params = GameList::all()->where('id','==',$request->gameId);
        foreach ($params as $param)
        {
            $result = $param;
        }
        return view('game-shop/cart', ['gameInfo'=>$result, 'categories'=>$categories]);
    }

    public function buy(Request $request)
    {
        $categories = \App\CategoryList::all();
        return view('game-shop/buy', ['game_id'=>$request->game_id, 'categories'=>$categories]);
    }


}


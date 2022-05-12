<?php

namespace App\Http\Controllers;

use App\GameList;
use App\Mail\OrderCard;
use App\Models\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class FormSend extends Controller
{

    public function store(Request $request)
    {
        $name = $request->input('game_id');
        var_dump($name);

        //
    }
    public function getForm(Request $request)
    {

        $array['name'] = $_POST['name_form'];
        $array['id'] = Auth::user()->id;
        $array['game_id'] = $request->game_id;
        $results = User::all()->where('id','==',  $array['id']);
        foreach ($results as $result)
        {
            $array['email'] = $result['email'];
        }
        $params = GameList::all()->where('id','==', $request->game_id);
        foreach ($params as $param)
        {
            $array['game_name'] = $param['name'];
        }


        DB::connection();
        DB::table('orders')->insert(['game_name'=>$array['game_name'], 'user_id'=>$array['id'], 'user_email'=>$array['email'], 'user_name'=>$array['name'], 'game_id'=>$array['game_id']]);

        $user_email = User::all('email')->where('role_id','==',1);
        $string = 'ваша заявка отправлена!';

        Mail::to($user_email)->send(new OrderCard(['results'=>$results, 'array'=>$array]));
        return redirect('/',$string);
    }
}

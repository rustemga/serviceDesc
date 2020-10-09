<?php

namespace App\Http\Controllers;

use App\Department;
use App\Tickets;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

//        $tickets = Tickets::first()->author();
//        dd($tickets);

        $user = Auth::user();//Возвращает текущего юзера
        $tickets = Tickets::all();//возвращает массив
        $tickets2 = Tickets::get();//возвращает массив
        $tickets3 = DB::table('tickets')->get();
        $allUsers = User::all();

        //dd($tickets->forPage(3, 5));
//        dd($user->tickets()->paginate(4));
        /**
         * Тестовое подключение к другой базе данных
         * Необходима нстройка подключения тут config/database.php
         */
        $test = DB::connection('mysql2')->table('articles')->select('title as article_name')->get();



        if(isAdmin()){
            return view('adminhome',[
                'tickets' => $user->tickets()->paginate(4),
                'user'=>$user,
                'allUsers'=>$allUsers
                ]);
        }else{
            return view('home',[
                'tickets' => $user->tickets()->paginate(4),
                'user'=>$user,
                'allUsers'=>$allUsers
            ]);
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Schema\Builder;


class UserController extends Controller
{
    public function show($user)
    {
        $profileUser = User::where('name', $user)->first();
        return view('userProfile', ['user' => $profileUser]);
    }

    public function following(User $followingUserId)
    {
        current_user()->toggleFollow($followingUserId);
        return back();
    }

    public function createTable()
    {
        if (!Schema::hasTable('note' . current_user()->id)) {
            Schema::create('note' . current_user()->id, function ($table) {
                $table->bigIncrements('id');
                $table->string('note');
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            });
        }else{
            $connection = DB::table('note' . current_user()->id);
            $connection->insert(
                ['note'=>'test']);
        }
        return redirect('home');
    }
}

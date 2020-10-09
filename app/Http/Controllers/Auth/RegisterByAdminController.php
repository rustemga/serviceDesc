<?php

namespace App\Http\Controllers\Auth;

use App\Department;
use App\Mail\RegistrationSucessfully;
use App\User;
use http\Env;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterByAdminController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        $dep = Department::get();
        if(request()->user()->role === 'admin'){
            return view('auth\registerByAdmin',['departmets'=>$dep]);
        }else{
            return redirect(route('home'));
        }

    }

//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
//        ]);
//    }
    protected $redirectTo = '/home';

//    public function store(array $data){
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//            'role' => 'user',
//        ]);
//    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'=>['required', 'string'],
            'department'=>['required', 'string'],
        ]);

        $user = new User();
        $user-> name = $request->input('name');
        $user-> email = $request->input('email');
        $user-> password = Hash::make($request->input('password'));
        $user-> role = $request->input('role');
        $user-> department_id = $request->input('department');
        $user->save();

        $dep = Department::where('id', $request->input('department'))->firstOrFail();

        Mail::to(request('email'))->send(new RegistrationSucessfully($request->input('name'), $request->input('role'), $dep->department));
        Mail::to(auth()->user()->email)->send(new RegistrationSucessfully($request->input('name'), $request->input('role'), $dep->department, 'admin'));

//        Mail::raw('New user was added', function ($message){
//            $message->to(request('email'))->subject('Registration');
//        });
//
//        Mail::raw('New user was added', function ($message){
//            $message->to(auth()->user()->email)->subject('Registration');
//        });

        return redirect('\home')->with('succes', 'New '. $request->input('role').' sucessfully added.');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Session;
use cookies;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = session('users');
        $data['email'] = $user['email'];
        return view('site.index', $data);
    }

    

    public function list()
    {  
        $users = DB::table('users')->get();
        $count = DB::table('users')->count();
        $data = [];
        foreach ($users as $key => $user) {
            $data[] = $user;
        }
        return response([
            'metas'=> [],
            'totalCount'=> $count,
            'totalPages'=> 1,
            'cursor'=> [
                'offset'=> 0,
                'limit'=> 10
            ],
            'data'=> $data, 
        ], 200);
    }

    public function store(Request $request)
    {
     $user = new User;
     $user->username = $request->username;
     $hashed = Hash::make($request->password, [
        'rounds' => 12
     ]);
     $user->password = $hashed;
     $user->email = $request->email;
     $user->save();
    }

    public function login()
    {

        return view('site.login');
    }

    public function logout(Request $request)
    {
      $request->session()->forget('users');

      return redirect(url('/login'));
    }

    public function doLogin(Request $request)
    {
        $data = DB::table('users')
            ->where(['name'=> $request->username])
            ->first();
        // dd($request->password);
        if (Hash::check($request->password, $data->password)) {
          
          $data = (array)$data;
          $user = session::put(['users'=>$data]);
          
          return response(['data'=>$data], 200);
        } else {
          return response(['message'=> 'Username and password did not match']);
        }
    }
}

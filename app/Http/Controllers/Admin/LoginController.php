<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin/login');
    }

    public function login(Request $req)
    {
        $email = $req->input('email');
        $password = $req->input('password');
        $data = User::where('email', $email)->first();
        if ($data != null) {
            if (Hash::check($password, $data->password)) {
                Session::put('id', $data->id);
                Session::put('name', $data->name);
                Session::put('email', $data->email);
                Session::put('role_id', $data->role_id);
                return redirect('/dashboard');
            } else if($data->role_id == 1){
                Session::flash('message', 'denied');
                return redirect('/');
            }else {
                Session::flash('message', 'login2');
                return redirect('/');
            }
        } else {
            Session::flash('message', 'login1');
            return redirect('/');
        }
    }


    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
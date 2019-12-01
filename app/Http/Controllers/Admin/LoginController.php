<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected function adminRole()
    {
        if(Auth::check()){
            return Auth::user()->role === 'admin';
        }
    }
    protected function userRole()
    {
        if(Auth::check()){
            return Auth::user()->role === 'user';
        }
    }

    public function getLogin()
    {
        if($this->adminRole()){
            return redirect()->route('admin.dashboard');
        }
        else if($this->userRole()){
            return redirect()->route('homepage');
        }
        else{
            return view('admin.auth.login');
        }
    }

    public function findUsername()
    {
        $login = request()->input('username');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }
    public function postLogin(Request $request)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $this->validate($request, [
            'username' => ($fieldType == 'email') ? 'required|email' : 'required',
            'password' => 'required'
        ]);
        $remember_me = $request->has('remember') ? true : false;

        if (Auth::attempt([($fieldType == 'email') ? 'email' : 'username' => $request->username, 'password' => $request->password, 'role' => 'admin'],$remember_me)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('homepage');
    }
    public function logout()
    {
        if ($this->adminRole()) {
            Auth::logout();
        }
        return redirect('/admin/login');
    }
}

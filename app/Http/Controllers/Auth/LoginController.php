<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Admin;

class LoginController extends Controller
{

    use AuthenticatesUsers;
 
    
    protected $redirectTo = '/home';

    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login', ['url' => 'admin']);
    }
    
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required|min:8'
        ]);
        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            $user = auth()->guard('admin')->user();
            return redirect()->intended('/home/admin');
        }
        // return back()->withInput($request->only('username', 'remember'))->with('error', 'Username atau katasandi salah!');
        return redirect('admin')->with('error', 'Username atau katasandi salah!');
    }

   


}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User as User;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        logout as performLogout;
    }

    protected $redirectTo = '/';

    public function redirectTo() {
        $role = Auth::user()->userSobat->role;

        $tahun = Carbon::now()->format('Y');
        $bulan = Carbon::now()->format('m');
        
        switch ($role) {
            case '1':
                $this->redirectTo = 'dashboard/'.$tahun.'/'.$bulan.'';
                return $this->redirectTo;
                break;

            case '2':
                $this->redirectTo = 'dashboard/'.$tahun.'/'.$bulan.'';
                return $this->redirectTo;
                break;

            case '3':
                $this->redirectTo = 'dashboard/'.$tahun.'/'.$bulan.'';
                return $this->redirectTo;
                break;
                
            case '9':
                $this->redirectTo = 'dashboard/'.$tahun.'/'.$bulan.'';
                return $this->redirectTo;
                break; 
    
            default:
                return route('login'); 
                break;
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where([
            'username' => $request->username,
            'password' => $request->password,
        ])->first();

        if ($user) {
            $this->guard()->login($user, $request->has('remember'));
            return true;
        }

        return false;
    }

    public function username(){
        return 'username';
    }

    public function logout(Request $request){
        $this->performLogout($request);
        return redirect('login');
    }
}

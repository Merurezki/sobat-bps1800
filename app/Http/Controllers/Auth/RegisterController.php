<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function redirectTo() {
        $role = Auth::user()->userSobat->role; 

        $tahun = \Carbon\Carbon::now()->format('Y');
        $bulan = \Carbon\Carbon::now()->format('m');
        
            switch ($role) {
                case '1':
                    return redirect('dashboard/'.$tahun.'/'.$bulan.'');
                    break;

                case '2':
                    return redirect('dashboard/'.$tahun.'/'.$bulan.'');
                    break;

                case '3':
                    return redirect('dashboard/'.$tahun.'/'.$bulan.'');
                    break;
                 
                case '9':
                    return redirect('dashboard/'.$tahun.'/'.$bulan.'');
                    break; 
        
                default:
                    return route('login'); 
                    break;
            }
      }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id' => ['required', 'numeric', 'digits:4'],
            // 'nama' => ['required', 'string', 'max:255'],
            // 'username' => ['required', 'string', 'max:255', 'unique:users'],
            'role' => ['required', 'numeric', 'digits:1'],
            'ruang' => ['required', 'numeric', 'digits:3'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'id' => $data['id'],
            // 'nama' => $data['nama'],
            // 'username' => $data['username'],
            'role' => $data['role'],
            'ruang' => $data['ruang'],
            // 'password' => Hash::make($data['password']),
        ]);
    }
}

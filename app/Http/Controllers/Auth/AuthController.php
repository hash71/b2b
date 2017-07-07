<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Category;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */


    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $loginPath = '/auth/login';
    protected $redirectPath = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function getRegister()
    {
        $categories = Category::where('level', '1')->get();
        return view('publicview.register', compact('categories'));
    }

    public function postRegister(Request $request)
    {
        //$this->validate($request, ['g-recaptcha-response' => 'required|captcha']);
        $input = \Request::all();

        $email = $input['email'];

        $exists = User::where('email',$email)->first();

        if($exists)
        {
          return redirect()->back()->with('error','Email already used');
        }


        $input['password'] = bcrypt($input['password']);
        $input['approved'] = 0;
        $input['gold_supplier'] = 0;
        $input['premium_gold_supplier'] = 0;
        $input['paid_member'] = 0;
        unset($input['passwordConfirm']);
        //unset($input['g-recaptcha-response']);
        User::unguard();
        User::create($input);
        User::reguard();
        return redirect('auth/register-success');
    }

    public function getLogin()
    {
        return view('publicview.login');
    }

    public function getRegisterSuccess()
    {
        return view('publicview.register-success');
    }
}

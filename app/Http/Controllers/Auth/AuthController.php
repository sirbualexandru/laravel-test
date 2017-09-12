<?php

namespace App\Http\Controllers\Auth;

use DB;
use Hash;
use Auth;
use Exception;
use URL;
use Validator;
use App\Exceptions\PermissionException;
use App\Exceptions\AuthenticationException;
use App\Models\User;
use Illuminate\Http\Request;
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
			'first_name' => 'required|max:255',
			'last_name'  => 'required|max:255',
			'email'      => 'required|email|max:255|unique:users',
            'address'    => 'required|max:255',
            'phone'      => 'required|max:20',
            'role'       => 'required',
			'password'   => 'required|min:6'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    public function register(Request $request)
    {
        $input = $request->all();

        if ($this->validator($input)->fails()) {
            throw new AuthenticationException($this->validator($input)->getMessageBag());
        }

        DB::transaction(function() use ($input) {
            $input['password'] = \Illuminate\Support\Facades\Hash::make($input['password']);
            $user = User::create($input);
            $user->status = User::USER_STATUS_ACTIVE;
            $user->save();
            $user->attachRole($input['role']);
        });

        return response()->view('message.success', [
            'message'  => 'You have been successfully registered',
            'redirect' => '/login'
        ]);
    }


	public function login(Request $request)
    {
        try {
            // Receive request data
            $data  = $request->only('email', 'password');

            // Authenticate
            if (!Auth::attempt($data, $request->has('remember'))) {
                throw new AuthenticationException('Incorrect password or email. Please, try again.');
            }

            // Check for permissions
            $user = Auth::user();

            return view('message.success', [
                'message' => trans('Going to dashboard'),
                'redirect' => '/'
            ]);


//            Auth::logout();
//            throw new PermissionException('You don\'t have enough permissions to sign into dashboard');
        }

        catch (AuthenticationException $e) {
            return view('message.error', [
                'errors' => [
                    $e->getMessage()
                ],
            ]);
        }

        catch (PermissionException $e) {
            return view('message.error', [
                'errors' => [
                    $e->getMessage()
                ],
            ]);
        }

        catch (Exception $e) {
            return view('message.error', [
                'errors' => [
                    (env('APP_DEBUG')) ? $e->getMessage() : trans('Internal Server Error')
                ],
            ]);
        }
	}

	
}

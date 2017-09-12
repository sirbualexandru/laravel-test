<?php

namespace App\Helpers;

use App\Exceptions\AuthenticationException;
use App\Exceptions\PermissionException;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;
use Tymon\JWTAuth\Facades\JWTAuth;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

/**
 * Class JWT
 * @package App\Helpers
 */
final class JWT extends Helper
{
    /**
     * @var User|null
     */
    private static $user = null;

    /**
     * @param string $email
     * @param string $password
     * @return string
     */

    public static function login($data)
    {
        $data['status'] = User::USER_STATUS_ACTIVE;
        $token = JWTAuth::attempt($data);

        if (false === $token) {
            abort(401, 'Invalid Credentials');
        }

        return $token;
    }

    /**
     * @return User|null
     */
    public static function user()
    {
        return Auth::user();
    }
}
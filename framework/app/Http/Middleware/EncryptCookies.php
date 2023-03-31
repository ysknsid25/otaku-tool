<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        //! Xdebugでエラーを回避するため
        //! https://programming.sincoston.com/laravel6-xdebug-payload-invalid/
        'JSESSIONID'
    ];
}

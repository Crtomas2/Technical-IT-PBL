<?php

namespace App\Http\Middleware;



use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        // 'http://edgescanner.herokuapp.coEssAPI/create'

        // 'register/*',
        // 'http://edgescanner.herokuapp.com/register',
        // 'http://edgescanner.herokuapp.com/login',
        // 'http://edgescanner.herokuapp.com/dashboard',
        

    ];
}

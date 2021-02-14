<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/payment*',
		'/cronrequest*',
		'/test_insert*',
		'/test_select*',
		'/get_chatrequest_order*',
		'/test_login*'
		
    ];
}

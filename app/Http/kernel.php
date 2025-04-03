<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\AdminMiddleware;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * 
     */
    // protected $middleware = [
    //     // ...
    // ];

    /**
     * The application's route middleware groups.
     *
     * 
     */
    // protected $middlewareGroups = [
    //     'web' => [
    //         // ...
    //     ],

    //     'api' => [
    //         // ...
    //     ],
    // ];

    /**
     * The application's route middleware.
     *
     * 
     */
    
// }<?php

// namespace App\Http;

// use Illuminate\Foundation\Http\Kernel as HttpKernel;

// class Kernel extends HttpKernel
// {
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // ...
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];


    protected $routeMiddleware = [
        // ...
        'admin' =>AdminMiddleware::class,
    ];

}
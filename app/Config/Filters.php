<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

use App\Filters\AlreadyLoggedInFilter;


class Filters extends BaseConfig
{
    // Makes reading things below nicer,
    // and simpler to change out script that's used.
    public $aliases = [
        'csrf'     => \CodeIgniter\Filters\CSRF::class,
        'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
    //   'AuthCheck' => AuthCheckFilter::class,
        'AlreadyLoggedIn' => AlreadyLoggedInFilter::class,
    ];

   // Always applied before every request
   public $globals = [
      'before' => [
         //'honeypot'
         // 'csrf',
      ],
      'after'  => [
         'toolbar',
         //'honeypot'
      ],
   ];

   // Works on all of a particular HTTP method
   // (GET, POST, etc) as BEFORE filters only
   //     like: 'post' => ['CSRF', 'throttle'],
   public $methods = [];

   // List filter aliases and any before/after uri patterns
   // that they should run on, like:
   //    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
   public $filters = [];
}

// class Filters extends BaseConfig
// {
//     /**
//      * Configures aliases for Filter classes to
//      * make reading things nicer and simpler.
//      *
//      * @var array
//      */
//     public $aliases = [
//         'csrf'          => CSRF::class,
//         'toolbar'       => DebugToolbar::class,
//         'honeypot'      => Honeypot::class,
//         'invalidchars'  => InvalidChars::class,
//         'secureheaders' => SecureHeaders::class,
//     ];

//     /**
//      * List of filter aliases that are always
//      * applied before and after every request.
//      *
//      * @var array
//      */
//     public $globals = [
//         'before' => [
//             // 'honeypot',
//             // 'csrf',
//             // 'invalidchars',
//         ],
//         'after' => [
//             'toolbar',
//             // 'honeypot',
//             // 'secureheaders',
//         ],
//     ];

//     /**
//      * List of filter aliases that works on a
//      * particular HTTP method (GET, POST, etc.).
//      *
//      * Example:
//      * 'post' => ['csrf', 'throttle']
//      *
//      * @var array
//      */
//     public $methods = [];

//     /**
//      * List of filter aliases that should run on any
//      * before or after URI patterns.
//      *
//      * Example:
//      * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
//      *
//      * @var array
//      */
//     public $filters = [];
// }


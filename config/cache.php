<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    | Supported: "apc", "array", "database", "file", "memcached", "redis"
    |
    */

    'default' => env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    */

    'stores' => [

        'apc' => [
            'driver' => 'apc',
        ],

        'array' => [
            'driver' => 'array',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'cache',
            'connection' => null,
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT  => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing a RAM based store such as APC or Memcached, there might
    | be other applications utilizing the same cache. So, we'll specify a
    | value to get prefixed to all our keys so we can avoid collisions.
    |
    */

    'prefix' => 'laravel',
    /*
    |--------------------------------------------------------------------------
    | Models Directory
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default models directory, just write
    | directory name, like 'Models' not the full path.
    |
    | Default: 'Models'
    |
    */

    'models' => 'Models',

    /*
    |--------------------------------------------------------------------------
    | Caching Strategy
    |--------------------------------------------------------------------------
    */

    'strategy' => [

        /*
        |--------------------------------------------------------------------------
        | Cache Keys File
        |--------------------------------------------------------------------------
        |
        | Here you may specify the cache keys file that is used only with cache
        | drivers that does not support cache tags. It is mandatory to keep
        | track of cache keys for later usage on cache flush process.
        |
        | Default: storage_path('framework/cache/rinvex.repository.json')
        |
        */

        'keys_file' => storage_path('framework/cache/pmu.repository.json'),

        /*
        |--------------------------------------------------------------------------
        | Cache Lifetime
        |--------------------------------------------------------------------------
        |
        | Here you may specify the number of minutes that you wish the cache
        | to be remembered before it expires. If you want the cache to be
        | remembered forever, set this option to -1. 0 means disabled.
        |
        | Default: -1
        |
        */

        'lifetime' => env('CACHE_LIFE_TIME', -1),

        /*
        |--------------------------------------------------------------------------
        | Cache Clear
        |--------------------------------------------------------------------------
        |
        | Specify which actions would you like to clear cache upon success.
        | All repository cached data will be cleared accordingly.
        |
        | Default: ['create', 'update', 'delete']
        |
        */

        'clear_on' => [
            'create',
            'update',
            'delete',
        ],

        /*
        |--------------------------------------------------------------------------
        | Cache Skipping URI
        |--------------------------------------------------------------------------
        |
        | For testing purposes, or maybe some certain situations, you may wish
        | to skip caching layer and get fresh data result set just for the
        | current request. This option allows you to specify custom
        | URL parameter for skipping caching layer easily.
        |
        | Default: 'skipCache'
        |
        */

        'skip_uri' => 'skipCache',

    ],

];

<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Email
    |--------------------------------------------------------------------------
    */

    'email' => 'aiwriter@mail.com',

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    // 'name' => env('APP_NAME', 'Laravel'),
    'name' => 'FastAI',

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    // 'url' => env('APP_URL', 'http://localhost'),
    'url' => 'http://localhost',

    'asset_url' => env('ASSET_URL', '/'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Asia/Dhaka',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),
    'openai_key' => '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',

    'cipher' => 'AES-256-CBC',

    'google_client_id' => '635555955649-k0pmi4v82obm1n55hrh5jteo8h448inn.apps.googleusercontent.com',
    'google_client_secret' => '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',
    'google_redirect' => 'http://localhost:8000/auth/google/callback',
    'google_login_allow' => 'true',

    'facebook_client_id' => '',
    'facebook_client_secret' => '',
    'facebook_redirect' => 'http://localhost:8000/auth/facebook/callback',
    'facebook_login_allow' => 'false',

    /*
    |--------------------------------------------------------------------------
    | SMTP Key and value
    |--------------------------------------------------------------------------
    */

    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_port' => '2525',
    'smtp_username' => 'b4e73e7bd60f42',
    'smtp_password' => '1183c27e31c19b',
    'smtp_encryption' => 'tls',
    'mail_from_address' => 'contact.jamir@gmail.com',
    'mail_from_name' => 'AI Writer',
    
    
    /*
    |--------------------------------------------------------------------------
    | Payment gate ways Key and value
    |--------------------------------------------------------------------------
    */

    'allow_stripe' => 'true',
    'stripe_key' => 'pk_test_51MqXylIiDrICYDpi2wV1r3LjpG8TrcEdJxyoWUYnMGB0vzSfULFbmPlJb4ihK1yzlTfpsGz5AcLZAkj1CP4xKf8P00ifIJMljj',
    'stripe_secret' => 'sk_test_51MqXylIiDrICYDpi5YVFKNt37kWPLJgXZqGrQLj0by1KGqHyYU1xQwy7QoD9PisIGl5rsdS263YxMc11PKDGN8kW00LcM8it0G',

    
    'allow_razorpay' => 'true',
    'razorpay_key' => 'rzp_test_zS9oIvYgReSMPJ',
    'razorpay_secret' => 'wQZfkkbrf3ueconWDlvqlXyR',


    'allow_two_checkout' => 'true',
    'two_checkout_seller_id' => '254346735884',
    'two_checkout_seller_key' => 'In[MLodOlX_S4~m6G]#1',
    'two_checkout_jwt_expire_time' => '30',
    'two_checkout_curl_verify_ssl' => '1',


    'allow_paypal' => 'true',
    'paypal_mode' => 'sandbox',
    'paypal_client_id' => 'Adlr1LPuADhQLV67LNiEUj1k82tOCgnY9TSGmIjdwNGYdqinz7KMf-jAlFncAc2cRF6LkOhjiU-R13OA',
    'paypal_client_secret' => 'EHgIuYJNKl0GPgrucTU3vp2FZyohoC-ITT6By1GF6xCeusWfbZtVGyeQ2kaaYOqdAM77MGDCIB-BcjQ5',


    'allow_mollie' => 'true',
    'mollie_key' => 'test_fvfFGfJyxeW5RD5q88EfaCndmBAUWr',


    'allow_paystack' => 'true',
    'paystack_key' => 'pk_test_8fafaf5230cff7335166c48dba7375703766e55d',
    'paystack_secret' => 'sk_test_efe0720a285402bde610bbd7642cceb142dbc6ab',
    

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Intervention\Image\ImageServiceProvider::class,
        App\Providers\XSSPurifierServiceProvider::class,
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'ExampleClass' => App\Example\ExampleClass::class,
        'Image' => Intervention\Image\Facades\Image::class,
    ])->toArray(),

];

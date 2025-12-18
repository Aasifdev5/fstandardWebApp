<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\UnderlyingTickUpdated;
use App\Events\FuturesTickUpdated;
use App\Events\OptionsTickUpdated;

use App\Listeners\UpdateCandle;
use App\Listeners\UpdateFuturesCandle;
use App\Listeners\UpdateOptionsCandle;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // Underlying price tick → update candles
        UnderlyingTickUpdated::class => [
            UpdateCandle::class,
        ],

        // Futures price tick → update futures candles
        FuturesTickUpdated::class => [
            UpdateFuturesCandle::class,
        ],

        // Options price tick → update options candles
        OptionsTickUpdated::class => [
            UpdateOptionsCandle::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

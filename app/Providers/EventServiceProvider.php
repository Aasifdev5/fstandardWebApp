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

// NEW: For AI Psychometric Explanations (PART 2.4)
use App\Models\PsychometricSnapshot;
use App\Services\AI\PsychometricExplainService;

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
        // Automatic AI explanation after every new psychometric snapshot
        // This ensures traders get fresh behavior insights without manual trigger
        PsychometricSnapshot::created(function ($snapshot) {
            app(PsychometricExplainService::class)
                ->generateForUser($snapshot->user_id);
        });
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

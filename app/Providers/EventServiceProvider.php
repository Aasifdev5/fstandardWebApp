<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\FuturesTickUpdated;
use App\Events\OptionsTickUpdated;

use App\Listeners\UpdateFuturesCandle;
use App\Listeners\UpdateOptionsCandle;

use App\Models\PsychometricSnapshot;
use App\Services\AI\PsychometricExplainService;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        FuturesTickUpdated::class => [
            UpdateFuturesCandle::class,
        ],

        OptionsTickUpdated::class => [
            UpdateOptionsCandle::class,
        ],

    ];

    public function boot()
    {
        PsychometricSnapshot::created(function ($snapshot) {

            app(PsychometricExplainService::class)
                ->generateForUser($snapshot->user_id);

        });
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}

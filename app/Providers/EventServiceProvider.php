<?php

namespace App\Providers;

use App\Events\FinishedQuestionnaire;
use App\Listeners\FinishedQuestionnaireListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        FinishedQuestionnaire::class => [
            FinishedQuestionnaireListener::class
        ]
    ];
}

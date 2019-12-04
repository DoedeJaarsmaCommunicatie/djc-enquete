<?php

namespace App\Listeners;

use App\Mail\ThankYouNotification;
use Illuminate\Support\Facades\Mail;
use App\Events\FinishedQuestionnaire;
use App\Mail\FinishedQuestionnareNotification;

class FinishedQuestionnaireListener
{
    public function __construct () {}

    public function handle(FinishedQuestionnaire $finishedQuestionnaire)
    {
        Mail::to('mail@doedejaarsma.nl')
            ->send(new FinishedQuestionnareNotification());

        Mail::to($finishedQuestionnaire->user->email)
            ->send(new ThankYouNotification($finishedQuestionnaire->user->id));
    }
}

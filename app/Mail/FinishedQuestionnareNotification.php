<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class FinishedQuestionnareNotification extends Mailable
{
    public function build () {
        $this->from('mail@doedejaarsma.nl', 'Doede van Doede Jaarsma communicatie')
            ->subject('Er is een nieuwe ingevulde enquete')
            ->view('NewNotification');
    }
}

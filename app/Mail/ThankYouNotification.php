<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;

class ThankYouNotification extends Mailable
{
    public $user;

    public function __construct ($user_id)
    {
        $this->user = DB::table('users')->find($user_id);
    }

    public function build ()
    {
        return $this->to($this->user->email)
            ->subject('Bedankt voor het invullen van de vragenlijst.')
            ->from('mail@doedejaarsma.nl', 'Doede Jaarsma')
            ->view('thankYou');
    }
}

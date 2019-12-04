<?php


namespace App\Events;


use Illuminate\Support\Facades\DB;

class FinishedQuestionnaire extends Event
{
    public $user;

    public function __construct ($id) {
        $this->user = DB::table('users')->find($id);
    }
}

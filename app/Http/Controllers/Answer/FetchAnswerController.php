<?php

namespace App\Http\Controllers\Answer;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FetchAnswerController extends Controller
{
    /**
     * @param mixed $user
     * @param mixed $question
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke ($user, $question)
    {
        $uq = DB::table('users')
                ->where('id', '=', $user)
                ->orWhere('uuid', '=', $user)
                ->orWhere('email', '=', $user);

        if (!$uq->exists()) {
            abort(404, 'Gebruiker niet gevonden.');
        }

        $qq = DB::table('questions')
                ->where('id', '=', $question);

        if (!$qq->exists()) {
            abort(404, 'Vraag niet gevonden.');
        }

        $aq = DB::table('answers')
                ->where('user_id', '=', $uq->first()->id)
                ->where('question_id', '=', $qq->first()->id);

        if (!$aq->exists()) {
            abort(404, 'Geen antwoord gevonden');
        }

        return response()->json((array) $aq->first());
    }
}

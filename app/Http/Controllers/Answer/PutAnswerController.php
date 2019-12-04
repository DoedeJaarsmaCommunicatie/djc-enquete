<?php

namespace App\Http\Controllers\Answer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PutAnswerController extends Controller
{
    /**
     * @param Request $request
     * @param mixed   $user
     * @param mixed   $question
     */
    public function __invoke (Request $request, $user, $question)
    {
        if (!$request->has(static::answerKey())) {
            abort(400, 'Geen antwoord ingevuld.');
        }

        $oq = DB::table('options')
                    ->where('id', '=', $request->input(static::answerKey()));

        if (!$oq->exists()) {
            abort(404, 'Antwoord bestaat niet.');
        }

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

        $oa = DB::table('answers')
                ->where('user_id', '=', $uq->first()->id)
                ->where('question_id', '=', $qq->first()->id);

        if ($oa->exists()) {
            $oa->update(['option_id' => $oq->first()->id]);
        } else {
            DB::table('answers')->updateOrInsert([
                'user_id'       => $uq->first()->id,
                'option_id'     => $oq->first()->id,
                'question_id'   => $qq->first()->id
            ]);
        }

        return response()->json([], 201);
    }

    protected static function answerKey(): string
    {
        return 'answer';
    }
}

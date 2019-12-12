<?php

namespace App\Http\Controllers\Question;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FetchQuestionsController extends Controller
{
    public function __invoke ()
    {
        $q = DB::table('questions')
               ->orderBy('position', 'ASC')->get();

        if ($q->isEmpty()) {
            abort(404, 'No questions found.');
        }

        $collection = collect($q)->filter(static function ($item) {
            unset($item->created_at, $item->updated_at);

            return $item;
        });

        return response()->json(
            $collection->toArray()
        );
    }
}

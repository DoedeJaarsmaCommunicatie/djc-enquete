<?php

namespace App\Http\Controllers\Question;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FetchQuestionController extends Controller
{
    public function __invoke ($id)
    {
        $q = DB::table('questions')->where('id', '=', $id);

        if (!$q->exists()) {
            abort(404, 'No question found with that ID');
        }

        $q = $q->first();

        $options = DB::table('options')
                     ->where('question_id', '=', $q->id)
                     ->get();

        $options = collect($options)->filter(static function ($item) {
            unset($item->created_at, $item->updated_at);
            return $item;
        })->toArray();

        return response()->json([
            'name'      => $q->name,
            'position'  => $q->position,
            'options'   => $options,
        ]);
    }
}

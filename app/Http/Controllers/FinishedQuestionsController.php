<?php

namespace App\Http\Controllers;

use App\Events\FinishedQuestionnaire;

class FinishedQuestionsController {
    public function __invoke ($id) {
        event(new FinishedQuestionnaire($id));
        return response()->json([], 204);
    }
}

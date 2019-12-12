<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PatchUserController extends Controller
{
    public function __invoke (Request $request, $id)
    {
        $user = GetUserController::getUser($id);

        if (!$user) {
            abort(404, 'Gebruiker bestaat niet.');
        }

        DB::table('users')->where('id', $user->id)->update($request->only([
            'firstName',
            'lastName',
            'email',
            'address',
            'postalCode',
            'city'
        ]));

        return response()->json(
            GetUserController::getUser($id)
        );
    }
}

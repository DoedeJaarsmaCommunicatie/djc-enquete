<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetUserController extends Controller
{
    /**
     * @param int|string $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke ($id)
    {
        try {
            $user = static::getUser($id);
        } catch (ModelNotFoundException $notFoundException) {
            abort(404, $notFoundException->getMessage());
        }

        return response()->json($user->toArray());
    }

    /**
     * @param $id
     *
     * @return Model|Builder|object
     */
    private static function getUser($id)
    {
        $db = DB::table('users')->where('id', '=', $id);

        if ($db->exists()) {
            return $db->first();
        }

        throw new ModelNotFoundException('No user found with ID: ' . $id);
    }
}

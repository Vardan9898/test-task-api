<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json([
            'users' => $request->filters ?
                User::filter($request->filters)->get() :
                User::all(),
        ]);
    }
}

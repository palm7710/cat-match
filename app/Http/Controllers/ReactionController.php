<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cat;
use App\Models\Reaction;
use Illuminate\Support\Facades\Log;

class ReactionController extends Controller
{
    public function create(Request $request)
    {
        Log::debug($request);

        $to_cat_id = $request->to_cat_id;
        $like_status = $request->reaction;
        $from_user_id = $request->from_user_id;

        $status = $like_status === 'like' ? 1 : 0;

        $checkReaction = Reaction::where([
            ['to_cat_id', $to_cat_id],
            ['from_user_id', $from_user_id]
        ])->get();

        if ($checkReaction->isEmpty()) {
            $reaction = new Reaction();

            $reaction->to_cat_id = $to_cat_id;
            $reaction->from_user_id = $from_user_id;
            $reaction->status = $status;

            $reaction->save();
        }
    }
}

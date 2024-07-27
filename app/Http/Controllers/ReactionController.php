<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;
use Illuminate\Support\Facades\Log;

class ReactionController extends Controller
{
    public function create(Request $request)
    {
        Log::debug('Received create request:', $request->all());

        $cat_id = $request->input('cat_id');
        $user_id = $request->input('user_id');
        $like_status = $request->input('reaction');

        Log::debug('cat_id: ' . $cat_id);
        Log::debug('user_id: ' . $user_id);

        $status = $like_status === 'like' ? 1 : 0;

        $checkReaction = Reaction::where('cat_id', $cat_id)
                                  ->where('user_id', $user_id)
                                  ->first();

        if (!$checkReaction) {
            Log::debug('No existing reaction found, creating new one.');

            $reaction = new Reaction();
            $reaction->cat_id = $cat_id;
            $reaction->user_id = $user_id;
            $reaction->status = $status;

            $reaction->save();

            Log::info('Reaction saved successfully.');
        } else {
            Log::info('Reaction already exists.');
        }

        return response()->json(['success' => true]);
    }
}

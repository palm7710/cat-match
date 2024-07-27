<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\User;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;
use App\Constants\Status;
use Illuminate\Support\Facades\Log;

class MatchingController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        Log::info('User ID: ' . $user_id);

        // ユーザがいいねした保護猫のIDを取得
        $liked_cat_ids = Reaction::where([
            ['user_id', $user_id],
            ['status', Status::LIKE]
        ])->pluck('cat_id')->toArray();
        Log::info('Liked cat ids: ', ['liked_cat_ids' => $liked_cat_ids]);

        if (empty($liked_cat_ids)) {
            return view('users.matching', ['matching_cats' => [], 'catsCount' => 0]);
        }

        // 猫にいいねされたユーザのID
        $query = Reaction::where('status', 1)
            ->whereIn('cat_id', $liked_cat_ids)
            ->where('user_id', '!=', $user_id);
        Log::info('Query after whereIn and user_id condition: ', ['query' => $query->toSql()]);

        $cats_that_liked_me_ids = $query->pluck('user_id')->toArray();
        Log::info('Cats that liked me ids: ', ['cats_that_liked_me_ids' => $cats_that_liked_me_ids]);

        // マッチしている保護猫のIDを取得
        $matching_cat_ids = array_intersect($liked_cat_ids, $cats_that_liked_me_ids);
        Log::info('Matching cat ids: ', ['matching_cat_ids' => $matching_cat_ids]);

        // ユーザがマッチしている保護猫の情報を取得
        $matching_cats = Cat::whereIn('id', $matching_cat_ids)->get();
        Log::info('Matching cats: ', ['matching_cats' => $matching_cats->toArray()]);

        $catsCount = count($matching_cats);
        Log::info('Cats count: ' . $catsCount);

        return view('users.matching', compact('matching_cats', 'catsCount'));
    }

    // 保護猫側のマッチングページ
    public function catIndex()
    {
        $cat_id = Auth::id();
        Log::info('Cat ID: ' . $cat_id);

        // 猫がいいねしたユーザーのIDを取得
        $liked_user_ids = Reaction::where([
            ['cat_id', $cat_id],
            ['status', Status::LIKE]
        ])->pluck('user_id')->toArray();
        Log::info('Liked user ids: ', ['liked_user_ids' => $liked_user_ids]);

        if (empty($liked_user_ids)) {
            return view('cats.matching', ['matching_users' => [], 'match_users_count' => 0]);
        }

        // ユーザにいいねされた猫のID
        $query = Reaction::where('status', 1)
            ->whereIn('user_id', $liked_user_ids)
            ->where('cat_id', '!=', $cat_id);
        Log::info('Query after whereIn and cat_id condition: ', ['query' => $query->toSql()]);

        $users_that_liked_me_ids = $query->pluck('cat_id')->toArray();
        Log::info('Users that liked me ids: ', ['users_that_liked_me_ids' => $users_that_liked_me_ids]);

        // 猫がマッチしているユーザーのIDを取得
        $matching_user_ids = array_intersect($liked_user_ids, $users_that_liked_me_ids);
        Log::info('Matching user ids: ', ['matching_user_ids' => $matching_user_ids]);

        // 猫がマッチしているユーザーの情報を取得
        $matching_users = User::whereIn('id', $matching_user_ids)->get();
        Log::info('Matching users: ', ['matching_users' => $matching_users->toArray()]);

        $match_users_count = count($matching_users);
        Log::info('Match users count: ' . $match_users_count);

        return view('cats.matching', compact('matching_users', 'match_users_count'));
    }
}

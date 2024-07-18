<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\User;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;
use App\Constants\Status;

class MatchingController extends Controller
{
    public function index()
    {
        // 自分がいいねした保護猫のIDを取得
        $liked_cat_ids = Reaction::where([
            ['from_user_id', Auth::id()],
            ['status', Status::LIKE]
        ])->pluck('to_cat_id');

        // いいねされた自分のID
        $cats_that_liked_me_ids = Reaction::whereIn('from_user_id', $liked_cat_ids)
            ->where('status', Status::LIKE)
            ->where('to_cat_id', Auth::id())
            ->pluck('from_user_id');

        // マッチしている保護猫の情報を取得
        $matching_cats = Cat::whereIn('id', $cats_that_liked_me_ids)->get();
        $catsCount = count($matching_cats);  // ここでカウントを取得

        return view('user.matching', compact('matching_cats', 'catsCount'));
    }

    // 保護猫側のマッチングページ
    public function catIndex()
    {
        // 自分（保護猫）が飼ってほしいと思っているユーザー
        $liked_user_ids = Reaction::where([
            ['from_user_id', Auth::id()],
            ['status', Status::LIKE]
        ])->pluck('to_user_id');

        // いいねされた自分のID
        $users_that_liked_me_ids = Reaction::whereIn('to_user_id', $liked_user_ids)
            ->where('status', Status::LIKE)
            ->pluck('from_user_id');

        // マッチしているユーザーの情報を取得
        $matching_users = User::whereIn('id', $users_that_liked_me_ids)->get();
        $match_users_count = count($matching_users);

        return view('cat.matching', compact('matching_users', 'match_users_count'));
    }
}

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
            ['user_id', Auth::id()],
            ['status', Status::LIKE]
        ])->pluck('cat_id');

        // いいねされた自分のID
        $cats_that_liked_me_ids = Reaction::whereIn('cat_id', $liked_cat_ids)
            ->where('status', Status::LIKE)
            ->where('cat_id', '!=', null)
            ->pluck('user_id');

        // マッチしている保護猫の情報を取得
        $matching_cats = Cat::whereIn('id', $cats_that_liked_me_ids)->get();
        $catsCount = count($matching_cats);

        return view('users.matching', compact('matching_cats', 'catsCount'));
    }

    // 保護猫側のマッチングページ
    public function catIndex()
    {
        // 自分（保護猫）が飼ってほしいと思っているユーザー
        $liked_user_ids = Reaction::where([
            ['cat_id', Auth::id()],
            ['status', Status::LIKE]
        ])->pluck('user_id');

        // いいねされた自分のID
        $users_that_liked_me_ids = Reaction::whereIn('user_id', $liked_user_ids)
            ->where('status', Status::LIKE)
            ->where('user_id', '!=', null)
            ->pluck('cat_id');

        // マッチしているユーザーの情報を取得
        $matching_users = User::whereIn('id', $users_that_liked_me_ids)->get();
        $match_users_count = count($matching_users);

        return view('cats.matching', compact('matching_users', 'match_users_count'));
    }
}

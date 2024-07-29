<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $cat_id = $request->input('cat_id');
        $action = $request->input('action'); // 'like' または 'dislike'

        // 既存のリアクションを取得
        $reaction = Reaction::where([
            ['cat_id', $cat_id],
            ['user_id', $user_id]
        ])->first();

        if ($reaction) {
            // 既存のリアクションがある場合
            if ($action === 'like') {
                if ($reaction->status === 2) {
                    // 猫がユーザーにいいねしていた場合、状態を3に更新
                    $reaction->status = 3;
                } elseif ($reaction->status === 0) {
                    // ユーザーがディスライクしていた場合、状態を1に更新
                    $reaction->status = 1;
                }
            } elseif ($action === 'dislike') {
                // ユーザーがディスライクした場合
                $reaction->status = 0;
            }
            $reaction->save();
        } else {
            // 新しいリアクションを作成
            $status = ($action === 'like') ? 1 : 0; // 初回はユーザーがいいねした場合のデフォルト状態
            Reaction::create([
                'cat_id' => $cat_id,
                'user_id' => $user_id,
                'status' => $status,
            ]);
        }

        // 他のユーザーのリアクションもチェックして、必要に応じて更新
        $this->updateCatReactionStatus($cat_id, $user_id);

        return response()->json(['success' => true]);
    }

    protected function updateCatReactionStatus($cat_id, $user_id)
    {
        // 猫がユーザーにいいねしたリアクションを取得
        $catReaction = Reaction::where([
            ['cat_id', $cat_id],
            ['user_id', '!=', $user_id]
        ])->where('status', 1)
          ->first();

        if ($catReaction) {
            // 猫がユーザーにいいねしている場合、ユーザーのリアクションを3に更新
            Reaction::where([
                ['cat_id', $cat_id],
                ['user_id', $user_id]
            ])->update(['status' => 3]);
        } else {
            // 猫がいいねしているが、ユーザーがディスライクした場合
            $reaction = Reaction::where([
                ['cat_id', $cat_id],
                ['user_id', $user_id]
            ])->first();

            if ($reaction && $reaction->status !== 0) {
                // ユーザーのリアクションをディスライクに更新
                $reaction->update(['status' => 0]);
            }
        }
    }
}

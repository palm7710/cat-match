<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatRoomUser;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\Cat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function show(Request $request)
    {
        $matching_user_id = $request->input('user_id');
        $cat_id = $request->input('cat_id');

        Log::info('ChatController show method called', [
            'matching_user_id' => $matching_user_id,
            'cat_id' => $cat_id,
            'current_user_id' => Auth::id(),
        ]);

        // チャットルームのIDを取得
        if ($matching_user_id) {
            $chat_room_id = ChatRoomUser::where('user_id', Auth::id())
                ->whereIn('chat_room_id', function($query) use ($matching_user_id) {
                    $query->select('chat_room_id')
                        ->from('chat_room_users')
                        ->where('user_id', $matching_user_id);
                })
                ->pluck('chat_room_id')
                ->first();
        } elseif ($cat_id) {
            $chat_room_id = ChatRoomUser::where('user_id', Auth::id())
                ->whereIn('chat_room_id', function($query) use ($cat_id) {
                    $query->select('chat_room_id')
                        ->from('chat_room_users')
                        ->where('user_id', $cat_id);
                })
                ->pluck('chat_room_id')
                ->first();
        } else {
            Log::warning('Invalid parameters provided', [
                'matching_user_id' => $matching_user_id,
                'cat_id' => $cat_id
            ]);
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        Log::info('Chat room ID retrieved or created', [
            'chat_room_id' => $chat_room_id
        ]);

        // チャットルームが存在しない場合は作成
        if (!$chat_room_id) {
            $chat_room = ChatRoom::create(); // チャットルーム作成

            $chat_room_id = $chat_room->id;

            Log::info('New chat room created', [
                'chat_room_id' => $chat_room_id
            ]);

            if ($matching_user_id) {
                ChatRoomUser::create([
                    'chat_room_id' => $chat_room_id,
                    'user_id' => Auth::id()
                ]);

                ChatRoomUser::create([
                    'chat_room_id' => $chat_room_id,
                    'user_id' => $matching_user_id
                ]);
            } elseif ($cat_id) {
                ChatRoomUser::create([
                    'chat_room_id' => $chat_room_id,
                    'user_id' => Auth::id()
                ]);

                ChatRoomUser::create([
                    'chat_room_id' => $chat_room_id,
                    'user_id' => $cat_id
                ]);
            }
        }

        // チャット相手のユーザー情報を取得
        if ($matching_user_id) {
            $chat_room_user = User::findOrFail($matching_user_id);
        } elseif ($cat_id) {
            $chat_room_user = Cat::findOrFail($cat_id);
        }

        Log::info('Chat room user retrieved', [
            'chat_room_user_id' => $chat_room_user->id,
            'chat_room_user_name' => $chat_room_user->name
        ]);

        // チャット相手のユーザー名を取得 (JS用)
        $chat_room_user_name = $chat_room_user->name;

        $chat_messages = ChatMessage::where('chat_room_id', $chat_room_id)
            ->orderBy('created_at')
            ->get();

        Log::info('Chat messages retrieved', [
            'chat_room_id' => $chat_room_id,
            'messages_count' => $chat_messages->count()
        ]);

        return view('chat.show', compact('chat_room_id', 'chat_room_user', 'chat_messages', 'chat_room_user_name'));
    }
}

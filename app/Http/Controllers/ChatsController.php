<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChatsController extends Controller
{

    public function fetchMessages(int $id): Response
    {
        $user = Auth::user();
        $friend = User::find($id);
        if ($friend === null) {
            dump('404');
            die;
        }
        $messages = DB::table('messages')
            ->where(function (Builder $query) use ($user, $friend) {
                $query->where('from_id', '=', $user->id)
                    ->where('to_id', '=', $friend->id);
            })
            ->orWhere(function (Builder $query) use ($user, $friend) {
                $query->where('from_id', '=', $friend->id)
                    ->where('to_id', '=', $user->id);
            })
            ->orderBy('created_at')
            ->get();


        $data = [
            'messages' => $messages,
            'user' => $user,
            'friend' => $friend
        ];

        return new Response($data);
    }

    public function sendMessage(Request $request, int $id): Response
    {
        $message = Message::create([
            'message' => $request->get('message'),
            'from_id' => Auth::id(),
            'to_id' => $id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // TODO: Add file to message
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $file->storePubliclyAs('public/files', $file->getClientOriginalName());
        }

        return new Response($message);
    }
}

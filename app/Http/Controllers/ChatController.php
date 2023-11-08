<?php

namespace App\Http\Controllers;

use App\Events\ClikEvent;
use App\Http\Resources\ChatResourse;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {

        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
        ]);

        $chat = Chat::where([
            ['from', '=', $request->from],
            ['to', '=', $request->to],
        ])
            ->orWhere([
                ['from', '=', $request->to],
                ['to', '=', $request->from],
            ])->with('messages')->first();

//            if(isset($chat)){
//                if($request->from == $chat->from){
//                    $chat->urer =  \Http::get('http://192.168.0.127:8000/api/user/'.$chat->to)->json()['data'];
//                }else{
//                    $chat->user =  \Http::get('http://192.168.0.127:8000/api/user/'.$chat->from)->json()['data'];
//                }
//            }
        return response()->json($chat->messages ?? []);
    }


    public function chat(Request $request)
    {
        broadcast(new ClikEvent($request->auth))->toOthers();
        $chat = Chat::with('messages')->find($request->id);

        if (!is_null($chat->reader)) {
            if ($chat->reader == $request->auth) {
                $chat->count = 0;
                $chat->timestamps = false;
                $chat->reader = null;
                $chat->save();
            }
        }

        return response()->json($chat->messages ?? []);
    }

    public function alert($id)
    {

        $chats = Chat::with('messages')->where('from', $id)->orWhere('to', $id)->orderBy('updated_at', 'DESC')->get()->where('reader', $id);

        foreach ($chats as $chat) {
            if ($chat->from == $id) {
//                $chat->user = \Http::get('http://crm.orzugrand.uz/api/user/' . $chat->to)->json()['data'] ?? $chat->to;
                $chat->user = $chat->touser;
            } else {
//                $chat->user = \Http::get('http://crm.orzugrand.uz/api/user/' . $chat->from)->json()['data'] ?? $chat->from;
                $chat->user =  $chat->fromuser;
            }
        }

        if ($chats) {
            $data = ChatResourse::collection($chats);
            return response()->json($data);
        }
        return response()->json([]);


    }




    //  public function store(Request $request){

    //     $this->validate($request,[
    //         'from'=>'required',
    //         'to'=>'required',
    //         'text'=>'string',
    //         'file'=>'file'
    //     ]);

    //     $data = $request->all();
    //     $chat = Chat::create($data);

    //     $data['chat_id'] = $chat->id;
    //     $data['author'] = $chat->from;

    //     $message = Message::create($data);
    //     $chat = Chat::with('messages')->find($chat->id);

    //    $chat->from =  \Http::get('http://192.168.0.127:8000/api/user/'.$chat->from)->json()['data'];


    //    $chat->to =  \Http::get('http://192.168.0.127:8000/api/user/'.$chat->to)->json()['data'];

    //     return response()->json($chat);
    // }
}

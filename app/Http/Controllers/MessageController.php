<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Http\Resources\ChatResourse;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request) {


        $this->validate($request,[
            'from'=>'required',
            'to'=>'required',
            'text'=>'required',
        ]);

        $data = $request->all();

        if(empty($request->chat_id)){

            $chat =  Chat::where([
                ['from','=',$request->from],
                ['to','=',$request->to],
            ])
                ->orWhere([
                    ['from','=',$request->to],
                    ['to','=',$request->from],
                ])->first();

            if(!$chat){
//               $author =  \Http::get('http://crm.orzugrand.uz/api/user/'.$request->from);
//
//               $to =  \Http::get('http://crm.orzugrand.uz/api/user/'.$request->to);
//
//               if(empty($author) || empty($to)){
//                   return response()->json('user mavjud emas',401);
//               }

               $this->validate($request,[
                   'from'=>'exists:users,id',
                   'to'=>'exists:users,id'
               ]);

                $chat = Chat::create($data);
            }

            $data['chat_id'] = $chat->id;
        }
        else{
            $chat=Chat::find($request->chat_id);
        }


        $chat->count++;
        $chat->reader = $request->to;
        $chat->save();
        $data['author']= $request->from;

        if(!empty($request->file)){
            $imageName = time().'.'.$request->file->extension();
            $request->file->move(public_path('files'), $imageName);
            $data['file'] = $imageName;
        }

        broadcast(new MessageEvent($request->to, $data))->toOthers();





        return response()->json(true);
    }

    public function index($id){

        $chats = Chat::with('messages')->where(  'from',$id)->orWhere('to',$id)->orderBy('updated_at', 'DESC')->get();

        foreach($chats as $chat){
            if($chat->from == $id){
//                $chat->user =  \Http::get('http://crm.orzugrand.uz/api/user/'.$chat->to)->json()['data']??$chat->to;
                $chat->user =  $chat->touser;
            }else{
//                $chat->user =  \Http::get('http://crm.orzugrand.uz/api/user/'.$chat->from)->json()['data']??$chat->from;
                $chat->user =  $chat->fromuser;
            }
        }

        if($chats){
            $data  = ChatResourse::collection($chats);

            return response()->json($data);
        }
        return response()->json([]);
    }


}

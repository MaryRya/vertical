<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Models\Dance_lesson;
use App\Models\Dance_direction;
use App\Models\Schedule;
use App\Models\Hall;
use App\Models\Records_clients;
use App\Models\Time_lesson;
use App\Models\Reviews;
use App\Http\Controllers\Auth;


class ChatController extends Controller
{
    private function auth_admin(){
        if(isset(auth()->user()->name)){
            if(auth()->user()->id_role == 2){
                return true;
            }
        }
        return false;
    }
    public function chat(Request $request)
    {
        if(auth()->check()){
            $method = $request->method();
            if ($request->isMethod('post')){
                $request->session()->put('id_users', $request->id);
                return redirect('/chat');
            }
            $chat_views = Chat::where([['id_users', '=', auth()->user()->id], ['view', '=', 0]]);
            $count = $chat_views->count();

            $chat_update = Chat::where('id_users', auth()->user()->id)->update([
                'view' => 1,
            ]);
            return view('chat', ['count' => $count]);
        } else return redirect('/');
    }

    public function chatAjax(Request $request, Chat $chat)
    {
        if(auth()->check()){
            if($request->suc == 0){
                if(auth()->user()->id_role == 2){
                    $chat_update = Chat::where('id_users',$request->session()->get('id_users'))->whereNull('answer')->update([
                        'answer' => $request->question,
                    ]);
                }
                else{
                    $chat->question = $request->question;
                    $chat->id_users = auth()->user()->id;
                    $chat->save();
                }
            }
            if($request->session()->get('id_users')){
                $user_chats = Chat::where('id_users', $request->session()->get('id_users'))->get();
            }
            else{
                $user_chats = Chat::where('id_users', auth()->user()->id)->get();
            }
            return ['data' => $user_chats];
        }
        return ['data' => 1];
    }
    public function chatTable()
    {
        if($this->auth_admin()){
            $users = Chat::join("Users", "Chat.id_users", "Users.id")->whereNull("Chat.answer")->groupBy('Chat.id_users')->selectRaw('count(*) as total, id_users, name')->get();
            return view('chatTable', ['users'=>$users]);
        }
        else{
            return redirect('/');
        }

    }
}





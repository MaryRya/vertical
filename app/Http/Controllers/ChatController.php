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
use Illuminate\Support\Facades\Mail;


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
                $request->session()->put('id_user', $request->id);
                return redirect('/chat');
            }
            $chat_views = Chat::where([['id_user', '=', auth()->user()->id], ['view', '=', 0]]);
            $count = $chat_views->count();

            $chat_update = Chat::where('id_user', auth()->user()->id)->update([
                'view' => 1,
            ]);
            return view('chat', ['count' => $count]);
        } else return redirect('/');
    }

    private function sendMail($temp, $data, $to_name, $to_email){
        Mail::send($temp, $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Ответ от Vertical');
            $message->from('admin@ad.ru','Vertical');
        });
    }

    public function chatAjax(Request $request, Chat $chat)
    {
        if(auth()->check()){
            if($request->suc == 0){
                if(auth()->user()->id_role == 2){
                    $chat_update = Chat::where('id_user',$request->session()->get('id_user'))->whereNull('answer')->update([
                        'answer' => $request->question,
                    ]);

                    $user_current = User::select('email', 'name')->where('id', $request->session()->get('id_user'))->first();

                    $data = ['name'=> $user_current['name']];
                    $this->sendMail("emails/chat", $data, $user_current['name'], $user_current['email']);

                }
                else{
                    $chat->question = $request->question;
                    $chat->id_user = auth()->user()->id;
                    $chat->save();
                }
            }
            if($request->session()->get('id_user')){
                $user_chats = Chat::where('id_user', $request->session()->get('id_user'))->get();
            }
            else{
                $user_chats = Chat::where('id_user', auth()->user()->id)->get();
            }
            return ['data' => $user_chats];
        }
        return ['data' => 1];
    }
    public function chatTable()
    {
        if($this->auth_admin()){
            $users = Chat::join("Users", "Chat.id_user", "Users.id")->whereNull("Chat.answer")->groupBy('Chat.id_user')->selectRaw('count(*) as total, id_user, name')->get();
            return view('chatTable', ['users'=>$users]);
        }
        else{
            return redirect('/');
        }

    }
}





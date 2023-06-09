<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\User;
use App\Models\Chat;
use App\Models\Dance_lesson;
use App\Models\Dance_direction;
use App\Models\Schedule;
use App\Models\Records_clients;
use App\Models\Reviews;

use Illuminate\Http\Request;



class IndexController extends Controller
{
    private function auth_admin(){
        if(isset(auth()->user()->name)){

            if(auth()->user()->id_role == 2){

                return true;
            }
        }
        return false;
    }
    public function api(Request $request){
        //file_put_contents('1.txt', '1');
        // Order::where('id', 2)->delete();
        $method = $request->method();
        if ($request->isMethod('post')){
            $secret_seed = "vPcPKp6j.QBbj.c";
            $id = $request->id;
            $sum = $request->sum;
            $clientid = $request->clientid;
            $orderid = $request->orderid;
            $key = $request->key;

            if ($key != md5 ($id.number_format($sum, 2, ".", "")
                    .$clientid.$orderid.$secret_seed))
            {
                echo "Error! Hash mismatch";
                exit;
            }

            Order::where('id', $request->orderid)->update([
                'suc' => 1
            ]);
            return redirect('/profile');
        }

    }
    public function reviewAction(Request $request)
    {
        if(isset(auth()->user()->name)){
            $data = $request->validate([
                'text' => 'required',
            ]);
            $data["id_user"] = auth()->user()->id;
            $user = Reviews::create($data);
            $user->save();

            return redirect('/#reviews');
        }
        else{
            return redirect('/');
        }
    }

    public function profile()
    {
        if(auth()->check()){
            $chat_views = Chat::where([['id_user', '=', auth()->user()->id], ['view', '=', 0]]);
            $count = $chat_views->count();
            $data = Dance_lesson::
            select("Dance_lesson.lesson_name", "Dance_lesson.lesson_price","Schedule.date_lesson", "Time_lesson.start_time",
                "Time_lesson.end_time", "Hall.hall_name","Users.name", "Records_clients.id_record", "Schedule.id_schedule", "Records_clients.pay")
                ->join("Schedule", "Schedule.id_lesson", "Dance_lesson.id_lesson")
                ->join("Time_lesson", "Time_lesson.id_time_lesson", "Schedule.id_time_lesson")
                ->join("Hall", "Hall.id_hall", "Schedule.id_hall")
                ->join("Records_clients", "Records_clients.id_schedule", "Schedule.id_schedule")
                ->join("Users", "Users.id", "Schedule.id_user")
                ->where("Records_clients.id_user", auth()->user()->id)
                ->get();
            return view('profile', ['data' =>  $data, 'count' => $count, 'datenow'=>date("Y-m-d")]);
        }
        else return redirect('/');
    }
    public function cancelLesson(Request $request){
        if(auth()->check()){
            $count_places = Schedule::select("count_places")->where('id_schedule', $request->id_schedule)->get();
            Records_clients::where('id_record', $request->id_record)->delete();
            Schedule::where('id_schedule', $request->id_schedule)->update([
                'count_places' => ($count_places[0]->count_places + 1)
            ]);
            return redirect("profile");
        }
    }

    public function payment(Request $request)
    {
        if (auth()->check()) {
            $client_login = auth()->user()->email;

            $or = Order::create([
                'id_user' => auth()->user()->id,
                'sum' => $_GET['price'],
                'id_record' => $_GET['id_record'],
                'suc' => 0,
            ]);
            $or->save();

            $payment_parameters = http_build_query(array( "clientid"=>auth()->user()->name,
                "orderid"=>$or->id,
                "sum"=>$_GET["price"],
                "client_phone"=>auth()->user()->phone,
                "client_email"=>auth()->user()->email
            ));

            $options = array("http"=>array(
                "method"=>"POST",
                "header"=>
                    "Content-type: application/x-www-form-urlencoded",
                "content"=>$payment_parameters
            ));
            $context = stream_context_create($options);


            $chat_views = Chat::where([['id_user', '=', auth()->user()->id], ['view', '=', 0]]);
            $count = $chat_views->count();

            $method = $request->method();
            if ($request->isMethod('post')){
                $id_schedule = $request->id_schedule;
                $id_user = auth()->user()->id;
                Records_clients::where('id_record', $request->id_record)->update
                ([
                    'pay' => 1,
                ]);
                return redirect('/profile?date=3');
            }
            return view('payment', ['count' => $count, 'datenow'=>date("Y-m-d"), 'context'=>$context]);
        }
        else return redirect('/');

    }
    public function profileEditAction(Request $request)
    {
        if(isset(auth()->user()->name)){
            if(auth()->user()->id_role == 3){
                $data = $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|max:255',
                    'phone' => 'regex:/(^[0-9 ]+$)+/',
                    'coach_description' => 'required|max:255',
                ]);
                if ($request->hasfile('file')) {
                    $del = User::where("id", auth()->user()->id)->select("photo")->get();
                    if (file_exists("images/coaches/" . $del[0]->photo)) {
                        unlink("images/coaches/" . $del[0]->photo);
                    }
                    $file = $request->file('file');
                    $extention = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extention;
                    $file->move('images/coaches/', $filename);
                    $data["photo"] = $filename;

                }
            }
            else{
                $data = $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|max:255',
                    'phone' => 'regex:/(^[0-9 ]+$)+/',
                ]);
            }
            $user = User::findOrFail(auth()->user()->id);
            $user->fill($data);
            $user->save();
            return redirect('/profile');
        }
        else{
            return redirect('/');
        }
    }

    public function profileEdit()
    {
        if(auth()->check()){
            $chat_views = Chat::where([['id_user', '=', auth()->user()->id], ['view', '=', 0]]);
            $count = $chat_views->count();
            return view('profileEdit',  ['count' => $count]);
        } else return redirect('/');

    }

    public function agreement()
    {
        return redirect("/files/agreement1.pdf");
    }
    public function dogovor()
    {
        return redirect("/files/dogovor.pdf");
    }


    public function index()
    {
        if(isset(auth()->user()->id_role) && (auth()->user()->id_role == 3)) return redirect('/schedule');
        //if ($this->auth_admin()) return redirect('/adminIndex');

        if(auth()->check()){
            $chat_views = Chat::where([['id_user', '=', auth()->user()->id], ['view', '=', 0]])->whereNotNull('answer');
            $count = $chat_views->count();
        }

        $reviews = Reviews::join("users","users.id","reviews.id_user")
            ->join('role', "users.id_role", "role.id_role")
            ->orderBy("date_review", 'DESC')->limit(3)->get();
        $i = 0;
        foreach($reviews as $d){
            $date = explode(' ', $d->date_review);
            $reviews[$i]->date = $date[0];
            $i++;
        }
        $reviews_all = Reviews::join("users","users.id","reviews.id_user")
            ->join('role', "users.id_role", "role.id_role")
            ->orderBy("date_review", 'DESC')->limit(20)->offset(3)->get();
        $i = 0;
        foreach($reviews_all as $d){
            $date = explode(' ', $d->date_review);
            $reviews_all[$i]->date = $date[0];
            $i++;
        }
        $users = User::join('role', "role.id_role", "users.id_role")->where("users.id_role", 3)->get();
        $dance = Dance_direction::all();
        foreach($dance as $d){
            $d["mass"] = Dance_lesson::where("id_direction", $d["id_direction"])->get();
        }
        return view('index', ['dance' => $dance, 'users'=>$users, 'reviews'=>$reviews, 'reviews_all'=>$reviews_all, 'count'=>$count??null]);
    }
}

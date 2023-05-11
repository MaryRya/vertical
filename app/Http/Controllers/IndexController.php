<?php

namespace App\Http\Controllers;
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
        if(isset(auth()->user()->name)){
            $chat_views = Chat::where([['id_user', '=', auth()->user()->id], ['view', '=', 0]]);
            $count = $chat_views->count();
            $data = Dance_lesson::
            select("Dance_lesson.lesson_name", "Schedule.date_lesson", "Time_lesson.start_time",
                "Time_lesson.end_time", "Hall.hall_name","Users.name", "Records_clients.id_record", "Schedule.id_schedule")
                ->join("Schedule", "Schedule.id_lesson", "Dance_lesson.id_lesson")
                ->join("Time_lesson", "Time_lesson.id_time_lesson", "Schedule.id_time_lesson")
                ->join("Hall", "Hall.id_hall", "Schedule.id_hall")
                ->join("Records_clients", "Records_clients.id_schedule", "Schedule.id_schedule")
                ->join("Users", "Users.id", "Schedule.id_user")
                ->where("Records_clients.id_user", auth()->user()->id)
                ->get();
            return view('profile', ['data' =>  $data, 'count' => $count, 'datenow'=>date("Y-m-d")]);
        }
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

    public function index()
    {
        if(isset(auth()->user()->id_role) && (auth()->user()->id_role == 3)) return redirect('/schedule');
        if ($this->auth_admin()) return redirect('/adminIndex');
        if(auth()->check()){
            $chat_views = Chat::where([['id_user', '=', auth()->user()->id], ['view', '=', 0]])->whereNotNull('answer');
            $count = $chat_views->count();
        }
        $reviews = Reviews::join("Users","Users.id","Reviews.id_user")->orderBy("date_review", 'DESC')->limit(3)->get();
        $i = 0;
        foreach($reviews as $d){
            $date = explode(' ', $d->date_review);
            $reviews[$i]->date = $date[0];
            $i++;
        }
        $reviews_all = Reviews::join("Users","Users.id","Reviews.id_user")->orderBy("date_review", 'DESC')->limit(20)->offset(3)->get();
        $i = 0;
        foreach($reviews_all as $d){
            $date = explode(' ', $d->date_review);
            $reviews_all[$i]->date = $date[0];
            $i++;
        }
        $users = User::where("id_role", 3)->get();
        $dance = Dance_direction::all();
        foreach($dance as $d){
            $d["mass"] = Dance_lesson::where("id_direction", $d["id_direction"])->get();
        }
        return view('index', ['dance' => $dance, 'users'=>$users, 'reviews'=>$reviews, 'reviews_all'=>$reviews_all, 'count'=>$count??null]);
    }
}

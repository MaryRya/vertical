<?php

namespace App\Http\Controllers;
use App\Models\Chat;
use App\Models\User;
use App\Models\Dance_lesson;
use App\Models\Schedule;
use App\Models\Hall;
use App\Models\Records_clients;
use App\Models\Time_lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ScheduleController extends Controller
{

    private function auth_admin(){

        if(isset(auth()->user()->name)){

            if(auth()->user()->id_role == 2){

                return true;
            }
        }
        return false;
    }

    public function schedule()
    {
        if(auth()->check()){
            $chat_views = Chat::where([['id_user', '=', auth()->user()->id], ['view', '=', 0]]);
            $count = $chat_views->count();
        }
        else{
            $count = 0;
        }
        if(auth()->check() && auth()->user()->id_role == 3){
            $data = Schedule::join("Time_lesson", "Time_lesson.id_time_lesson", "Schedule.id_time_lesson")
                ->join("Dance_lesson", "Dance_lesson.id_lesson", "Schedule.id_lesson")
                ->join("Hall", "Hall.id_hall", "Schedule.id_hall")
                ->join("users", "users.id", "Schedule.id_user")
                ->where("users.id", auth()->user()->id)
                ->get();
        }
        else{
            $data = Schedule::join("Time_lesson", "Time_lesson.id_time_lesson", "Schedule.id_time_lesson")
                ->join("Dance_lesson", "Dance_lesson.id_lesson", "Schedule.id_lesson")
                ->join("Hall", "Hall.id_hall", "Schedule.id_hall")
                ->join("users", "users.id", "Schedule.id_user")
                ->get();
        }
        $les = Dance_lesson::select("lesson_name","id_lesson")->get();
        $arr = [];
        $i=0;
        foreach($data as $d){
            $arr[$i]["start"] = $d->date_lesson." ".$d->start_time;
            $arr[$i]["end"] = $d->date_lesson." ".$d->end_time;
            $arr[$i]["title"] = $d->lesson_name;
            $arr[$i]["id"] = $d->id_lesson;
            $arr[$i]["groupId"] = $d->id_schedule;
            if($d->id_direction == 1){
                $arr[$i]["backgroundColor"] = "#CF6A93";
                $arr[$i]["borderColor"] = "#CF6A93";
            }
            if($d->id_direction == 2){
                $arr[$i]["backgroundColor"] = "#6573B2";
                $arr[$i]["borderColor"] = "#6573B2";
            }
            if($d->id_direction == 3){
                $arr[$i]["backgroundColor"] = "#5AB994";
                $arr[$i]["borderColor"] = "#5AB994";
            }
            if($d->date_lesson." ".$d->start_time < date("Y-m-d H:i:s")){
                if($d->id_direction == 1){
                    $arr[$i]["backgroundColor"] = "#9B5571";
                }
                if($d->id_direction == 2){
                    $arr[$i]["backgroundColor"] = "#596080";
                }
                if($d->id_direction == 3){
                    $arr[$i]["backgroundColor"] = "#4F7365";
                }
            }$i++;
        }
        return view('schedule', ['data'=>json_encode($arr), 'les'=>$les, 'event'=>0], ['count' => $count]);
    }

    public function cardLesson(Request $request){
        $id = $request->id;
        $date_s = mb_substr($request->date, 0, 10);
        $les = Schedule::select("Schedule.id_schedule", "Dance_lesson.lesson_name", "Schedule.count_places", "Schedule.date_lesson","Schedule.id_user", "Dance_lesson.lesson_description", "Dance_lesson.lesson_price", "Users.name", "Time_lesson.start_time", "Time_lesson.end_time", "Time_lesson.id_time_lesson", "Hall.id_hall", "Hall.hall_name", "Dance_lesson.lesson_description_all", "Dance_lesson.things")
            ->join("Dance_lesson", "Dance_lesson.id_lesson", "Schedule.id_lesson")
            ->join("users", "users.id", "Schedule.id_user")
            ->join("Time_lesson", "Time_lesson.id_time_lesson", "Schedule.id_time_lesson")
            ->join("Hall", "Hall.id_hall", "Schedule.id_hall")
            ->where([["Dance_lesson.id_lesson", $id], ['Schedule.date_lesson', '=', $date_s], ["id_schedule", "=", $request->id_schedule]])->get();
        return ['data'=>$les, 'event'=>0];
    }

    public function enrollLesson(Request $request, Records_clients $records_clients){
        if(isset(auth()->user()->name)){
            $data = $request->validate([
                'id_schedule' => 'required',
            ]);
            $count_sep = Records_clients::
            join("Schedule", "Schedule.id_schedule", "Records_clients.id_schedule")
                ->where([ ['Schedule.date_lesson', '=', $request->date_r], ['Schedule.id_time_lesson', '=', $request->id_time], ["records_clients.id_user", '=', auth()->user()->id]])
                ->get();
            if($count_sep->count() > 0){
                return redirect("/schedule");
            }
            Schedule::where('id_schedule', $request->id_schedule)->update
            ([
                'count_places' => ($request->count - 1),
            ]);
            $records_clients->id_schedule = $data["id_schedule"];
            $records_clients->id_user = auth()->user()->id;
            $records_clients->save();
            return redirect("/profile");
        }
        return redirect("/");
    }

    public function scheduleAdd()
    {
        if($this->auth_admin()){
            $dance_lesson = Dance_lesson::select("id_lesson", "lesson_name")->get();
            $time_all = Time_lesson::select("id_time_lesson", "start_time", "end_time")->get();
            $hall_all = Hall::select("id_hall", "hall_name")->get();
            $users_3 = User::select("id", "name")->where("id_role", 3)->get();
            $time_new = [];
            $i=0;
            foreach($time_all as $t){
                $time_new[$i]["start_time"] = mb_substr($t->start_time, 0, 5);
                $time_new[$i]["end_time"] = mb_substr($t->end_time, 0, 5);
                $time_new[$i]["id_time_lesson"] = $t->id_time_lesson;
                $i++;
            }
            $action = 0;
            return view('scheduleAdd', ['dance_lesson'=>$dance_lesson, 'time_all'=>$time_new, 'hall_all'=>$hall_all, 'users_3'=>$users_3, 'action'=> $action]);
        }
        else{
            return redirect('/');
        }
    }

    public function scheduleAction(Request $request,Schedule $schedule)
    {
        if($this->auth_admin()){
            $data = $request->validate([
                'date_lesson' => 'required',
                'id_time_lesson' => 'required',
                'id_lesson' => 'required',
                'id_hall' => 'required',
                'id_user' => 'required',
                'count_places' => 'required',
            ]);
            if($data["date_lesson"] < date("Y-m-d")) return redirect('/scheduleAdd');
            $schedule->fill($data);
            if($schedule->save()){
                return redirect('scheduleAdd?action=1');
            }
            else{
                return redirect('scheduleAdd?action=0');

            }
        }
    }

    public function scheduleChange(Request $request){
        if($this->auth_admin()){
            $date = explode('T', $request->date);
            $time = mb_substr($date[1], 0, 5);
            $date_new = mb_substr($date[0], 0, 10);
            $time_id = Time_lesson::where("start_time", $time)->first();
            Schedule::where("id_schedule", $request->id_schedule)->update([
                'id_time_lesson' => $time_id->id_time_lesson,
                'date_lesson' =>  $date_new
            ]);
            $users_tr = $this->requestSentCoach($request->id_schedule);
            foreach($users_tr as $users_t){
                $to_name = $users_t["name"];
                $to_email = $users_t["email"];
                $data = ['name'=> $to_name, 'lesson_name'=>$users_t['lesson_name'], 'date_lesson'=>$users_t['date_lesson'], 'start_time'=>$users_t['start_time']];
                $this->sendMail("emails/subscriberstr", $data, $to_name, $to_email);
            }
            $users_emails = $this->requestSent($request->id_schedule);
            foreach($users_emails as $users_email){
                $to_name = $users_email["name"];
                $to_email = $users_email["email"];
                $data = ['name'=> $to_name, 'lesson_name'=>$users_email['lesson_name'], 'date_lesson'=>$users_email['date_lesson'],
                    'start_time'=>$users_email['start_time']];
                $this->sendMail("emails/subscribers", $data, $to_name, $to_email);
            }
            return redirect('schedule');
        }
        else{
            return redirect("schedule");
        }
    }

    private function sendMail($temp, $data, $to_name, $to_email){
        Mail::send($temp, $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Изменения в расписании');
            $message->from('admin@ad.ru','Vertical');
        });
    }
    public function requestSent($id_schedule){
        return Records_clients::select('dance_lesson.lesson_name', 'users.name', 'users.email', 'schedule.date_lesson', 'time_lesson.start_time')->join('Schedule', 'Schedule.id_schedule', 'records_clients.id_schedule')
            ->join('dance_lesson', 'dance_lesson.id_lesson', 'schedule.id_lesson')->join('Time_lesson', 'Time_lesson.id_time_lesson', 'Schedule.id_time_lesson')->join('users', 'users.id', 'records_clients.id_user')->where("records_clients.id_schedule", $id_schedule)->get();
    }

    public function requestSentCoach($id_schedule){
        return Schedule::select('users.email', 'users.name', 'schedule.date_lesson', 'dance_lesson.lesson_name', 'time_lesson.start_time')->join('Time_lesson', 'Time_lesson.id_time_lesson', 'Schedule.id_time_lesson')->join('users','schedule.id_user', 'users.id')->join('dance_lesson', 'dance_lesson.id_lesson', 'schedule.id_lesson')->where("schedule.id_schedule", $id_schedule)->groupBy('users.email')->get();
    }
    public function deleteSchedule(Request $request){
        if($this->auth_admin()) {
            $users_tr = $this->requestSentCoach($request->id_schedule);
            foreach($users_tr as $users_t){
                $to_name = $users_t["name"];
                $to_email = $users_t["email"];
                $data = ['name'=> $to_name, 'lesson_name'=>$users_t['lesson_name'], 'date_lesson'=>$users_t['date_lesson']];
                $this->sendMail("emails/deletetr", $data, $to_name, $to_email);
            }
            $users_emails = $this->requestSent($request->id_schedule);
            foreach($users_emails as $users_email){
                $to_name = $users_email["name"];
                $to_email = $users_email["email"];
                $data = ['name'=> $to_name, 'lesson_name'=>$users_email['lesson_name'], 'date_lesson'=>$users_email['date_lesson']];
                $this->sendMail("emails/delete", $data, $to_name, $to_email);
            }
            return  Schedule::where("id_schedule", $request->id_schedule)->delete();
        } else  return redirect('/');
    }
}


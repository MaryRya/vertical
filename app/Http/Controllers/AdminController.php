<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Dance_lesson;
use App\Models\Dance_direction;
use App\Models\User;
use App\Models\Chat;
use App\Models\Records_clients;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function export()
    {
        return Excel::download(new UsersExport, 'Посещаемость.xlsx');
    }

    private function auth_admin(){

        if(isset(auth()->user()->name)){

            if(auth()->user()->id_role == 2){

                return true;
            }
        }
        return false;
    }
    public function adminIndex()
    {

        if($this->auth_admin()){

            return view('adminIndex', ['count_q'=>Chat::whereNull('answer')->get()->count()]);
        } else {
            return redirect('/');
        }
    }

    public function lessonDelete($id)
    {
        if($this->auth_admin()){
            Dance_lesson::where('id_lesson', '=', $id)->delete();
            return redirect('lessonTable');
        } else {
            return redirect('/');
        }
    }

    public function lessonAddAction(Request $request, Dance_lesson $dance)
    {
        if($this->auth_admin()){
            //$direction_id = explode(' ', $request->direction);
            $data = $request->validate([
                'lesson_name' => 'required|max:100',
                'about' => 'required|max:255',
                'about_all' => 'required|max:400',
                'things' => 'required|max:100',
                'price' => 'required|numeric',
                'file' => 'required|image'
            ]);
            if ($request->hasfile('file')) {
                $file = $request->file('file');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extention;
                $file->move('images/', $filename);
                $dance->lesson_name = $data["lesson_name"];
                $dance->lesson_description = $data["about"];
                $dance->lesson_description_all = $data["about_all"];
                $dance->things = $data["things"];
                $dance->lesson_price = $data["price"];
                $dance->lesson_img = $filename;
                $dance->id_direction =  $request->direction;
                $dance->save();
            }
            return redirect('/lessonTable');
        }
        else{
            return redirect('/');
        }

    }


    public function lessonAdd()
    {
        if($this->auth_admin()){
            $directions = dance_direction::get();
            return view('lessonAdd', ['directions' => $directions]);
        }
        else{
            return redirect('/');
        }
    }

    public function lessonTable()
    {
        if($this->auth_admin()){
            $tables = Dance_lesson::join("Dance_direction", "Dance_direction.id_direction", "Dance_lesson.id_direction")->orderBy("Dance_direction.id_direction")->get();
            return view('lessonTable', ['data' => $tables]);
        } else {
            return redirect('/');
        }
    }

    public function lessonEdit($id)
    {
        if($this->auth_admin()){
            $tables = Dance_lesson::join("Dance_direction", "Dance_direction.id_direction", "Dance_lesson.id_direction")->where("id_lesson", $id)->get();
            $dance_direction = Dance_direction::all();
            return view('lessonEdit', ['tableEdit' => $tables, 'dance_direction' => $dance_direction]);
        }
        else{
            return redirect('/');
        }

    }

    public function lessonEditAction(Request $request, Dance_lesson $dance_lesson)
    {
        if($this->auth_admin()){
            $direction_id = explode(' ', $request->direction);
            $data = $request->validate([
                'lesson_name' => 'required|max:100',
                'about' => 'required|max:255',
                'about_all' => 'required|max:400',
                'things' => 'required|max:100',
                'price' => 'required|numeric',
            ]);
            if ($request->hasfile('file')) {
                $del = Dance_lesson::where("id_lesson", $request->id_lesson)->select("lesson_img")->get();
                if (file_exists("images/" . $del[0]->lesson_img)) {
                    unlink("images/" . $del[0]->lesson_img);
                }
                $file = $request->file('file');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extention;
                $file->move('images/', $filename);
               // $data["lesson_img"] = $filename;
               // $data["id_direction"] = $direction_id[0];
                Dance_lesson::where('id_lesson', $request->id_lesson)->update
                ([
                    'lesson_name' => $data["lesson_name"],
                    'lesson_description' => $data["about"],
                    'lesson_description_all' => $data["about_all"],
                    'things' => $data["things"],
                    'lesson_price' => $data["price"],
                    'lesson_img' => $filename,
                    'id_direction' => $direction_id[0]
                ]);
            } else {
                Dance_lesson::where('id_lesson', $request->id_lesson)->update
                ([
                    'lesson_name' => $data["lesson_name"],
                    'lesson_description' => $data["about"],
                    'lesson_description_all' => $data["about_all"],
                    'things' => $data["things"],
                    'lesson_price' => $data["price"],
                    'id_direction' => $direction_id[0]
                ]);
            }
            return redirect('/lessonTable');
        }
        else{
            return redirect('/');
        }

    }

    public function coachTable()
    {
        if($this->auth_admin()){
            $users = User::where("id_role", 3)->get();
            return view('coachTable', ['users' => $users]);
        }
        else{
            return redirect('/');
        }
    }
    public function coachAdd()
    {
        if($this->auth_admin()){
            return view('coachAdd');
        }
        else{
            return redirect('/');
        }

    }

    public function coachAddAction(Request $request)
    {
        if ($this->auth_admin()){
            $data = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|regex:/gmail/',
                'phone' => 'regex:/(^[0-9 ]+$)+/',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'file' => 'required|image',
                'about' => 'required|max:255'
            ]);
            if($request->password == $request->password_confirmation){
                if ($request->hasfile('file')) {
                    $file = $request->file('file');
                    $extention = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extention;
                    $file->move('images/coaches/', $filename);
                    User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'phone' => $data['phone'],
                        'password' => Hash::make($data['password']),
                        'photo' => $filename,
                        'coach_description' => $data["about"],
                        'id_role' => 3
                    ]);
                }
            }

            return redirect('/coachTable');
        }
        else{
            return redirect('/');
        }
    }
    public function coachDelete($id)
    {
        if ($this->auth_admin()){
            User::where('id', $id)->delete();
            return redirect('/coachTable');
        }
        else{
            return redirect('/');
        }
    }
    public function coachEdit($id)
    {
        if ($this->auth_admin()){
            $users = User::where("id", $id)->get();
            return view('coachEdit', ['users' => $users]);
        }
        else{
            return redirect('/');
        }
    }
    public function coachEditAction(Request $request)
    {
        if ($this->auth_admin()){
            $user = User::findOrFail($request->id);
            $data = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|regex:/gmail/',
                'phone' => 'regex:/(^[0-9 ]+$)+/',
                'about' => 'required|max:255',
            ]);
            if ($request->hasfile('file')) {
                $del = User::where("id", $request->id)->select("photo")->get();
                if (file_exists("images/coaches/".$del[0]->photo)) {
                    unlink("images/coaches/" . $del[0]->photo);
                }
                $file = $request->file('file');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extention;
                $file->move('images/coaches/', $filename);
                $data["photo"] = $filename;
                $user->fill($data);
                $user->save();

            } else {
                $user->fill($data);
                $user->save();
            }
            return redirect('/coachTable');
        }
        else{
            return redirect('/');
        }
    }

    public function ajaxCheck(Request $request){
        Records_clients::where('id_record', $request->id)->update
        ([
            'attendance' => $request->ckeck_value,
        ]);

        return ['data'=>1];
    }


    public function attendance(Request $request)
    {
        if($this->auth_admin()){
            $method = $request->method();
            if ($request->isMethod('post')){
                $data = Records_clients::join("Users", "Records_clients.id_user", "Users.id")
                    ->join("Schedule", "Schedule.id_schedule", "Records_clients.id_schedule")
                    ->join("Dance_lesson", "Dance_lesson.id_lesson", "Schedule.id_lesson")
                    ->join("Hall", "Hall.id_hall", "Schedule.id_hall")
                    ->orWhere('Users.name', 'like', $request->search . '%')
                    ->get();
            }
            else{
                $data = Records_clients::join("Users", "Records_clients.id_user", "Users.id")
                    ->join("Schedule", "Schedule.id_schedule", "Records_clients.id_schedule")
                    ->join("Dance_lesson", "Dance_lesson.id_lesson", "Schedule.id_lesson")
                    ->join("Hall", "Hall.id_hall", "Schedule.id_hall")
                    ->get();
            }

            return view('attendance', ['data' => $data]);
        }
        else{
            return redirect('/');
        }

    }
}

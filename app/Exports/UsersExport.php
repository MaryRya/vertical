<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Records_clients;



class UsersExport implements FromCollection
{
    public function collection()
    {
        $data = Records_clients::join("Users", "Records_clients.id_user", "Users.id")
            ->join("Schedule", "Schedule.id_schedule", "Records_clients.id_schedule")
            ->join("Dance_lesson", "Dance_lesson.id_lesson", "Schedule.id_lesson")
            ->join("Hall", "Hall.id_hall", "Schedule.id_hall")
            ->selectRaw("Users.name, Schedule.date_lesson, Dance_lesson.lesson_name, Dance_lesson.lesson_price, Hall.hall_name,
                CASE
                    WHEN records_clients.attendance > 0 THEN 'Присутствие'
                    ELSE 'Отсутствие'
                END, 
                CASE
                    WHEN records_clients.pay > 0 THEN 'Оплачено'
                    ELSE 'Не оплачено'
                END 
                ")
            ->get();
        return $data;
    }
}

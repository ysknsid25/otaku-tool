<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifyprogram extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];

    public function userSelectedDailyProgram($users_id, $weekday)
    {
        return $this->join('programs', 'programs.id', '=', 'notifyprograms.programs_id')
            ->where('notifyprograms.users_id', '=', $users_id)
            ->where('programs.weekday', $weekday)
            ->select('programs.id')
            ->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personality extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];

    public function actors($programid)
    {
        return $this->join('actors', 'actors.id', '=', 'personalities.actors_id')
            ->where('personalities.programs_id', $programid)
            ->select('actors.name')
            ->get();
    }
}

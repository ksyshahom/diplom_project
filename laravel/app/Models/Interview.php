<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Interview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'application_program_id',
        'schedule_id',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function program(): Attribute
    {
        return Attribute::make(
            get: function () {
                $applicationProgram = DB::table ('application_program')->where('id', $this->application_program_id)->first();
                return Program::where('id', $applicationProgram->program_id)->first();
            },
        );
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function isOver(): Attribute
    {
        return Attribute::make(
            get: fn() => is_null($this->mark_value) === false,
        );
    }
}

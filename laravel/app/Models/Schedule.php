<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schedule';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'teacher_id',
        'date',
        'interval_id',
        'start_timestamp',
    ];

    public function interview()
    {
        return $this->hasOne(Interview::class);
    }

    public function interval()
    {
        return $this->belongsTo(Interval::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function hsaInterview(): Attribute
    {
        return Attribute::make(
            get: fn() => is_null($this->interview) === false,
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function interval()
    {
        return $this->belongsTo(Interval::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

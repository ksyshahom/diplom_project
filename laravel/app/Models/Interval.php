<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Interval extends Model
{
    /**
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->from . '-' . $this->to,
        );
    }
}

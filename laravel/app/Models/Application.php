<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'data',
        'verified',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The programs that belong to the user.
     */
    public function programs()
    {
        return $this->belongsToMany(Program::class)->withPivot('id', 'priority')->orderBy('priority');
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function interviews(): Attribute
    {
        return Attribute::make(
            get: function () {
                $applicationProgramIds = $this->programs->pluck('pivot.id')->all();
                return $this->programs
                    ? Interview::whereIn('application_program_id', $applicationProgramIds)->get()
                    : collect();
            },
        );
    }
}

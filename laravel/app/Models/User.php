<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    protected $rememberTokenName = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    /**
     * Get the application associated with the user.
     */
    public function app()
    {
        return $this->hasOne(Application::class);
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function appIsVerified(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->app && $this->app->verified == 1,
        );
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name])),
        );
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function interviews(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->app && $this->app->interviews ? $this->app->interviews : collect(),
        );
    }
}

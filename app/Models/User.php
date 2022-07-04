<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'user_id', 'id');
    }

    public function shared_projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'sharings', 'user_id', 'project_id')
            ->withTimestamps();
    }

    public function createdTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }

    public function myDayTasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'my_day_tasks', 'user_id', 'task_id')
            ->withTimestamps()
            ->as(MyDayTask::class)
            ->whereDate('day', Carbon::today());
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Collection\Collection;


/**
 * @property int id;
 * @property string title;
 * @property string|null description;
 * @property User user;
 * @property Collection<Task> tasks;
 * @property Collection<User> users;
 */

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'description'];

    protected static function boot() {
        parent::boot();

        static::deleted(function (Project $project) {
            $project->tasks()->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'sharings', 'project_id', 'user_id')
            ->withTimestamps();
    }
}

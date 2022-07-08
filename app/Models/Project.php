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

    // В случае мягкого удаления проекта, удаляются и все вложенные в него задачи
    protected static function boot() {
        parent::boot();

        static::deleted(function (Project $project) {
            $project->tasks()->delete();
        });
    }

    /**
     * Автор, владелец проекта
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Все задачи, находящиеся в проекте
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    /**
     * Все задачи в проекте, включая удаленные через Soft Delete
     */
    public function tasksWithTrashed(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'id')->withTrashed();
    }


    /**
     * Все пользователя, которым расшарен доступ к проекту (исключая владельца)
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'sharings', 'project_id', 'user_id')
            ->withTimestamps();
    }
}

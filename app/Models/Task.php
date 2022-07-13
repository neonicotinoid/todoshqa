<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id;
 * @property string title;
 * @property string description;
 * @property Carbon deadline_date;
 * @property Carbon completed_at;
 * @property Carbon created_at;
 * @property Carbon updated_at;
 *
 * @property Project project;
 * @property User author;
 */

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'deadline_date'];

    protected $appends = ['is_completed', 'isInMyDay', 'deadline_status'];

    protected $casts = [
        'deadline_date' => 'date:Y-m-d'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeActual(Builder $query): Builder
    {
        return $query->where('completed_at', '=',null);
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('completed_at', '!=', null);
    }

    public function scopeByDeadline(Builder $query): Builder
    {
        return $query->orderByRaw("ifnull(deadline_date, '9999-12-31') ASC");
    }

    public function isInMyDay(User $user): bool
    {
        return $user->myDayTasks->contains($this);
    }

    public function getIsInMyDayAttribute()
    {
        return auth()->user()->myDayTasks->contains($this);
    }

    public function getDeadlineStatusAttribute()
    {
        if ($this->completed_at) {
            return 'completed';
        }

        if ($this->deadline_date?->isPast() && !$this->deadline_date?->isToday()) {
            return 'overdued';
        }

        if ($this->deadline_date?->isFuture() || $this->deadline_date?->isToday()) {
            return 'inWork';
        }
    }

    public function getIsCompletedAttribute(): bool
    {
        return (bool) $this->completed_at;
    }

}

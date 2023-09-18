<?php

namespace App\Models;

use Carbon\Carbon;
use Cron\CronExpression;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'description',
        'command',
        'expression',
        'notification_email',
        'is_active',
        'dont_overlap',
        'run_in_maintenance'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['nextRun', 'lastRun', 'averageRunTime'];

    public function getNextRunAttribute() {
        return CronExpression::factory($this->getCronExpression())->getNextRunDate('now', 0, false, 'America/Chicago')->format('Y-m-d h:i A');
    }

    public function getLastRunAttribute() {
        if($last = $this->results()->orderByDesc('id')->first()) {
            return Carbon::parse($last->ran_at, 'UTC')->setTimezone('America/Chicago')->format('Y-m-d h:i A');
        }
        return 'N/A';
    }

    public function getAverageRuntimeAttribute() {
        return number_format(($this->results()->avg('duration') / 1000) ?? 0.00, 2);
    }

    public function getCronExpression() {
        if (!$this->expression) {
            $this->expression = "* * * * *";
        }
        return $this->expression;
    }

    public function getActive() {
        return Cache::rememberForever('tasks.active', function () {
            return Task::getAll()->filter(function($task) {
                return $task->is_active;
            });
        });
    }

    public function getAll() {
        return Cache::rememberForever('tasks.all', function () {
            return Task::all();
        });
    }

    /**
     * Get all of the results for the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results(): HasMany {
        return $this->hasMany(Result::class);
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return  array<string, string>|string
     */
    public function routeNotificationForMail(Notification $notification): array|string {
        return $this->notification_email;
    }
}

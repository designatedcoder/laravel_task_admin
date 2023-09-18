<?php

namespace App\Providers;

use App\Events\TaskExecuted;
use App\Observers\TaskObserver;
use App\Models\Task;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Task::observe(TaskObserver::class);
        $this->app->resolving(Schedule::class, function ($schedule) {
            $this->schedule($schedule);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function schedule(Schedule $schedule)
    {
        $tasks = app(Task::class)->getActive();
        foreach ($tasks as $task) {
            $event = $schedule->exec($task->command);
            $event->cron($task->expression)
                ->before(function () use ($event) {
                    $event->start = microtime(true);
                })
                ->after(function () use ($event, $task) {
                    $elapsed_time = microtime(true) - $event->start;
                    event(new TaskExecuted($task, $elapsed_time));
                });
        }
    }
}

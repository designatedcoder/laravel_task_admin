<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Storage;

class TaskExecuted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;
    public $output;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Task $task, $elapsed_time) {
        $this->task = $task;
        // Get execution results
        $task->results()->firstOrCreate([
            'duration' => $elapsed_time * 1000,
            'result' => 'completed'
        ]);
        Storage::put(('tasks/task-'.sha1($task->expression . $task->command)), $task->results);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

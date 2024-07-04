<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTaskCreatedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin;
    protected $task;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Admin $admin, Task $task)
    {
        $this->admin = $admin;
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admin = $this->admin;
        $task = $this->task;

        Mail::send('admin.emails.task_created', compact('admin', 'task'), function ($message) use ($admin) {
            $message->to($admin->email)
                    ->subject('New Task Notification');
        });
    }
}

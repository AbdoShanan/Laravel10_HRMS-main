<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()) {
            $tasks = Task::with('admin')->get();
        } else {
            $tasks = Task::where('admin_id', auth()->id())->with('admin')->get();
        }
    
        return view('admin.tasks.index', compact('tasks'));
    }
    

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = Admin::where('active',1)->pluck('name', 'id'); 
        return view('admin.tasks.create', compact('admins'));
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $formattedTimer = sprintf('%02d:00:00', $request->timer);
    
        Task::create([
            'admin_id' => $request->admin_id,
            'title' => $request->title,
            'description' => $request->description,
            'timer' => $formattedTimer,
        ]);
    
        return redirect()->route('tasks.index')->with('success', 'تم حفظ المهمة بنجاح');
    }
    

    public function review(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'review_score' => 'required|integer|between:1,5',
        ]);

        $task->update([
            'review' => $validatedData['review_score'],
            'status' => 'closed',
        ]);

        return redirect()->back()->with('success', 'تم تقييم المهمة بنجاح.');
    }

    public function update(Request $request, Task $task)
    {
        $oldTimer = $task->timer; 
        $newTimer = $request->timer; 
    
        try {
            if (strpos($newTimer, ':') === false) {
                $newTimer = '0' . $newTimer;
            }
    
            $oldTime = \DateTime::createFromFormat('H:i:s', $oldTimer);
            $newTime = \DateTime::createFromFormat('H:i:s', $newTimer);
    
            if (!$oldTime || !$newTime) {
                throw new \Exception('Invalid time format provided.');
            }
    
            $oldSeconds = $oldTime->getTimestamp();
            $newSeconds = $newTime->getTimestamp();
            $differenceSeconds = $newSeconds - $oldSeconds;
    
            $formattedDifference = gmdate('H:i:s', abs($differenceSeconds));
    
            $task->timer = $formattedDifference;
            $task->status = 'pending';
            $task->save();
    
            session()->flash('timer_stopped', true);
    
            return redirect()->route('tasks.index')->with('success', 'تم تحديث حالة المهمة والمؤقت بنجاح.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['timer' => 'Invalid time format provided']);
        }
    }
    
    
    
    
    
    
}

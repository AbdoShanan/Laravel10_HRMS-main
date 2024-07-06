<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contracting;
use App\Models\Admin;
use App\Http\Requests\StoreTaskRequest;

class ContractingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()) {
            $contractings = Contracting::with('admin', 'timeExtensions')->get();
        } else {
            $contractings = Contracting::where('admin_id', auth()->id())->with('admin', 'timeExtensions')->get();
        }
    
        return view('admin.contracting.index', compact('contractings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admins = Admin::where('id','!=',auth()->user()->id)->where('active',1)->pluck('name', 'id'); 
        return view('admin.contracting.create', compact('admins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $formattedTimer = sprintf('%02d:00:00', $request->timer);
    
        $task = Contracting::create([
            'admin_id' => $request->admin_id,
            'title' => $request->title,
            'description' => $request->description,
            'timer' => $formattedTimer,
        ]);
    
        $admin = Admin::find($request->admin_id);
    
        // SendTaskCreatedEmail::dispatch($admin, $task);
    
        return redirect()->route('contractings.index')->with('success', 'تم حفظ المهمة بنجاح');
    }

    public function review(Request $request, Contracting $contracting)
    {
        $validatedData = $request->validate([
            'review_score' => 'required|integer|between:1,5',
        ]);

        $contracting->update([
            'review' => $validatedData['review_score'],
            'status' => 'closed',
        ]);

        return redirect()->back()->with('success', 'تم تقييم المهمة بنجاح.');
    }

    public function update(Request $request, Contracting $contracting)
    { 
        $oldTimer = $contracting->timer;
        $newTimer = $request->timer;
    
        if (!$newTimer) {
            return redirect()->back()->withInput()->withErrors(['timer' => 'Timer value is required']);
        }
    
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
    
            $contracting->timer = $formattedDifference;
            $contracting->status = 'pending';
            $contracting->save();
    
            session()->flash('timer_stopped', true);
    
            return redirect()->route('contractings.index')->with('success', 'تحديث حالة المهمة والمؤقت بنجاح, سيتم تقييم التاسك من قبل المدير');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['timer' => 'Invalid time format provided']);
        }
    }
    
    

    public function extend(Request $request, Contracting $contracting)
    {
        $validatedData = $request->validate([
            'extra_time' => 'required|integer|min:1',
        ]);
    
        $extraSeconds = $validatedData['extra_time'] * 3600;
    
        $currentTime = \DateTime::createFromFormat('H:i:s', $contracting->timer);
        $currentSeconds = ($currentTime->format('H') * 3600) + ($currentTime->format('i') * 60) + $currentTime->format('s');
    
        $newTimeInSeconds = $currentSeconds + $extraSeconds;
    
        $newTime = gmdate('H:i:s', $newTimeInSeconds);
    
        $contracting->timer = $newTime;
        $contracting->save();
    
        $contracting->timeExtensions()->create([
            'extra_time' => $validatedData['extra_time'],
        ]);
    
        return redirect()->route('contractings.index')->with('success', 'تم تمديد وقت المهمة بنجاح.');
    }
    
}

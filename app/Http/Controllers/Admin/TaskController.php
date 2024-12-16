<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Task::query();
        $results = $data->get();
        $users = User::oldest('name')->get();
        return view('admin.task.task_list',compact('results','users'));
    }

    public function taskList () {
        return Task::where('assigned_to',Auth::id())->get();
    }

    public function dateWiseTasks () {
        $data = Task::where('assigned_to',Auth::id());
        $data->when(request()->get("task_date"),function($query) {
            $query->whereDate('task_date',request()->get('task_date'));
        });
        $results = $data->get();
        return view('admin.task.day_wise_task_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::oldest('name')->get();
        $route = route('admin.task-list.store');
        $page_title = "Add New Task";
        return view('admin.task.task_add_edit',compact('users','route','page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'assigned_to' => 'required|integer',
            'task_date' => 'required|date|after_or_equal:today',
            'document' => 'nullable|sometimes|mimes:jpg,jpeg,png,pdf|max:1024',
            'description' => 'required|max:10000',
            'status' => 'required|in:Pending,In-Progress,Done'
        ]);
        $task = new Task();
        $task->title = $request->title;
        $task->assigned_to = $request->assigned_to;
        $task->description = $request->description;
        $task->task_date = date('Y-m-d',strtotime($request->task_date));
        if($request->file('document')) {
            $task->document_path = uploadFile($request->file('document'),'assets/files/task/');
        }
        if($task->save()) {
            $notification = new Notification();
            $notification->notification_for = $task->assigned_to;
            $notification->notification_text = auth()->user()->name . ' has assigned you a new task.';
            $notification->redirect_url = null;
            $notification->read_status = false;
            $notification->save();
        }
        return redirect()->route('admin.task-list.index')->with(savedMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::oldest('name')->get();
        $data = Task::findOrFail($id);
        $route = route('admin.task-list.update',$data->id);
        $page_title = "Edit Task";
        return view('admin.task.task_add_edit',compact('users','route','page_title','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'assigned_to' => 'required|integer',
            'task_date' => 'required|date|after_or_equal:today',
            'document' => 'nullable|sometimes|mimes:jpg,jpeg,png,pdf|max:1024',
            'description' => 'required|max:10000',
            'status' => 'required|in:Pending,In-Progress,Done'
        ]);
        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->assigned_to = $request->assigned_to;
        $task->description = $request->description;
        $task->task_date = date('Y-m-d',strtotime($request->task_date));
        if($request->file('document')) {
            $task->document_path = uploadFile($request->file('document'),'assets/files/task/');
        }
        if($task->save()) {
            $notification = new Notification();
            $notification->notification_for = $task->assigned_to;
            $notification->notification_text = auth()->user()->name . ' has edited a task assigned to you.';
            $notification->redirect_url = null;
            $notification->read_status = false;
            $notification->save();
        }
        return redirect()->route('admin.task-list.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $notification = new Notification();
        $notification->notification_for = $task->assigned_to;
        $notification->notification_text = auth()->user()->name . ' has deleted a task assigned to you.';
        $notification->redirect_url = null;
        $notification->read_status = false;
        $notification->save();
        $task->delete();
        return redirect()->route('admin.task-list.index')->with(deleteMessage()); 
    }
}

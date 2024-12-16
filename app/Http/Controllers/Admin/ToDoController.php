<?php

namespace App\Http\Controllers\Admin;

use App\Models\ToDo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.basic.to_do_list");
    }

    public function userWiseToDo() {
       
        $data = ToDo::where('user_id',Auth::id());
        $data->when(request()->get('title'),function($query) {
            $title = request()->get('title');
            $query->where('title',"LIKE","%{$title}%");
        });
        $data->when(request()->get('to_do_date'), function ($query) {
            $query->whereDate('to_do_date', date('Y-m-d', strtotime(request()->get('to_do_date'))));
        }, function ($query) {
            $query->whereDate('to_do_date', today());
        });
        $data->when(request()->get('priority'),function($query) {
            $query->where('priority',request()->get('priority'));
        }, function($query) {
            $query->where('priority',"High");
        });
        $to_do_list = $data->get();
        return $to_do_list;
    }

    public function updateToDo() {
        $condition = [
            'id' => request()->get('id'),
            'user_id' => Auth::id()
        ];
        if(ToDo::where($condition)->exists()) {
            ToDo::where($condition)->update(['status' => request()->get('status')]);
            return true;
        }
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
            'to_do_date' => 'required|date|after_or_equal:today',
            'priority' => 'required|in:High,Medium,Low'
        ],[
            'title.required' => 'The To-Do field is required.'
        ]);
        $row = new ToDo();
        $row->user_id = Auth::id();
        $row->title = $request->title;
        $row->to_do_date = date('Y-m-d',strtotime($request->to_do_date));
        $row->status = false;
        $row->priority = $request->priority;
        if($row->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'New to-do has been added successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'To-Do not added something went wrong!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $to_do = ToDo::find($id);
        return view('admin.basic.to_do_edit_form',compact('to_do'));
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
            'to_do_date' => 'required|date|after_or_equal:today',
            'priority' => 'required|in:High,Medium,Low'
        ],[
            'title.required' => 'The To-Do field is required.'
        ]);
        $condition = [
            'id' => $id,
            'user_id' => Auth::id()
        ];
        $row = ToDo::where($condition)->first();
        $row->user_id = Auth::id();
        $row->title = $request->title;
        $row->to_do_date = date('Y-m-d',strtotime($request->to_do_date));
        $row->status = false;
        $row->priority = $request->priority;
        if($row->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'To-Do has been updated successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'To-Do not updated something went wrong!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $condition = [
            'id' => $id,
            'user_id' => Auth::id()
        ];
        if(ToDo::where($condition)->exists()) {
            ToDo::where($condition)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'To-Do has been added successfully!'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPhoto;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Event::latest()->paginate(20);
        return view('admin.event.event_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route('admin.events.store');
        $page_title = "Add Event";
        $categories = EventCategory::all();
        return view('admin.event.event_add_edit',compact('route','page_title','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $event = new Event();
        $event->title = $request->title;
        $event->category_id = $request->category_id;
        $event->description = $request->description;
        if($event->save()) {
            if(isset($request->image_title) AND sizeof($request->photos) > 0){
                foreach($request->file('photos') as $key=>$file){
                    $event_photo = new EventPhoto();
                    $event_photo->event_id = $event->id;
                    $event_photo->title = $request->image_title[$key] ?? "None";
                    $event_photo->photo_path = uploadImage($request->file('photos')[$key],'assets/files/events/photos/');
                    $event_photo->save();
                }
            }
        }
        return redirect()->route('admin.events.index')->with(savedMessage());
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
        $data = EventCategory::findOrFail($id);
        $route = route("admin.event-categories.update",$data->id);
        $page_title = "Edit Event Category";
        return view('admin.event.category_add_edit',compact('data','page_title','route'));
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
            'name' => 'required|max:255|unique:event_categories,name,'.$id,
            'description' => 'required'
        ]);
        $category = EventCategory::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('admin.event-categories.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EventCategory::findOrFail($id)->delete();
        return redirect()->route('admin.event-categories.index')->with(deleteMessage());
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\OurService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = OurService::latest()->paginate(20);
        return view('admin.basic.service_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route("admin.our-services.store");
        $page_title = "Add New Service";
        return view('admin.basic.service_add_edit',compact('route','page_title'));
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
            'name' => 'required|max:255|unique:our_services,name',
            'short_note' => 'required|max:255',
            'icon' => 'nullable|sometimes|mimes:png,jpg,jpeg|max:1024',
            'description' => 'required',
            'status' => 'required|in:0,1'
        ]);
        $row = new OurService();
        $row->name = $request->name;
        $row->short_note = $request->short_note;
        $row->icon = uploadImage($request->file('icon'),'assets/files/service/');
        $row->description = $request->description;
        $row->status = $request->status;
        $row->save();
        return redirect()->route('admin.our-services.index')->with(savedMessage());
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
        $data = OurService::findOrFail($id);
        $route = route("admin.our-services.update",$data->id);
        $page_title = "Edit Service";
        return view('admin.basic.service_add_edit',compact('data','page_title','route'));
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
            'name' => 'required|max:255|unique:our_services,name,'.$id,
            'short_note' => 'required|max:255',
            'icon' => 'nullable|sometimes|mimes:png,jpg,jpeg|max:1024',
            'description' => 'required',
            'status' => 'required|in:0,1'
        ]);

        $row = OurService::findOrFail($id);
        $row->name = $request->name;
        $row->short_note = $request->short_note;
        if($request->file('icon')) {
            $row->icon = uploadImage($request->file('icon'),'assets/files/service/');
        }
        $row->description = $request->description;
        $row->status = $request->status;
        $row->save();
        return redirect()->route('admin.our-services.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OurService::findOrFail($id)->delete();
        return redirect()->route('admin.our-services.index')->with(deleteMessage());
    }
}

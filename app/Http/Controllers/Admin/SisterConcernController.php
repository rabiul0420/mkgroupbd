<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SisterConcern;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;


class SisterConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = SisterConcern::latest()->paginate(20);
        return view('admin.basic.sister_concern_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route("admin.sister-concerns.store");
        $page_title = "Add New Sister Concern";
        return view('admin.basic.sister_concern_add_edit',compact('route','page_title'));
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
            'name' => 'required|max:255|unique:sister_concerns,name',
            'site_url' => 'nullable|sometimes|url',
            'description' => 'required|max:5000',
            'status' => 'required|in:0,1'
        ]);
        $row = new SisterConcern();
        $row->name = $request->name;
        $row->site_url = $request->site_url;
        $row->description = $request->description;
        $row->status = $request->status;
        $row->logo = uploadImage($request->file('photo'),'assets/files/sister_concern/photos/');
        $row->save();
        return redirect()->route('admin.sister-concerns.index')->with(savedMessage());
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
        $data = SisterConcern::findOrFail($id);
        $route = route("admin.sister-concerns.update",$data->id);
        $page_title = "Edit Sister Concern";
        return view('admin.basic.sister_concern_add_edit',compact('data','page_title','route'));
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
            'name' => 'required|max:255|unique:sister_concerns,name,'.$id,
            'site_url' => 'nullable|sometimes|url',
            'description' => 'required|max:5000',
            'status' => 'required|in:0,1'
        ]);

        $row = SisterConcern::findOrFail($id);
        $row->name = $request->name;
        $row->site_url = $request->site_url;
        $row->description = $request->description;
        $row->status = $request->status;
        if($request->file('photo')) {
            $row->logo = uploadImage($request->file('photo'),'assets/files/sister_concern/photos/');
        }
        $row->save();
        return redirect()->route('admin.sister-concerns.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SisterConcern::findOrFail($id)->delete();
        return redirect()->route('admin.sister-concerns.index')->with(deleteMessage());
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmployeeDesignation;
use App\Http\Controllers\Controller;

class EmployeeDesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = EmployeeDesignation::latest()->paginate(20);
        return view('admin.employee.designations',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route('admin.employee-designations.store');
        $page_title = "Add Employee Designation";
        return view('admin.employee.designation_add_edit',compact('route','page_title'));
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
            'name' => 'required|max:255|unique:employee_designations,name',
            'description' => 'required|max:2000',
        ]);
        $designation = new EmployeeDesignation();
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->save();
        return redirect()->route('admin.employee-designations.index')->with(savedMessage());
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
        $data = EmployeeDesignation::findOrFail($id);
        $route = route("admin.employee-designations.update",$data->id);
        $page_title = "Edit Employee Designation";
        return view('admin.employee.designation_add_edit',compact('data','page_title','route'));
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
            'name' => 'required|max:255|unique:employee_designations,name,'.$id,
            'description' => 'required'
        ]);
        $designation = EmployeeDesignation::findOrFail($id);
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->save();
        return redirect()->route('admin.employee-designations.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmployeeDesignation::findOrFail($id)->delete();
        return redirect()->route('admin.employee-designations.index')->with(deleteMessage());
    }
}

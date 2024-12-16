<?php

namespace App\Http\Controllers\Admin;

use App\Models\IncomeSector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomeSectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = IncomeSector::latest()->paginate(20);
        return view('admin.income.income_sector_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route('admin.income-sectors.store');
        $page_title = "Add Income Sector";
        return view('admin.income.income_sector_add_edit',compact('route','page_title'));
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
            'name' => 'required|max:255|unique:income_sectors,name',
            'description' => 'required|max:2000',
        ]);
        $income_sector = new IncomeSector();
        $income_sector->name = $request->name;
        $income_sector->description = $request->description;
        $income_sector->save();
        return redirect()->route('admin.income-sectors.index')->with(savedMessage());
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
        $data = IncomeSector::findOrFail($id);
        $route = route("admin.income-sectors.update",$data->id);
        $page_title = "Edit Income Sector";
        return view('admin.income.income_sector_add_edit',compact('data','page_title','route'));
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
            'name' => 'required|max:255|unique:income_sectors,name,'.$id,
            'description' => 'required'
        ]);
        $income_sector = IncomeSector::findOrFail($id);
        $income_sector->name = $request->name;
        $income_sector->description = $request->description;
        $income_sector->save();
        return redirect()->route('admin.income-sectors.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IncomeSector::findOrFail($id)->delete();
        return redirect()->route('admin.income-sectors.index')->with(deleteMessage());
    }
}

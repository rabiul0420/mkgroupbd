<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = PaymentMethod::latest()->paginate(20);
        return view('admin.basic.payment_method_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route('admin.payment-methods.store');
        $page_title = "Add New Payment Method";
        return view('admin.basic.payment_method_add_edit',compact('route','page_title'));
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
            'name' => 'required|max:100|unique:payment_methods,name',
            'description' => 'required|max:2000',
        ]);
        $category = new PaymentMethod();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('admin.payment-methods.index')->with(savedMessage());
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
        $data = PaymentMethod::findOrFail($id);
        $route = route("admin.payment-methods.update",$data->id);
        $page_title = "Edit Payment Method";
        return view('admin.basic.payment_method_add_edit',compact('data','page_title','route'));
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
            'name' => 'required|max:100|unique:payment_methods,name,'.$id,
            'description' => 'required'
        ]);
        $category = PaymentMethod::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('admin.payment-methods.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PaymentMethod::findOrFail($id)->delete();
        return redirect()->route('admin.payment-methods.index')->with(deleteMessage());
    }
}

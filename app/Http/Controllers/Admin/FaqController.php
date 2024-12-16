<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Faq::latest()->paginate(10);
        return view('admin.basic.faq_list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route("admin.faqs.store");
        return view('admin.basic.faq_add_edit',compact('route'));
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
            'question' => 'required|max:255',
            'answer' => 'required|max:5000'
        ]);
        $row = new Faq();
        $row->question = $request->question;
        $row->answer = $request->answer;
        $row->status = 1;
        $row->save();
        return redirect()->route('admin.faqs.index')->with(savedMessage());
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
        $data = Faq::findOrFail($id);
        $route = route('admin.faqs.update',$data->id);
        return view('admin.basic.faq_add_edit',compact('data','route'));
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
            'question' => 'required|max:255',
            'answer' => 'required|max:5000'
        ]);
        $row = Faq::findOrFail($id);
        $row->question = $request->question;
        $row->answer = $request->answer;
        $row->status = 1;
        $row->save();
        return redirect()->route('admin.faqs.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('admin.faqs.index')->with(deleteMessage());
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\ClientFeedbacks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientFeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client_feedbacks = ClientFeedbacks::latest()->paginate(20);
        return view('admin.basic.client_feedback_list',compact('client_feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route('admin.client-feedbacks.store');
        $page_title = "Add New Client Feedback";
        return view('admin.basic.client_feedback_add_edit',compact('route','page_title'));
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
            'name' => 'required|string',
            'designation' => 'required',
            'client_quote' => 'required',
            'status' => 'required|integer|in:0,1',
        ]);

        $client = new ClientFeedbacks();
        $client->name = $request->name;
        $client->designation = $request->designation;
        $client->client_quote = $request->client_quote;
        if($request->file('image')){
            $client->image = uploadImage($request->file('image'),'assets/files/clients/');
        }
        $client->status = $request->status;
        $client->save();
        return redirect()->route('admin.client-feedbacks.index')->with(savedMessage());
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
        $data = ClientFeedbacks::findOrFail($id);
        $route = route('admin.client-feedbacks.update',$data->id);
        $page_title = "Edit Client Feedback";
        return view('admin.basic.client_feedback_add_edit',compact('data','route','page_title'));
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
        $client = ClientFeedbacks::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string',
            'designation' => 'required',
            'client_quote' => 'required',
            'status' => 'required|integer|in:0,1',
        ]);

        $client->name = $request->name;
        $client->designation = $request->designation;
        $client->client_quote = $request->client_quote;
        if($request->file('image')){
            $client->image = uploadImage($request->file('image'),'assets/files/clients/');
        }
        $client->status = $request->status;
        $client->save();
        return redirect()->route('admin.client-feedbacks.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ClientFeedbacks::findOrFail($id)->delete();
        return redirect()->route('admin.client-feedbacks.index')->with(deleteMessage());
    }
}

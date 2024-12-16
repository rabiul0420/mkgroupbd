<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->paginate(20);
        return view('admin.basic.client_list',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route('admin.clients.store');
        $page_title = "Add New Client";
        return view('admin.basic.client_add_edit',compact('route','page_title'));
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50|unique:clients',
            'mobile' => 'required|max:15|unique:clients',
            'address' => 'required|string|max:1000',
            'logo' => 'required|image|mimes:jpg,png,jpeg|max:1024',
            'website_url' => 'nullable|sometimes|url|max:255',
            'status' => 'required|integer|in:0,1',
            'description' => 'nullable|sometimes|max:5000'
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->mobile = $request->mobile;
        $client->address = $request->address;
        $client->logo = uploadImage($request->file('logo'),'assets/files/clients/');
        $client->website_url = $request->website_url;
        $client->status = $request->status;
        $client->description = $request->description;
        $client->save();
        return redirect()->route('admin.clients.index')->with(savedMessage());
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
        $data = Client::findOrFail($id);
        $route = route('admin.clients.update',$data->id);
        $page_title = "Edit Client";
        return view('admin.basic.client_add_edit',compact('data','route','page_title'));
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
        $client = Client::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50|unique:clients,email,' . $id, // Ignore unique check for the current record
            'mobile' => 'required|max:15|unique:clients,mobile,' . $id, // Ignore unique check for the current record
            'address' => 'required|string|max:1000',
            'logo' => $client->logo ? '' : 'required|image|mimes:jpg,png,jpeg|max:1024',
            'website_url' => 'nullable|sometimes|url|max:255',
            'status' => 'required|integer|in:0,1',
            'description' => 'nullable|sometimes|max:5000'
        ]);

        $client->name = $request->name;
        $client->email = $request->email;
        $client->mobile = $request->mobile;
        $client->address = $request->address;
        if($request->file('logo')){
            $client->logo = uploadImage($request->file('logo'),'assets/files/clients/');
        }
        $client->website_url = $request->website_url;
        $client->status = $request->status;
        $client->description = $request->description;
        $client->save();
        return redirect()->route('admin.clients.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return redirect()->route('admin.clients.index')->with(deleteMessage());
    }
}

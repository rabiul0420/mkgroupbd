<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\WorkOrder;
use App\Models\OurService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = WorkOrder::latest()->paginate(20);
        return view('admin.basic.work_order_list',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route('admin.work-orders.store');
        $page_title = "Add New Work Order";
        $services = OurService::select('id','name')->oldest('name')->get();
        $clients = Client::select('id','name')->oldest('name')->get();
        $order_id = WorkOrder::getOrderId();
        return view('admin.basic.work_order_add_edit',compact('route','page_title','services','clients','order_id'));
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
            'order_id' => 'required|string|max:4',
            'title' => 'required|max:191',
            'service' => 'required|exists:our_services,id,deleted_at,NULL',
            'client' => 'required|exists:clients,id,deleted_at,NULL',
            'receive_date' => 'required|date',
            'budget_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
            'work_duration' => 'required|max:191',
            'order_note' => 'nullable|sometimes|max:5000'
        ]);

        $order = new WorkOrder();
        $order->order_id = WorkOrder::getOrderId();
        $order->title = $request->title;
        $order->service_id = $request->service;
        $order->client_id = $request->client;
        $order->receive_date = date('Y-m-d',strtotime($request->receive_date));
        $order->budget_amount = $request->budget_amount ?? 0;
        $order->paid_amount = $request->paid_amount ?? 0;
        $order->due_amount = $request->due_amount ?? 0;
        $order->work_duration = $request->work_duration;
        $order->order_note = $request->order_note;
        $order->save();
        return redirect()->route('admin.work-orders.index')->with(savedMessage());
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
    public function edit($order_id)
    {
        $data = WorkOrder::where('order_id',$order_id)->firstOrFail();
        $route = route('admin.work-orders.update',$data->id);
        $page_title = "Edit Work Order";
        $services = OurService::select('id','name')->oldest('name')->get();
        $clients = Client::select('id','name')->oldest('name')->get();
        return view('admin.basic.work_order_add_edit',compact('route','page_title','services','clients','data'));
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
            'order_id' => 'required|string|max:4|unique:work_orders,order_id,' . $id,
            'title' => 'required|max:191',
            'service' => 'required|exists:our_services,id,deleted_at,NULL',
            'client' => 'required|exists:clients,id,deleted_at,NULL',
            'receive_date' => 'required|date',
            'budget_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
            'work_duration' => 'required|max:191',
            'order_note' => 'nullable|sometimes|max:5000'
        ]);

        $order = WorkOrder::findOrFail($id);
        $order->order_id = WorkOrder::getOrderId();
        $order->title = $request->title;
        $order->service_id = $request->service;
        $order->client_id = $request->client;
        $order->receive_date = date('Y-m-d',strtotime($request->receive_date));
        $order->budget_amount = $request->budget_amount ?? 0;
        $order->paid_amount = $request->paid_amount ?? 0;
        $order->due_amount = $request->due_amount ?? 0;
        $order->work_duration = $request->work_duration;
        $order->order_note = $request->order_note;
        $order->save();
        return redirect()->route('admin.work-orders.index')->with(savedMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WorkOrder::findOrFail($id)->delete();
        return redirect()->route('admin.work-orders.index')->with(deleteMessage());
    }
}

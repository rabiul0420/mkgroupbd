<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Asset;
use App\Models\Income;
use App\Models\WorkOrder;
use App\Models\IncomeSector;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income_sectors = IncomeSector::oldest('name')->get();
        $work_orders = WorkOrder::oldest('order_id')->select('id','order_id','title')->get();
        $users = User::oldest('name')->get();
        $payment_methods = PaymentMethod::oldest('name')->get();
        //$payment_methods = PaymentMethod::oldest('name')->get();
        $data = Income::query();
        $data->when(request()->get('title'),function($query) {
            $title = request()->get('title');
            $query->where('title',"LIKE","%{$title}%");
        });
       
        $fromDate = request()->get('from_date');
        $toDate = request()->get('to_date');        
        
        if(isset($fromDate) && !isset($toDate)) {
            $data->whereDate('receive_date', Carbon::parse($fromDate)->toDateString());
        }

        if(!isset($fromDate) && isset($toDate)) {
            $data->whereDate('receive_date', '<=', Carbon::parse($toDate)->toDateString());
        }

        if(isset($fromDate) && isset($toDate)) {
            $data->whereDate('receive_date', '>=', Carbon::parse($fromDate)->toDateString());
            $data->whereDate('receive_date', '<=', Carbon::parse($toDate)->toDateString());
        }

        if(!isset($fromDate) && !isset($toDate)) {
            $data->whereMonth('receive_date', Carbon::now()->month);
            $data->whereYear('receive_date', Carbon::now()->year);
        }

        $data->when(request()->get('search_sector'),function($query) {
            $query->where('income_sector_id',request()->get('search_sector'));
        });
        $data->when(request()->get('work_order'),function($query) {
            $query->where('work_order_id',request()->get('work_order'));
        });
        $data->when(request()->get('received_by'),function($query) {
            $query->where('received_by',request()->get('received_by'));
        });
        $data->when(request()->get('payment_method'),function($query) {
            $query->where('payment_method',request()->get('payment_method'));
        });
        $results = $data->latest()->get();
        $response = [];
        $response['results'] = $results;
        $response['income_sectors'] = $income_sectors;
        $response['work_orders'] = $work_orders;
        $response['users'] = $users;
        $response['payment_methods'] = $payment_methods;
        $response['title'] = request()->get('title');
        $response['from_date'] = request()->get('from_date');
        $response['to_date'] = request()->get('to_date');
        $response['search_sector'] = request()->get('search_sector');
        $response['received_by'] = request()->get('received_by');
        $response['payment_method'] = request()->get('payment_method');

        return view('admin.income.income_list',$response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route("admin.incomes.store");
        $page_title = "Add Income";
        $income_sectors = IncomeSector::oldest('name')->get();
        $work_orders = WorkOrder::oldest('order_id')->select('id','order_id','title')->get();
        $users = User::oldest('name')->get();
        $payment_methods = PaymentMethod::oldest('name')->get();
        return view('admin.income.income_add_edit',compact('route','page_title','income_sectors','users','payment_methods','work_orders'));
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
            'title' => 'required|max:255',
            'sector' => 'required|integer|exists:income_sectors,id,deleted_at,NULL',
            'work_order' => 'nullable|sometimes|integer|exists:work_orders,id,deleted_at,NULL',
            'received_by' => 'required|integer|exists:users,id,deleted_at,NULL',
            'receive_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'vat' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'payment_method' => 'required|exists:payment_methods,name,deleted_at,NULL',
            'note' => 'nullable|sometimes|max:5000',
            'document' => 'nullable|sometimes|mimes:jpg,jpeg,png,pdf|max:1024'
        ]);
        $row = new Income();
        $row->title = $request->title;
        $row->income_sector_id = $request->sector;
        $row->work_order_id = $request->work_order;
        $row->received_by = $request->received_by;
        $row->receive_date = date('Y-m-d',strtotime($request->receive_date));
        $row->amount = $request->amount;
        $row->vat = $request->vat;
        $row->tax = $request->tax;
        $row->net_income = $request->amount - ($request->vat + $request->tax);
        $row->payment_method = $request->payment_method;
        $row->note = $request->note;
        if($request->file('document')) {
            $row->document = uploadFile($request->file('document'),'assets/files/income/');
        }
        $row->added_by = Auth::id();
        if($row->save()) {
            $asset = Asset::first();
            $current_balance = $asset->current_balance;
            $vat_tax = $row->vat + $row->tax;
            $net_income = $row->amount - $vat_tax;
            $asset->current_balance = $current_balance + $net_income;
            $asset->save();
        }
        return redirect()->route('admin.incomes.index')->with(savedMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Income::findOrFail(encrypt_decrypt($id,'decrypt'));
        return view('admin.income.income_details',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd("failed");
        // $data = Income::findOrFail($id);
        // $route = route("admin.incomes.update",$id);
        // $page_title = "Edit Income";
        // $income_sectors = IncomeSector::oldest('name')->get();
        // $work_orders = WorkOrder::oldest('order_id')->select('id','order_id','title')->get();
        // $users = User::oldest('name')->get();
        // $payment_methods = PaymentMethod::oldest('name')->get();
        // return view('admin.income.income_add_edit',compact('route','page_title','income_sectors','users','payment_methods','work_orders','data'));
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
        dd("failed");
        // $this->validate($request,[
        //     'title' => 'required|max:255',
        //     'sector' => 'required|integer|exists:income_sectors,id,deleted_at,NULL',
        //     'work_order' => 'nullable|sometimes|integer|exists:work_orders,id,deleted_at,NULL',
        //     'received_by' => 'required|integer|exists:users,id,deleted_at,NULL',
        //     'receive_date' => 'required|date',
        //     'amount' => 'required|numeric|min:0',
        //     'vat' => 'required|numeric|min:0',
        //     'tax' => 'required|numeric|min:0',
        //     'payment_method' => 'required|exists:payment_methods,name,deleted_at,NULL',
        //     'note' => 'nullable|sometimes|max:5000',
        //     'document' => 'nullable|sometimes|mimes:jpg,jpeg,png,pdf|max:1024'
        // ]);
        // $row = Income::findOrFail($id);
        // $row->title = $request->title;
        // $row->income_sector_id = $request->sector;
        // $row->work_order_id = $request->work_order;
        // $row->received_by = $request->received_by;
        // $row->receive_date = date('Y-m-d',strtotime($request->receive_date));
        // $row->amount = $request->amount;
        // $row->vat = $request->vat;
        // $row->tax = $request->tax;
        // $row->payment_method = $request->payment_method;
        // $row->note = $request->note;
        // if($request->file('document')) {
        //     $row->document = uploadFile($request->file('document'),'assets/files/income/');
        // }
        // $row->added_by = Auth::id();
        // if($row->save()) {
        //     $asset = Asset::first();
        //     $current_balance = $asset->current_balance;
        //     $vat_tax = $row->vat + $row->tax;
        //     $net_income = $row->amount - $vat_tax;
        //     $asset->current_balance = $current_balance + $net_income;
        //     $asset->save();
        // }
        // return redirect()->route('admin.incomes.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Income::findOrFail($id);
        $asset = Asset::first();
        $current_balance = $asset->current_balance;
        $asset->current_balance = $current_balance - $data->net_income;
        $asset->save();
        $data->delete();
        return redirect()->route('admin.incomes.index')->with(deleteMessage());
    }
}

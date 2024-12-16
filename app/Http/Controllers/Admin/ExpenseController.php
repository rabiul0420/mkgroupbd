<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Asset;
use App\Models\Expense;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ExpenseCategory::oldest('name')->get();
        $work_orders = WorkOrder::oldest('order_id')->select('id','order_id','title')->get();
        $users = User::oldest('name')->get();
        $payment_methods = PaymentMethod::oldest('name')->get();
        $data = Expense::query();
        $data->when(request()->get('title'),function($query) {
            $title = request()->get('title');
            $query->where('title',"LIKE","%{$title}%");
        });
        // $data->when(request()->get('from_date'), function ($query) {
        //     $query->whereDate('expense_date', date('Y-m-d', strtotime(request()->get('from_date'))));
        // }, function ($query) {
        //     $query->whereMonth('expense_date', Carbon::now()->month);
        //     $query->whereYear('expense_date', Carbon::now()->year);
        // });
        $fromDate = request()->get('from_date');
        $toDate = request()->get('to_date');        
        
        if(isset($fromDate) && !isset($toDate)) {
            $data->whereDate('expense_date', Carbon::parse($fromDate)->toDateString());
        }

        if(!isset($fromDate) && isset($toDate)) {
            $data->whereDate('expense_date', '<=', Carbon::parse($toDate)->toDateString());
        }

        if(isset($fromDate) && isset($toDate)) {
            $data->whereDate('expense_date', '>=', Carbon::parse($fromDate)->toDateString());
            $data->whereDate('expense_date', '<=', Carbon::parse($toDate)->toDateString());
        }

        if(!isset($fromDate) && !isset($toDate)) {
            $data->whereMonth('expense_date', Carbon::now()->month);
            $data->whereYear('expense_date', Carbon::now()->year);
        }

        $data->when(request()->get('category'),function($query) {
            $query->where('category_id',request()->get('category'));
        });
        $data->when(request()->get('work_order'),function($query) {
            $query->where('work_order_id',request()->get('work_order'));
        });
        $data->when(request()->get('responsible_person'),function($query) {
            $query->where('responsible_person',request()->get('responsible_person'));
        });
        $data->when(request()->get('payment_method'),function($query) {
            $query->where('payment_method',request()->get('payment_method'));
        });
        $results = $data->latest()->paginate(20);
        $response = [];
        $response['results'] = $results;
        $response['categories'] = $categories;
        $response['work_orders'] = $work_orders;
        $response['users'] = $users;
        $response['payment_methods'] = $payment_methods;
        $response['title'] = request()->get('title');
        $response['from_date'] = request()->get('from_date');
        $response['to_date'] = request()->get('to_date');
        $response['search_category'] = request()->get('category');
        $response['responsible_person'] = request()->get('responsible_person');
        $response['payment_method'] = request()->get('payment_method');

        return view('admin.expense.expense_list',$response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route("admin.expense-list.store");
        $page_title = "Add Expense";
        $categories = ExpenseCategory::oldest('name')->get();
        $work_orders = WorkOrder::oldest('order_id')->select('id','order_id','title')->get();
        $users = User::oldest('name')->get();
        $payment_methods = PaymentMethod::oldest('name')->get();
        return view('admin.expense.expense_add_edit',compact('route','page_title','categories','users','payment_methods','work_orders'));
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
            'category' => 'required|integer|exists:expense_categories,id,deleted_at,NULL',
            'work_order' => 'nullable|sometimes|integer|exists:work_orders,id,deleted_at,NULL',
            'responsible_person' => 'required|integer|exists:users,id,deleted_at,NULL',
            'expense_date' => 'required|date',
            'amount' => 'required|numeric',
            'payment_method' => 'required|exists:payment_methods,name,deleted_at,NULL',
            'note' => 'nullable|sometimes|max:5000',
            'document' => 'nullable|sometimes|mimes:jpg,jpeg,png,pdf|max:1024'
        ]);
        $row = new Expense();
        $row->title = $request->title;
        $row->category_id = $request->category;
        $row->work_order_id = $request->work_order;
        $row->responsible_person = $request->responsible_person;
        $row->expense_date = date('Y-m-d',strtotime($request->expense_date));
        $row->amount = $request->amount;
        $row->payment_method = $request->payment_method;
        $row->note = $request->note;
        if($request->file('document')) {
            $row->document = uploadFile($request->file('document'),'assets/files/expense/');
        }
        if($row->save()) {
            $asset = Asset::first();
            $current_balance = $asset->current_balance;
            $asset->current_balance = $current_balance - $row->amount;
            $asset->save();
        }
        return redirect()->route('admin.expense-list.index')->with(savedMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Expense::findOrFail(encrypt_decrypt($id,'decrypt'));
        return view('admin.expense.expense_details',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd("Failed");
        // $data = Expense::findOrFail($id);
        // $route = route("admin.expense-list.update",$data->id);
        // $page_title = "Edit Expense";
        // $categories = ExpenseCategory::oldest('name')->get();
        // $work_orders = WorkOrder::oldest('order_id')->select('id','order_id','title')->get();
        // $users = User::oldest('name')->get();
        // $payment_methods = PaymentMethod::oldest('name')->get();
        // return view('admin.expense.expense_add_edit',compact('route','page_title','categories','users','payment_methods','data','work_orders'));
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
        dd("Failed");
        // $this->validate($request,[
        //     'title' => 'required|max:255',
        //     'category' => 'required|exists:expense_categories,id,deleted_at,NULL',
        //     'responsible_person' => 'required|integer|exists:users,id,deleted_at,NULL',
        //     'expense_date' => 'required|date',
        //     'amount' => 'required|numeric',
        //     'payment_method' => 'required|exists:payment_methods,name,deleted_at,NULL',
        //     'note' => 'nullable|sometimes|max:5000',
        //     'document' => 'nullable|sometimes|mimes:jpg,jpeg,png,pdf|max:1024'
        // ]);
        // $row = Expense::findOrFail($id);
        // $row->title = $request->title;
        // $row->category_id = $request->category;
        // $row->responsible_person = $request->responsible_person;
        // $row->expense_date = date('Y-m-d',strtotime($request->expense_date));
        // $row->amount = $request->amount;
        // $row->payment_method = $request->payment_method;
        // $row->note = $request->note;
        // if($request->file('document')) {
        //     $row->document = uploadFile($request->file('document'),'assets/files/expense/');
        // }
        // if($row->save()) {
        //     $asset = Asset::first();
        //     $current_balance = $asset->current_balance;
        //     $asset->current_balance = $current_balance - $row->amount;
        //     $asset->save();
        // }
        // return redirect()->route('admin.expense-list.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Expense::findOrFail($id);
        $asset = Asset::first();
        $current_balance = $asset->current_balance;
        $asset->current_balance = $current_balance + $data->amount;
        $asset->save();
        $data->delete();
        return redirect()->route('admin.expense-list.index')->with(deleteMessage());
    }
}

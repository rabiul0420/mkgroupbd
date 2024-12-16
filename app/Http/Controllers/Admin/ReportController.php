<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Income;
use App\Models\Expense;
use App\Models\WorkOrder;
use App\Models\IncomeSector;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function expenseReport()
    {
        $categories = ExpenseCategory::oldest('name')->get();
        $work_orders = WorkOrder::oldest('order_id')->select('id', 'order_id', 'title')->get();
        $users = User::oldest('name')->get();
        $payment_methods = PaymentMethod::oldest('name')->get();
        $display_type = request()->get('display_type') ?? 'show_data';
        $data = Expense::query();
        $parameters = request()->all(); // Get all parameters
        // Build query conditions dynamically based on available parameters
        $conditions = [];
        foreach ($parameters as $name => $value) {
            if (empty($value)) {
                continue; // Skip empty parameters
            }

            switch ($name) {
                case 'title':
                    $conditions[] = ['title', 'LIKE', "%$value%"];
                    break;
                case 'from_date':
                    $conditions[] = ['expense_date', '>=', Carbon::parse($value)->toDateString()];
                    break;
                case 'to_date':
                    $conditions[] = ['expense_date', '<=', Carbon::parse($value)->toDateString()];
                    break;
                case 'category':
                    $conditions[] = ['category_id', $value];
                    break;
                case 'work_order':
                    $conditions[] = ['work_order_id', $value];
                    break;
                case 'responsible_person':
                    $conditions[] = ['responsible_person', $value];
                    break;
                case 'payment_method':
                    $conditions[] = ['payment_method', $value];
                    break;
                default:
                    // Add logic for additional parameters if needed
                    break;
            }
        }

        if (request()->has('display_all') && request()->get('display_all') == 'on') {
            $results = $data->get();
        } elseif (!empty($conditions)) {
            $results = $data->where($conditions)->get();
        } else {
            $results = [];
        }

        $response = [];
        $response['total_expense'] = count($results) ? $results->sum('amount') : 0;
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
        $response['work_order'] = request()->get('work_order');

        if ($display_type == "show_data") {
            return view('admin.reports.expense_reports', $response);
        } elseif ($display_type == "download_pdf") {
            $response['generated_on'] = Carbon::now()->format('d M, y');
            //return view('admin.reports.pdf.expense_reports_pdf',$response);
            $pdf = PDF::loadView('admin.reports.pdf.expense_reports_pdf', $response);
            return $pdf->stream();
        }
    }

    public function IncomeReport()
    {
        $income_sectors = IncomeSector::oldest('name')->get();
        $work_orders = WorkOrder::oldest('order_id')->select('id', 'order_id', 'title')->get();
        $users = User::oldest('name')->get();
        $payment_methods = PaymentMethod::oldest('name')->get();
        $display_type = request()->get('display_type') ?? 'show_data';
        $data = Income::query();
        $parameters = request()->all(); // Get all parameters
        // Build query conditions dynamically based on available parameters
        $conditions = [];
        foreach ($parameters as $name => $value) {
            if (empty($value)) {
                continue; // Skip empty parameters
            }

            switch ($name) {
                case 'title':
                    $conditions[] = ['title', 'LIKE', "%$value%"];
                    break;
                case 'from_date':
                    $conditions[] = ['receive_date', '>=', Carbon::parse($value)->toDateString()];
                    break;
                case 'to_date':
                    $conditions[] = ['receive_date', '<=', Carbon::parse($value)->toDateString()];
                    break;
                case 'income_sector':
                    $conditions[] = ['income_sector_id', $value];
                    break;
                case 'work_order':
                    $conditions[] = ['work_order_id', $value];
                    break;
                case 'received_by':
                    $conditions[] = ['received_by', $value];
                    break;
                case 'payment_method':
                    $conditions[] = ['payment_method', $value];
                    break;
                default:
                    // Add logic for additional parameters if needed
                    break;
            }
        }
        if (request()->has('display_all') && request()->get('display_all') == 'on') {
            $results = $data->get();
        } elseif (!empty($conditions)) {
            $results = $data->where($conditions)->get();
        } else {
            $results = [];
        }

        $response = [];
        $response['total_income'] = count($results) ? $results->sum('net_income') : 0;
        $response['results'] = $results;
        $response['income_sectors'] = $income_sectors;
        $response['work_orders'] = $work_orders;
        $response['users'] = $users;
        $response['payment_methods'] = $payment_methods;
        $response['title'] = request()->get('title');
        $response['from_date'] = request()->get('from_date');
        $response['to_date'] = request()->get('to_date');
        $response['search_sector'] = request()->get('income_sector');
        $response['received_by'] = request()->get('received_by');
        $response['payment_method'] = request()->get('payment_method');
        $response['work_order'] = request()->get('work_order');

        if ($display_type == "show_data") {
            return view('admin.reports.income_reports', $response);
        } elseif ($display_type == "download_pdf") {
            $response['generated_on'] = Carbon::now()->format('d M, y');
            //return view('admin.reports.pdf.income_reports_pdf',$response);
            $pdf = PDF::loadView('admin.reports.pdf.income_reports_pdf', $response);
            return $pdf->stream();
        }
    }

    public function profitReport(Request $request)
    {
        // Filter by date range from request or default to current month's start and end dates
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $period = $request->input('period'); // daily, weekly, monthly, yearly

        // Query for incomes
        $incomesQuery = Income::select('created_at', 'net_income as amount');

        // Query for expenses
        $expensesQuery = Expense::select('created_at', 'amount');

        // Fetch the data
        $incomes = $incomesQuery->get();
        $expenses = $expensesQuery->get();

        // Merge incomes and expenses, and sort by date
        $report = $incomes->merge($expenses);
        return $report;

        // Group by period if provided
        // if ($period == 'daily') {
        //     $report = $report->groupBy(function ($item) {
        //         return $item->created_at->format('Y-m-d');
        //     });
        // } elseif ($period == 'weekly') {
        //     $report = $report->groupBy(function ($item) {
        //         return $item->created_at->format('o-W'); // ISO Week format
        //     });
        // } elseif ($period == 'monthly') {
        //     $report = $report->groupBy(function ($item) {
        //         return $item->created_at->format('Y-m');
        //     });
        // } elseif ($period == 'yearly') {
        //     $report = $report->groupBy(function ($item) {
        //         return $item->created_at->format('Y');
        //     });
        // }
        return $report;
        return view('reports.profit', compact('report'));
    }
}

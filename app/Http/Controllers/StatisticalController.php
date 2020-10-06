<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function index()
    {
        $array_date = [];
        $end_date = date('Y-m-d');
        $start_date = date('Y-m-d', strtotime('-9 days', strtotime($end_date)));

        for ($i = 9; $i > 0; $i--) {
            array_push($array_date, date('Y-m-d', strtotime('-'.(string)$i.' days', strtotime($end_date))));
        }
        array_push($array_date, $end_date);

        $sum_order_table   = DB::table('orders')
            ->select(DB::raw('sum(amount) as `amount`'), DB::raw("DATE_FORMAT(date, '%Y-%m-%d') date_sum"))
            ->where('date', '>=', $start_date)
            ->where('status', '=', 3)
            ->groupby('date_sum')
            ->orderBy('date_sum', 'asc')
            ->get();
        $data_revenue = [];
        if ($sum_order_table) {
            foreach ($sum_order_table as $value) {
                foreach ($array_date as $date) {
                    if ($date == $value->date_sum) {
                        $data_revenue[$date] = intval($value->amount);
                    } else {
                        if (!array_key_exists($date, $data_revenue)) {
                            $data_revenue[$date] = 0;
                        }
                    }
                }
            }
        }
        $revenue = [];
        foreach ($data_revenue as $value) {
            $revenue[] = $value;
        }

        $sum_expense_table = DB::table('expenses')
            ->select(DB::raw('sum(amount) as `amount`'), DB::raw("DATE_FORMAT(date, '%Y-%m-%d') date_sum"))
            ->where('date', '>=', $start_date)
            ->groupby('date_sum')
            ->orderBy('date_sum', 'asc')
            ->get();
        $data_expense     = [];
        if ($sum_expense_table) {
            foreach ($sum_expense_table as $value) {
                foreach ($array_date as $date) {
                    if ($date == $value->date_sum) {
                        $data_expense[$date] = intval($value->amount);
                    } else {
                        if (!array_key_exists($date, $data_expense)) {
                            $data_expense[$date] = 0;
                        }
                    }
                }
            }
        }
        $expense = [];
        foreach ($data_expense as $value) {
            $expense[] = $value;
        }

        return view('statistical.index', ['revenue' => $revenue, 'expense' => $expense, 'date' => $array_date]);
    }

    public function revenue(Request $request)
    {
        if ($request->isMethod('post')) {
            $array_date = [];
            $date_start = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('inputDateStart'))));
            $date_end = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('inputDateEnd'))));

            for ($i = strtotime($date_start); $i <= strtotime($date_end); $i+= (86400)) {
                array_push($array_date, date('Y-m-d', $i));
            }

            $date_start = date('Y-m-d', strtotime('-1 days', strtotime($date_start)));
            $date_end = date('Y-m-d', strtotime('+1 days', strtotime($date_end)));

            $sum_order_table   = DB::table('orders')
                ->select(DB::raw('sum(amount) as `amount`'), DB::raw("DATE_FORMAT(date, '%Y-%m-%d') date_sum"))
                ->where('date', '>=', $date_start)
                ->where('date', '<=', $date_end)
                ->where('status', '=', 3)
                ->groupby('date_sum')
                ->orderBy('date_sum', 'asc')
                ->get();
            $data_revenue = [];
            if ($sum_order_table) {
                foreach ($sum_order_table as $value) {
                    foreach ($array_date as $date) {
                        if ($date == $value->date_sum) {
                            $data_revenue[$date] = intval($value->amount);
                        } else {
                            if (!array_key_exists($date, $data_revenue)) {
                                $data_revenue[$date] = 0;
                            }
                        }
                    }
                }
            }
            $revenue = [];
            foreach ($data_revenue as $value) {
                $revenue[] = $value;
            }

            $sum_expense_table = DB::table('expenses')
                ->select(DB::raw('sum(amount) as `amount`'), DB::raw("DATE_FORMAT(date, '%Y-%m-%d') date_sum"))
                ->where('date', '>=', $date_start)
                ->where('date', '<=', $date_end)
                ->groupby('date_sum')
                ->orderBy('date_sum', 'asc')
                ->get();
            $data_expense     = [];
            if ($sum_expense_table) {
                foreach ($sum_expense_table as $value) {
                    foreach ($array_date as $date) {
                        if ($date == $value->date_sum) {
                            $data_expense[$date] = intval($value->amount);
                        } else {
                            if (!array_key_exists($date, $data_expense)) {
                                $data_expense[$date] = 0;
                            }
                        }
                    }
                }
            }
            $expense = [];
            foreach ($data_expense as $value) {
                $expense[] = $value;
            }

            return view('statistical.revenue', ['revenue' => $revenue, 'expense' => $expense, 'date' => $array_date]);
        }
    }
}
